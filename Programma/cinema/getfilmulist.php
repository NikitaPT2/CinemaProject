<?php
require('connection.php');
// Iegūt parametrus, kas nosūtīti ar Ajax

$roomsSQL = "SELECT pi.nosaukums FROM films AS flm INNER JOIN papildu_info AS pi ON pi.idpapildu_info = flm.id_films";
$read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
if (mysqli_num_rows($read_rooms) > 0) {
        $i = 0;
    while ($row = mysqli_fetch_assoc($read_rooms)) {
        $results[$i] = $row["nosaukums"];
        $i++;
    }
}

// Atgriez rezultātu kā JSON objektu.
echo json_encode(array('result' => $results));
?>