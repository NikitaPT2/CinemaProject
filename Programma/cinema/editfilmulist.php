<?php
require('connection.php');
// Iegūt parametrus, kas nosūtīti ar Ajax
$param1 = $_POST['param1'];

$roomsSQL = "SELECT fl.zanrs,pi.nosaukums,pi.cena,mdf.saite,fl.id_films,sns.datums,sns.laiks,sns.id_seansi,fl.apraksts,sns.valoda
FROM films AS fl
INNER JOIN papildu_info AS pi 
ON fl.papildu_info_idpapildu_info=pi.idpapildu_info
INNER JOIN media AS mdf
ON fl.media_id_media=mdf.id_media AND mdf.media_tips='foto'
LEFT JOIN seansi AS sns
ON sns.films_id_films = fl.id_films
WHERE sns.id_seansi = $param1";

$read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
if (mysqli_num_rows($read_rooms) > 0) {
    while ($row = mysqli_fetch_assoc($read_rooms)) {
        $results['zanrs'] = $row["zanrs"];
        $results['nosaukums'] = $row["nosaukums"];
        $results['cena'] = $row["cena"];
        $results['saite'] = $row["saite"];
        $results['id_films'] = $row["id_films"];
        $results['datums'] = $row["datums"];
        $results['laiks'] = $row["laiks"];
        $results['id_seansi'] = $row["id_seansi"];
        $results['apraksts'] = $row["apraksts"];
        $results['valoda'] = $row["valoda"];
    }
}

// Atgriez rezultātu kā JSON objektu.
echo json_encode(array('result' => $results));
?>