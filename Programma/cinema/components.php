<?php
function getHeader($isblack, $number)
{
  session_start();
  require('connection.php');
  $bodyclass = '';
  if ($isblack) {
    $bodyclass = 'class="blacks"'; // Ādas klase, ja $isblack ir patiesa
  }
  $bold = 'font-weight-bold'; // Treknraksts
  $gronema = ''; // Noklusējuma vērtība
  $saraksts = '';
  $filmas = '';
  $login = '';
  $profile = '';
  $info = '';
  $feed = '';

  if ($number == 1) {
    $gronema = $bold; // Ja $number ir 1, tad $gronema ir treknraksts
  }
  if ($number == 2) {
    $saraksts = $bold;
  }
  if ($number == 3) {
    $filmas = $bold;
  }
  if ($number == 4) {
    $login = $bold;
  }
  if ($number == 5) {
    $profile = $bold;
  }
  if ($number == 6) {
    $info = $bold;
  }
  if ($number == 7) {
    $feed = $bold;
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gronema</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>

    <link href="style.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">

    <link rel="icon" type="image/png" href="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQnbzi-1qSuoD__unT6V4V2F5HNuhpkF30DZhGlI1lDkT2qniAM">

  </head>
  <body <?php echo $bodyclass; ?>> <!--Šis kods izveido lapas galveni ar navigācijas izvēlni un pieteikšanās iespēju.-->
    <div class="header"> 
      <nav class="navbar navbar-expand-lg" style="background-color: #d04343c4;">
        <div class="container-fluid">
          <a class="navbar-brand <?php echo $gronema; ?>" href="index.php">GRONEMA</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link <?php echo $saraksts; ?>" href="saraksts.php">Saraksts</a>
              </li>
              <a class="nav-link <?php echo $info; ?>" href="info.php">Informācija</a>
              <a class="nav-link <?php echo $feed; ?>" href="news.php">Filmu jaunumi</a>
              <?php
              if (isset($_SESSION['username'])) {
                if ($_SESSION['admin'] == 1) {
                  echo '<li class="nav-item"><a class="nav-link ' . $filmas . '" href="filmas.php">Filmas</a></li>';
                }
              }
              if (isset($_SESSION['username'])) {
                echo '<li class="nav-item"><a class="nav-link ' . $profile . '" href="profile.php">Profils</a></li>';
              }
              ?>

            </ul>

            <form class="d-flex">

              <?php
              if (isset($_SESSION['username'])) {
                echo '<a class="nav-link ' . $login . '" href="login.php">' . $_SESSION['username'] . '</a>';
              } else {
                echo '<a class="nav-link ' . $login . '" href="login.php">Login</a>';
              }
              ?>

            </form>

          </div>
        </div>
      </nav>
    </div>
    <?php
}

function getFilmSaraksts() // Šī funkcija iegūst filmu sarakstu no datu bāzes un to attēlo HTML veidā.
{
  require("connection.php");
  $roomsSQL = "SELECT * FROM saraksts";
  $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");

  if (mysqli_num_rows($read_rooms) > 0) {
    echo "<div class='container'>";
    echo "<div class='d-flex flex-wrap justify-content-center'>";
    while ($row = mysqli_fetch_assoc($read_rooms)) {
      echo "
        <div class='col-12 col-md-6 col-lg-4'>
          <ul class='list-group w-75'>
            <li class='list-group-item'><a href='filmpage.php?id={$row["id_films"]}'><img src='{$row["saite"]}' alt='film'></a></li>
            <li class='list-group-item'>Nosaukums: {$row["nosaukums"]}</li>
            <li class='list-group-item'>Žanrs: {$row["zanrs"]}</li>
            <li class='list-group-item'>Cena: {$row["cena"]}</li>
          </ul>
        </div>
      ";
    }
    echo "</div>";
    echo "</div>";
  } else {
    echo "Tabula nav datu ko attēlot";
  }
}

function getFilmBanners() //Šī funkcija iegūst filmu sarakstu no datu bāzes un to attēlo kā banerus (banners) HTML veidā.
{
  require("connection.php");
  $roomsSQL = "SELECT * FROM saraksts";
  $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");

  if (mysqli_num_rows($read_rooms) > 0) {
    $counter = 0;
    echo "<div class='row justify-content-center'>";
    while ($row = mysqli_fetch_assoc($read_rooms)) {
      echo "
        <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-4 text-center'>
          <a href='filmpage.php?id={$row["id_films"]}'><img src='{$row["saite"]}' alt='film' class='img-fluid' style='height: 500px;'></a>
        </div>
      ";
      $counter++;
      if ($counter % 2 === 0) {
        echo "</div>";
        echo "<div class='row justify-content-center'>";
      }
    }
    echo "</div>";
  } else {
    echo "Tabula nav datu ko attēlot";
  }
}

function getFilmList() //Šī funkcija iegūst filmu sarakstu no datu bāzes un to attēlo kā tabulu HTML veidā.
{
  require("connection.php");
  $roomsSQL = "SELECT * FROM filmu_list";
  $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");

  if (mysqli_num_rows($read_rooms) > 0) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($read_rooms)) {
      $i++;
      echo "
                <tr>
                <th scope='row'>{$i}</th>
                <td>{$row["nosaukums"]}</td>
                <td>{$row["zanrs"]}</td>
                <td>{$row["datums"]}</td>
                <td>{$row["laiks"]}</td>
                <td>{$row["cena"]}</td>
                <td>
                
                <a href='filmas.php?delete=" . $row["id_seansi"] . "' id='deleteBtn' class='btn btn-secondary btn-sm' style='display: inline-block; width: 38px; height: 32px; padding: 4px 8px;'>
                <div class='buttons'>
                  <i class='fa fa-close' style='font-size:20px;color:red'></i>
                </div>
                </a>

                <a data-seansID='" . $row["id_seansi"] . "' class='btn btn-secondary btn-sm editBtn' data-bs-toggle='modal' data-bs-target='#editModal' style='display: inline-block; width: 38px; height: 32px; padding: 4px 8px;'>
                <div class='buttons'>
                  <i class='fa fa-cog' style='font-size:20px'></i>
                </div>
                </a>
            </td>
            </tr>
            ";
    }
  } else {
    echo "Tabula nav datu ko attēlot";
  }
}

