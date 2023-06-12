<?php
require('connection.php');
// Iegūt parametrus, kas nosūtīti ar Ajax
$param1 = $_POST['param1'];

$roomsSQL = "SELECT sns.id_seansi, blt.vieta, blt.rinda, blt.bilete_statuss_id_bilete_statuss FROM seansi AS sns
INNER JOIN bilete AS blt ON
sns.id_seansi=blt.seansi_id_seansi
WHERE id_seansi={$param1} AND (blt.bilete_statuss_id_bilete_statuss = 2 OR (blt.pirksanu_laiks >= NOW() - INTERVAL 30 MINUTE 
AND blt.bilete_statuss_id_bilete_statuss = 1));
";
$read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
if (mysqli_num_rows($read_rooms) > 0) {
        $i = 0;
    while ($row = mysqli_fetch_assoc($read_rooms)) {
        $results[$i]['row'] = $row["rinda"];
        $results[$i]['col'] = $row["vieta"];
        $results[$i]['status'] = $row["bilete_statuss_id_bilete_statuss"];
        $i++;
    }
}

// Atgriez rezultātu kā JSON objektu.
echo json_encode(array('result' => $results));
?>