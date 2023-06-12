use cinema;

CREATE VIEW filmu_list AS
SELECT fl.zanrs,pi.nosaukums,pi.cena,mdf.saite,fl.id_films,sns.datums,sns.laiks,sns.id_seansi
FROM films AS fl
INNER JOIN papildu_info AS pi 
ON fl.papildu_info_idpapildu_info=pi.idpapildu_info
INNER JOIN media AS mdf
ON fl.media_id_media=mdf.id_media AND mdf.media_tips='foto'
LEFT JOIN seansi AS sns
ON sns.films_id_films = fl.id_films
WHERE sns.active=1;

CREATE VIEW biletes AS
SELECT pi.nosaukums,sns.datums,sns.laiks,blt.vieta,blt.rinda,blt.pirksanu_laiks,blt.bilete_statuss_id_bilete_statuss,lg.username,blt.id_bilete
FROM bilete AS blt
INNER JOIN login AS lg
ON lg.id_login=blt.login_id_login
INNER JOIN seansi AS sns
ON sns.id_seansi=blt.seansi_id_seansi
INNER JOIN films AS flm
ON flm.id_films=sns.films_id_films
INNER JOIN papildu_info AS pi
ON flm.papildu_info_idpapildu_info=pi.idpapildu_info
ORDER BY blt.pirksanu_laiks;

CREATE VIEW userlist AS
SELECT lg.username, COUNT(*) as count, lg.admin, lg.id_login
FROM login AS lg
GROUP BY lg.username, lg.admin, lg.id_login;

DELIMITER $$
CREATE PROCEDURE deleteFilm(IN seansi_id INTEGER)
BEGIN

UPDATE seansi SET active=0
WHERE id_seansi=seansi_id;
    
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE changeRights(IN login_id INTEGER)
BEGIN

    UPDATE login SET admin=admin^1
    WHERE id_login=login_id;
    
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE createFilm(
  IN p_filmName VARCHAR(255),
  IN p_filmGenre VARCHAR(255),
  IN p_filmDescription VARCHAR(500),
  IN p_vecums VARCHAR(10),
  IN p_date DATE,
  IN p_time VARCHAR(255),
  IN p_price DECIMAL(10, 2),
  IN p_imageUrl VARCHAR(255),
  IN p_valoda VARCHAR(255)
)
BEGIN
    IF EXISTS (SELECT id_films FROM films AS fl INNER JOIN papildu_info AS pi ON pi.idpapildu_info = fl.papildu_info_idpapildu_info WHERE pi.nosaukums = p_filmName) THEN
      -- Если фильм существует
      INSERT INTO seansi (datums, laiks, valoda, films_id_films)
      SELECT p_date, p_time, p_valoda, id_films
      FROM films AS fl
      INNER JOIN papildu_info AS pi ON pi.idpapildu_info = fl.papildu_info_idpapildu_info
      WHERE pi.nosaukums = p_filmName
      LIMIT 1;
    ELSE
      -- Если фильм не существует
      INSERT INTO media (saite, media_tips)
      VALUES (p_imageUrl, 'foto');

      SET @media_id = LAST_INSERT_ID();

      INSERT INTO papildu_info (nosaukums, cena)
      VALUES (p_filmName, p_price);

      SET @papildu_id = LAST_INSERT_ID();

      INSERT INTO films (zanrs, apraksts, vecums, media_id_media, papildu_info_idpapildu_info)
      VALUES (p_filmGenre, p_filmDescription, p_vecums, @media_id, @papildu_id);

      INSERT INTO seansi (datums, laiks, valoda, films_id_films)
      SELECT p_date, p_time, p_valoda, id_films
      FROM films AS fl
      INNER JOIN papildu_info AS pi ON pi.idpapildu_info = fl.papildu_info_idpapildu_info
      WHERE pi.nosaukums = p_filmName
      LIMIT 1;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE editFilm(
  IN p_filmName VARCHAR(255),
  IN p_filmGenre VARCHAR(255),
  IN p_filmDescription TEXT,
  IN p_date DATE,
  IN p_time VARCHAR(255),
  IN p_price DECIMAL(10, 2),
  IN p_imageUrl VARCHAR(255),
  IN p_valoda VARCHAR(255),
  IN p_seansID INT
)
BEGIN
  UPDATE papildu_info
  INNER JOIN films ON films.papildu_info_idpapildu_info = papildu_info.idpapildu_info
  INNER JOIN seansi ON seansi.films_id_films = films.id_films
  SET papildu_info.nosaukums = p_filmName, papildu_info.cena = p_price
  WHERE seansi.id_seansi = p_seansID;

  UPDATE films
  INNER JOIN seansi ON seansi.films_id_films = films.id_films
  SET films.zanrs = p_filmGenre, films.apraksts = p_filmDescription
  WHERE seansi.id_seansi = p_seansID;

  UPDATE seansi
  SET seansi.datums = p_date, seansi.laiks = p_time, seansi.valoda = p_valoda
  WHERE seansi.id_seansi = p_seansID;

  UPDATE media
  INNER JOIN films ON films.media_id_media = media.id_media
  INNER JOIN seansi ON seansi.films_id_films = films.id_films
  SET media.saite = p_imageUrl
  WHERE seansi.id_seansi = p_seansID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE createUser(
  IN p_userName VARCHAR(255),
  IN p_userPass VARCHAR(255),
  IN p_userVards VARCHAR(255),
  IN p_userUzvards VARCHAR(255),
  IN p_userTelefons VARCHAR(255)
)
BEGIN
  INSERT INTO login (username, password, admin, vards, uzvards, telefons)
  VALUES (p_userName, p_userPass, 0, p_userVards, p_userUzvards, p_userTelefons);
END$$
DELIMITER ;

CREATE VIEW saraksts AS
SELECT DISTINCT fl.zanrs, pi.nosaukums, pi.cena, mdf.saite, fl.id_films, fl.end_date
FROM films AS fl
INNER JOIN papildu_info AS pi ON fl.papildu_info_idpapildu_info = pi.idpapildu_info
INNER JOIN media AS mdf ON fl.media_id_media = mdf.id_media AND mdf.media_tips = 'foto'
INNER JOIN seansi AS sns ON fl.id_films = sns.films_id_films
WHERE (fl.end_date > NOW() OR fl.end_date IS NULL) AND sns.active = 1;

DELIMITER $$
CREATE PROCEDURE nopirktBilete(
  IN rowID INT,
  IN colID INT,
  IN seansID INT,
  IN userID INT
)
BEGIN
    INSERT INTO bilete (vieta, rinda, login_id_login,seansi_id_seansi,bilete_statuss_id_bilete_statuss, pirksanu_laiks)
    VALUES (colID,rowID,userID,seansID,1,NOW());
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE pirktBilete(
  IN p_bileteID INT
)
BEGIN
    UPDATE bilete SET bilete_statuss_id_bilete_statuss = 2
    WHERE id_bilete=p_bileteID;
END$$
DELIMITER ;