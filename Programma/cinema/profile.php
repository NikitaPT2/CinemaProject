<?php
require('components.php');
getHeader(true, 5);
?>

<div class="content">
  <section style="background-color: #212529;">
    <div class="container py-5">

      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="foto/man.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3" style="color:black;">
                <?php
                echo $_SESSION['username'];
                ?>
              </h5>
            </div>
          </div>

        </div>
        <div class="col-lg-8">
          <div class="row">
            <h4 style="color:white;">Rezervācijas tabula</h4>
            <div class="col-md-12" style="color:black;">
              <div class="card mb-4 mb-md-0">
                <table>
                  <thead>
                    <tr>

                      <th scope="col">#</th>
                      <?php
                      if ($_SESSION['admin'] == 1) {
                        echo '<th scope="col">E-pasts</th>';
                      }
                      ?>
                      <th scope="col">Filma nosaukums</th>
                      <th scope="col">Datums</th>
                      <th scope="col">Laiks</th>
                      <th scope="col">Vieta</th>
                      <th scope="col">Rinda</th>
                      <th scope="col">Rezervēts</th>

                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    getBiletes();
                    ?>
                  </tbody>
                </table>

              </div>
            </div>

            <?php
            if ($_SESSION['admin'] == 1) {
              ?>
              <h4 style="color:white;">Lietotāju saraksts</h4>
              <div class="col-md-12" style="color:black;">
                <div class="card mb-4 mb-md-0">
                  <table>
                    <thead>
                      <tr>

                        <th scope="col">#</th>

                        <th scope="col">Login</th>
                        <th scope="col">Rezervēšanas skaits (count)</th>
                        <th scope="col">Admin status</th>

                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      userlist();
                      if (isset($_GET["changeStatus"])) {
                        $userID = $_GET["changeStatus"];
                        require('connection.php');

                        $query = "CALL changeRights(" . $userID . ");";

                        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

                        if ($result == 1) { ?>
                          <script> window.location = window.location.pathname </script>
                          <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>

                </div>
              </div>
              <?php
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>
 <?php
  if (isset($_GET["pirkt"])) {
        $pirktID = $_GET["pirkt"];
        require('connection.php');

        $query = "CALL pirktBilete(" . $pirktID . ");";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($result == 1) { ?>
          <script> window.location = window.location.pathname </script>
          <?php
        }
      }
?>

</div>

<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4="
    crossorigin="anonymous"></script>

<script>
  $(document).ready(function () {
    function hideButton(item) {
      $(item).next().find('.pirktButton').hide();
    }
    setInterval(function () {
      var reservedStatuses = $('.rez-status');
      reservedStatuses.each(function () {
        var item = $(this);
        var time = item.find('.rez-pirksanu-laiks')
        var statusID = item.find('.rez-status-id')
        var text = item.find('.rez-result')

        if (statusID.val() === '2') {
          text.text('Nopirkts')
          hideButton(item);
        }else{
          var currentTime = Math.floor(new Date().getTime() / 1000);
          var targetTime = Math.floor(new Date(time.val()).getTime() / 1000)+ (30 * 60);
          var timeDiff = targetTime - currentTime;
          if (timeDiff>0){
            var minutes = Math.floor(timeDiff / 60);
            var seconds = timeDiff % 60;
            var timer = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
            text.text('Pirkšanas laiks ' + timer);
          }else{
            hideButton(item);
            text.text('Atcelts');
          }
          console.log(timeDiff);
        }
      })
    }, 1000);
  });
</script>

<?php
getFooter();
?>

</body>

</html>