<?php
require('components.php');
require('connection.php');
getHeader(false, 2);
?>

<div class="content">
  <div class="filmlist">
    <?php
      $id = $_GET['id'];
      $roomsSQL = "SELECT * FROM films flm INNER JOIN papildu_info pi ON flm.papildu_info_idpapildu_info = pi.idpapildu_info INNER JOIN media md ON md.id_media = flm.media_id_media WHERE id_films = '{$id}'";
      $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
      if (mysqli_num_rows($read_rooms) > 0) {
        while ($row = mysqli_fetch_assoc($read_rooms)) {
          echo "
          <div class='container'>
          <div class='row'>
          <div class='col-md-12'> <h1>{$row["nosaukums"]}</h1> </div>
          <div class='col-md-12'> <img src='{$row["saite"]}' alt='' style='width: 20%;'> </div>
          <div class='col-md-12'> <p>{$row["zanrs"]}</p> </div>
          </div>
          </div>
          ";
        }
      } else {
        echo "Tabula nav datu ko attēlot";
      }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1> Seansi </h1>
          <hr>
          <?php
            function getValoda($valodas){
              $valodaArr = explode(";", $valodas);
              $html = '';
              
              foreach ($valodaArr as $valoda) {
                $classname = '';
                if (strpos($valoda, 'sub') !== false) {
                  $classname = "text-bg-danger";
                } else {
                  $classname = "text-bg-success";
                }
                $html .= "<span class='badge {$classname}'>" . $valoda . '</span>';
              }
              return $html;
            }
            $id = $_GET['id'];
            $roomsSQL = "SELECT * FROM films flm INNER JOIN seansi sns ON sns.films_id_films = flm.id_films WHERE id_films = '{$id}'";
            $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
            if (mysqli_num_rows($read_rooms) > 0) {
              while ($row = mysqli_fetch_assoc($read_rooms)) {
                $valodasSection = getValoda($row["valoda"]);
                echo "
                <div class='container'>
                <div class='row'>
                <div class='col-md-2'>{$row["datums"]}</div>
                <div class='col-md-2'>{$row["laiks"]}</div>
                <div class='col-md-2'>{$row["vecums"]}</div>
                <div class='col-md-2'>{$valodasSection}</div>
                <div class='col-md-1'> <button type='button' class='btn btn-success'>Rezervēt</button> 
                </div>
                </div>
                </div>
                ";
              }
            } else {
              echo "Tabula nav datu ko attēlot";
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
getFooter();
?>
</body>

</html>