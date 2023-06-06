use cinema;

CREATE VIEW filmu_list AS
SELECT fl.zanrs,pi.nosaukums,pi.cena,mdf.saite,fl.id_films,sns.datums,sns.laiks
FROM films AS fl
INNER JOIN papildu_info AS pi 
ON fl.papildu_info_idpapildu_info=pi.idpapildu_info
INNER JOIN media AS mdf
ON fl.media_id_media=mdf.id_media AND mdf.media_tips='foto'
LEFT JOIN seansi AS sns
ON sns.films_id_films = fl.id_films;

CREATE VIEW biletes AS
SELECT lg.username, bl.zale_numurs, vt.vieta, vt.rinda, pi.nosaukums, pi.datums, rz.reservets, pi.laiks
FROM login AS lg
INNER JOIN bilete AS bl
ON lg.id_login=bl.id_bilete
INNER JOIN vietas as vt
ON bl.id_bilete=vt.id_vieta
INNER JOIN films AS fl
ON bl.id_bilete=fl.id_films
INNER JOIN papildu_info AS pi
ON fl.id_films=pi.idpapildu_info
INNER JOIN rezervacija AS rz
ON lg.id_login=rz.id_login;

CREATE VIEW userlist AS
SELECT lg.username, COUNT(*) as count, lg.admin, lg.id_login
FROM login AS lg
INNER JOIN rezervacija AS rz
ON lg.id_login=rz.id_login
GROUP BY lg.username, lg.admin, lg.id_login;

DELIMITER $$
CREATE PROCEDURE deleteFilm(IN film_id INTEGER)
BEGIN

    DELETE FROM bilete WHERE films_id_films=film_id;
    DELETE FROM films WHERE id_films=film_id;
    
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
  IN p_filmDescription TEXT,
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

      INSERT INTO films (zanrs, vecums, media_id_media, papildu_info_idpapildu_info)
      VALUES (p_filmGenre, p_filmDescription, @media_id, @papildu_id);

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
CREATE PROCEDURE createUser(
  IN p_userName VARCHAR(255),
  IN p_userPass VARCHAR(255)
)
BEGIN
    INSERT INTO login (username, password, admin)
    VALUES (p_userName, p_userPass, 0);
END$$
DELIMITER ;

CREATE VIEW saraksts AS
SELECT fl.zanrs,pi.nosaukums,pi.cena,mdf.saite,fl.id_films
FROM films AS fl
INNER JOIN papildu_info AS pi 
ON fl.papildu_info_idpapildu_info=pi.idpapildu_info
INNER JOIN media AS mdf
ON fl.media_id_media=mdf.id_media AND mdf.media_tips='foto';