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
              <h5 class="my-3">
                <?php
                echo $_SESSION['username'];
                ?>
              </h5>
            </div>
          </div>

        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Login</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php
                    echo $_SESSION['username'];
                    ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <h4 style="color:white;">Rezervācijas tabula</h4>
            <div class="col-md-12">
              <div class="card mb-4 mb-md-0">
                <table>
                  <thead>
                    <tr>

                      <th scope="col">#</th>
                      <?php
                      if ($_SESSION['admin'] == 1) {
                        echo '<th scope="col">Login</th>';
                      }
                      ?>
                      <th scope="col">Filma nosaukums</th>
                      <th scope="col">Datums</th>
                      <th scope="col">Laiks</th>
                      <th scope="col">Vieta</th>
                      <th scope="col">Rinda</th>
                      <th scope="col">Zale numurs</th>
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
            <div class="col-md-12">
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


</div>

<?php
getFooter();
?>

</body>

</html>