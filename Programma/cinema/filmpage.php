<?php
require('components.php');
require('connection.php');
getHeader(false, 2);
?>

<div class="content">
  <div class="filmlist"
    style="background-color: #333; width:1600px; margin: 20px auto; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
    <?php
    $id = $_GET['id'];
    $roomsSQL = "SELECT * FROM films flm INNER JOIN papildu_info pi ON flm.papildu_info_idpapildu_info = pi.idpapildu_info INNER JOIN media md ON md.id_media = flm.media_id_media WHERE id_films = '{$id}'";
    $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");
    if (mysqli_num_rows($read_rooms) > 0) {
      while ($row = mysqli_fetch_assoc($read_rooms)) {
        echo "
          <div class='container text-center' style='margin: 0 auto;'>
          <div class='row' style='display: flex; justify-content: center; align-items: center;'>
          <div class='col-md-12' style='color:white;'> <h1>{$row["nosaukums"]}</h1> <input type='hidden' class='film-id' value='{$row["id_films"]}'></div>
          <div class='col-md-12' style='min-height:100px; min-width:300px; width: auto;'> <img src='{$row["saite"]}' alt=''> </div>
          <div class='col-md-12' style='color:white;'> <p>{$row["zanrs"]}</p> </div>
          <p style='word-wrap: break-word; word-break: break-all;'>{$row["apraksts"]}</p>
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
        <div class="col-md-12 align-self-end">
          <h1 style="color:white;"> Seansi </h1>
          <hr>
          <?php
          function getValoda($valodas)
          {
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

          $monthsLatvian = array(
            1 => 'janvāris',
            2 => 'februāris',
            3 => 'marts',
            4 => 'aprīlis',
            5 => 'maijs',
            6 => 'jūnijs',
            7 => 'jūlijs',
            8 => 'augusts',
            9 => 'septembris',
            10 => 'oktobris',
            11 => 'novembris',
            12 => 'decembris'
          );

          $id = $_GET['id'];
          $roomsSQL = "
            SELECT * 
            FROM films flm 
            INNER JOIN seansi sns ON sns.films_id_films = flm.id_films 
            WHERE id_films = '{$id}' AND (sns.datums >= CURDATE() OR sns.datums IS NULL)
          ";
          $read_rooms = mysqli_query($connection, $roomsSQL) or die("Nekorekts vaicājums");

          if (mysqli_num_rows($read_rooms) > 0) {
            while ($row = mysqli_fetch_assoc($read_rooms)) {
              $valodasSection = getValoda($row["valoda"]);
              $display = $row["active"];
              $displayStr = $display ? '' : 'hidden';

              $timestamp = strtotime($row['datums']);
              $day = date('j', $timestamp);
              $month = date('n', $timestamp);
              $formattedDate = $day . '. ' . $monthsLatvian[$month];
              $isLogin = isset($_SESSION['username']);
              echo "
                <div class='container' {$displayStr} style='color:white; margin-bottom: 10px;'>
                    <div class='row' style='margin: 0;'>
                        <div class='col-md-2'>{$formattedDate}</div>
                        <div class='col-md-2'>{$row["laiks"]}</div>
                        <div class='col-md-2'>{$row["vecums"]}</div>
                        <div class='col-md-2'>{$valodasSection}</div>
                        <div class='col-md-1'> 
                          <button type='button' data-isLogin='$isLogin' data-seanss='{$row["id_seansi"]}' class='btn btn-danger btn-rezerv' data-bs-toggle='modal' data-bs-target='#exampleModal'>Rezervēt</button>
                        </div>
                    </div>
                    <hr>
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

  <!-- Modal -->
  <div class="modal fade rezervet-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            Vietas izvēle
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="rezervet-film">

            <ul class="showcase">
              <li>
                <div class="seat"></div>
                <small>N/A</small>
              </li>
              <li>
                <div class="seat selected"></div>
                <small>Izvelētas</small>
              </li>
              <li>
                <div class="seat occupied"></div>
                <small>Aizņemts</small>
              </li>
              <li>
                <div class="seat rezerved"></div>
                <small>Rezervēts</small>
              </li>
            </ul>

            <div class="container">
              <div class="screen"></div>
              <div class="seats">
                <div class="row">
                  <div class="seat" data-rinda="1" data-vieta="1"></div>
                  <div class="seat" data-rinda="1" data-vieta="2"></div>
                  <div class="seat" data-rinda="1" data-vieta="3"></div>
                  <div class="seat" data-rinda="1" data-vieta="4"></div>
                  <div class="seat" data-rinda="1" data-vieta="5"></div>
                  <div class="seat" data-rinda="1" data-vieta="6"></div>
                  <div class="seat" data-rinda="1" data-vieta="7"></div>
                  <div class="seat" data-rinda="1" data-vieta="8"></div>
                  <div class="seat" data-rinda="1" data-vieta="9"></div>
                  <div class="seat" data-rinda="1" data-vieta="10"></div>
                </div>
                <div class="row">
                  <div class="seat" data-rinda="2" data-vieta="1"></div>
                  <div class="seat" data-rinda="2" data-vieta="2"></div>
                  <div class="seat" data-rinda="2" data-vieta="3"></div>
                  <div class="seat" data-rinda="2" data-vieta="4"></div>
                  <div class="seat" data-rinda="2" data-vieta="5"></div>
                  <div class="seat" data-rinda="2" data-vieta="6"></div>
                  <div class="seat" data-rinda="2" data-vieta="7"></div>
                  <div class="seat" data-rinda="2" data-vieta="8"></div>
                  <div class="seat" data-rinda="2" data-vieta="9"></div>
                  <div class="seat" data-rinda="2" data-vieta="10"></div>
                </div>
                <div class="row">
                  <div class="seat" data-rinda="3" data-vieta="1"></div>
                  <div class="seat" data-rinda="3" data-vieta="2"></div>
                  <div class="seat" data-rinda="3" data-vieta="3"></div>
                  <div class="seat" data-rinda="3" data-vieta="4"></div>
                  <div class="seat" data-rinda="3" data-vieta="5"></div>
                  <div class="seat" data-rinda="3" data-vieta="6"></div>
                  <div class="seat" data-rinda="3" data-vieta="7"></div>
                  <div class="seat" data-rinda="3" data-vieta="8"></div>
                  <div class="seat" data-rinda="3" data-vieta="9"></div>
                  <div class="seat" data-rinda="3" data-vieta="10"></div>
                </div>
                <div class="row">
                  <div class="seat" data-rinda="4" data-vieta="1"></div>
                  <div class="seat" data-rinda="4" data-vieta="2"></div>
                  <div class="seat" data-rinda="4" data-vieta="3"></div>
                  <div class="seat" data-rinda="4" data-vieta="4"></div>
                  <div class="seat" data-rinda="4" data-vieta="5"></div>
                  <div class="seat" data-rinda="4" data-vieta="6"></div>
                  <div class="seat" data-rinda="4" data-vieta="7"></div>
                  <div class="seat" data-rinda="4" data-vieta="8"></div>
                  <div class="seat" data-rinda="4" data-vieta="9"></div>
                  <div class="seat" data-rinda="4" data-vieta="10"></div>
                </div>
                <div class="row">
                  <div class="seat" data-rinda="5" data-vieta="1"></div>
                  <div class="seat" data-rinda="5" data-vieta="2"></div>
                  <div class="seat" data-rinda="5" data-vieta="3"></div>
                  <div class="seat" data-rinda="5" data-vieta="4"></div>
                  <div class="seat" data-rinda="5" data-vieta="5"></div>
                  <div class="seat" data-rinda="5" data-vieta="6"></div>
                  <div class="seat" data-rinda="5" data-vieta="7"></div>
                  <div class="seat" data-rinda="5" data-vieta="8"></div>
                  <div class="seat" data-rinda="5" data-vieta="9"></div>
                  <div class="seat" data-rinda="5" data-vieta="10"></div>
                </div>
              </div>
              <div style="display: flex; justify-content: center; align-items: center;">
                <p class="text">Jūs esat izvēlējies <span id="seatsSelected">0</span> vietu par €<span
                    id="totalPrice">0</span></p>
              </div>
              <p class="text" style="margin-bottom:0;">Maksājuma saite Swedbank klientiem: <img src="https://cdn-icons-png.flaticon.com/256/4856/4856460.png" alt="Unicode Attēls" style="width:40px"></p>
              <a style="color:white;" href="https://www.swedbank.lv/pay?id=71kf2rfl2tn2"
                target="_blank">https://www.swedbank.lv/pay?id=71kf2rfl2tn2</a>
              <p class="text">(detalizēta informācija par maksājumu atrodas sadaļā "Informacija")
              </p>
            </div>
          </div>
          <div class="modal-footer">
            Uzrakstiet atbildi uz piemēru:<span class="piemeru-list">2+2=</span>
            <input type="text" class="answer" data-answer="4">
            <form id="sendRezerv" method="POST" name="sendRezerv">
              <input type="hidden" name="seansid" class="seansid">
              <input type="hidden" name="vietas" class="vietas-hdn">
              <input type="submit" class="btn btn-danger nopirkt" value="Nopirkt" style="display:none;">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST["seansid"])) {
    require('connection.php');
    $seansID = $_POST["seansid"];
    $filmVietas = $_POST["vietas"];
    $json = $filmVietas;
    $array = json_decode($json, true);
    foreach ($array['vietas'] as $item) {
      $row = $item['row'];
      $col = $item['col'];
      // echo "row: $row, col: $col" . PHP_EOL;
      $query = "CALL nopirktBilete(" . $row . "," . $col . ", " . $seansID . ", " . $_SESSION['userID'] . ");";
      $read_rooms = mysqli_query($connection, $query) or die("Nekorekts vaicājums");
    }
  }
  ?>
  <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4="
    crossorigin="anonymous"></script>

  <script>
    $(document).ready(function () {
      var movieSelected = 5;
      var seatsSelected = $('#seatsSelected');
      var totalPrice = $('#totalPrice');
      var container = $('.container');

      function updatePrice() {
        var selectedSeats = $('.container .seat.selected:not(.occupied, .rezerved)');
        var selectedSeatsCount = selectedSeats.length;

        totalPrice.text(selectedSeatsCount * +movieSelected);
        seatsSelected.text(selectedSeatsCount);
      }

      function selectSeat(seat) {
        $(seat).toggleClass('selected');
        updatePrice();
      }

      function updateHidden() {
        var hidden = $('.vietas-hdn');
        var json = {
          vietas: []
        };

        $('.seat.selected').each(function () {
          var row = $(this).data('rinda');
          var col = $(this).data('vieta');

          if (row !== undefined && col !== undefined) {
            json.vietas.push({ row: row, col: col });
          }
        });

        hidden.val(JSON.stringify(json));
        console.log(hidden.val());
      }

      function clearStatuses() {
        var seats = $('.container .seat');
        seats.removeClass('occupied');
        seats.removeClass('rezerved');
      }

      $('.answer').on('change', function () {
        var answer = $(this).data('answer')
        if ($(this).val() == answer) {
          $('.nopirkt').show()
        }
      })
      container.on('click', '.seat:not(.occupied)', function (e) {
        e.preventDefault();
        selectSeat(e.target);
        updateHidden();
      });
      $(".btn-rezerv").click(function () {
        var isLogin = $(this).data('islogin');
        if (isLogin !== 1) {
          window.location.replace("/cinema/login.php");
        }
        clearStatuses();
        var seansID = $(this).data('seanss');
        $('.seansid').val(seansID);
        $.ajax({
          url: "getbiletes.php",
          type: "POST",
          data: { param1: seansID },
          success: function (response) {
            console.log(response);
            var result = JSON.parse(response);

            result.result.forEach(function (item) {
              var $seat = $('.seat[data-rinda="' + item.row + '"][data-vieta="' + item.col + '"]');
              // Check if the element exists
              if ($seat.length) {
                if (item.status == 1) {
                  $seat.addClass('rezerved');
                } else {
                  $seat.addClass('occupied');
                }
              }
            })
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });
    });

  </script>

  <?php
  getFooter();
  ?>
  </body>

  </html>