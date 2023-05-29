<?php
function getHeader($isblack, $number)
{
  session_start();
  require('connection.php');
  $bodyclass = '';
  if ($isblack) {
    $bodyclass = 'class="blacks"';
  }
  $bold = 'font-weight-bold';
  $gronema = '';
  $saraksts = '';
  $filmas = '';
  $login = '';
  $profile = '';

  if ($number == 1) {
    $gronema = $bold;
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <link href="style.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">

</head>

<body <?php echo $bodyclass; ?> >
  <div class="header">
    <nav class="navbar navbar-expand-lg" style="background-color: #7c4dffc4;">
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
function getFilmSaraksts()
{
  require("connection.php");
  $roomsSQL = "SELECT * FROM filmu_list";
  $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");

  if (mysqli_num_rows($read_rooms) > 0) {
    while ($row = mysqli_fetch_assoc($read_rooms)) {
      echo "
                    <ul class='list-group'>
                    <li class='list-group-item'><img src='{$row["saite"]}' alt='film'></li>
                    <li class='list-group-item'>Nosaukums: {$row["nosaukums"]}</li>
                    <li class='list-group-item'>Žanrs: {$row["zanrs"]}</li>
                    <li class='list-group-item'>Datums: {$row["datums"]}</li>
                    <li class='list-group-item'>Laiks: {$row["laiks"]}</li>
                    <li class='list-group-item'>Cena: {$row["cena"]}</li>
                    <li class='list-group-item'>
                    <button type='button' class='btn btn-success'>Rezervēt</button>
                    </li>
                    </ul>
                ";
    }
  } else {
    echo "Tabula nav datu ko attēlot";
  }
}

function getFilmList()
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
                <a href='filmas.php?delete=" . $row["id_films"] . "' id='deleteBtn'>
                <button type='button' class='btn btn-secondary btn-sm'>
                
                <div class='buttons'>
                  <i class='fa fa-close' style='font-size:20px;color:red'></i>
                </div>
                </button>
                </a>

                <button type='button' class='btn btn-secondary btn-sm'>
                <div class='buttons'>
                  <i class='fa fa-cog' style='font-size:20px'></i>
                </div>
              </button>
            </td>
            </tr>
            ";
    }
  } else {
    echo "Tabula nav datu ko attēlot";
  }
}

function getBiletes()
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
                    <td>{$row["zale_numurs"]}</td>
                    <td>{$row["reservets"]}</td>
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
                    <td>{$row["datums"]}</td>
                    <td>{$row["laiks"]}</td>
                    <td>{$row["vieta"]}</td>
                    <td>{$row["rinda"]}</td>
                    <td>{$row["zale_numurs"]}</td>
                    <td>{$row["reservets"]}</td>
                </tr>
            ";
      }
    } else {
      echo "Tabula nav datu ko attēlot";
    }
  }

}
function userlist()
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
  ?>