function getBiletes() //Šī funkcija ļauj izvadīt tabulu un apstiprināt pirkumu administratoram.
{
  require("connection.php");

  if ($_SESSION['admin'] == 1) {
    $roomsSQL = "SELECT * FROM biletes";
    $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
    if (mysqli_num_rows($read_rooms) > 0) {
      $i = 0;
      while ($row = mysqli_fetch_assoc($read_rooms)) {
        $i++;
        echo "
                <tr>
                    <th scope='row'>{$i}</th>
                    <td>{$row["username"]}</td>
                    <td>{$row["nosaukums"]}</td>
                    <td>{$row["datums"]}</td>
                    <td>{$row["laiks"]}</td>
                    <td>{$row["vieta"]}</td>
                    <td>{$row["rinda"]}</td>
                    <td class='rez-status'>
                      <input type='hidden' class='rez-status-id' value='{$row["bilete_statuss_id_bilete_statuss"]}'>
                      <input type='hidden' class='rez-pirksanu-laiks' value='{$row["pirksanu_laiks"]}'>
                      <span class='rez-result'>
                      
                      </span>
                    </td>
                    <td>
                      <a href='profile.php?pirkt=" . $row["id_bilete"] . "' class='btn btn-success btn-sm pirktButton' style='display: inline-block; padding: 0; width: 30px'>
                      <div class='buttons'>
                        <i class='fas fa-shopping-cart' style='font-size:15px;'></i>
                      </div>
                    </td>
                </tr>
            ";
      }
    } else {
      echo "Tabula nav datu ko attēlot";
    }
  } else {
    $roomsSQL = "SELECT * FROM biletes WHERE username='" . $_SESSION['username'] . "'";
    $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
    if (mysqli_num_rows($read_rooms) > 0) {
      $i = 0;
      while ($row = mysqli_fetch_assoc($read_rooms)) {
        $i++;
        echo "
          <tr>
            <th scope='row'>{$i}</th>
            <td>{$row["nosaukums"]}</td>
            <td>{$row["datums"]}</td>
            <td>{$row["laiks"]}</td>
            <td>{$row["vieta"]}</td>
            <td>{$row["rinda"]}</td>
            <td class='rez-status'>
                      <input type='hidden' class='rez-status-id' value='{$row["bilete_statuss_id_bilete_statuss"]}'>
                      <input type='hidden' class='rez-pirksanu-laiks' value='{$row["pirksanu_laiks"]}'>
                      <span class='rez-result'>
                      
                      </span>
                    </td>
            </tr>
        ";
      }
    } else {
      echo "Tabula nav datu ko attēlot";
    }
  }

}
function userlist() //Šī funkcija ļauj izvadīt lietotāju tabulu.
{
  require("connection.php");
  $roomsSQL = "SELECT * FROM userlist";
  $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");

  if (mysqli_num_rows($read_rooms) > 0) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($read_rooms)) {
      $i++;
      echo "
            <tr>
                <th scope='row'>{$i}</th>
                <td>{$row["username"]}</td>
                <td>{$row["count"]}</td>
                <td>{$row["admin"]}</td>
                <td>
                    <a href='profile.php?changeStatus=" . $row["id_login"] . "' id='deleteBtn'>
                    <button type='button' class='btn btn-secondary btn-sm'>
                      Nomainīt statusu
                    </button>
                    </a>
                    </td>
            </tr>
            ";
    }
  } else {
    echo "Tabula nav datu ko attēlot";
  }
}

function getFooter()
{
  ?>
  <footer class="text-center text-lg-start text-white" style="background-color: #732f2f">
    <section class="d-flex justify-content-between p-4" style="background-color: #a83c3c">
    </section>

    <section class="">
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3 pb-md-0 mb-0">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">GRONEMA</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
            <p>
              Mūsu uzņēmums tika dibināts 2023. gadā un jau tagad ir viens no labākajiem kinoteātriem.
            </p>
          </div>

          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold">kontaktinformācija</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
            <p><i class="fas fa-home mr-3"></i> nikitogka@gmail.com</p>
            <p><i class="fas fa-envelope mr-3"></i> +371 25373811</p>
          </div>
        </div>
      </div>
    </section>
    <div class="text-center p-3 mb-0 d-none d-sm-block"> <!-- Добавлены классы d-none и d-sm-block -->
      <span class="d-block d-sm-inline-block mb-2 mb-sm-0">©2023</span>
      <span class="d-block d-sm-inline-block">Nikita Groshev</span>
    </div>
  </footer>
  <?php
}


?>