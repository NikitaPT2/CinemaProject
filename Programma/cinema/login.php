<?php
 require('components.php');
 getHeader(false, 4);
 ?>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <?php
              require('connection.php');

              if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $query = "SELECT * FROM login WHERE username = '$username'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];
                $count = mysqli_num_rows($result);
                if ($count == 1 && password_verify($password, $hashedPassword)) {
                  $_SESSION['username'] = $username;
                  $_SESSION['admin'] = $row['admin'];
                  $_SESSION['userID'] = $row['id_login'];
                } else {
                  $msg = 'Kļuda!';
                }
              }

              if (!isset($_SESSION['username'])) {
              ?>

            <h3 class="mb-5" style="color:black;">Ielogoties</h3>

            <form method="post">
              <div class="form-outline mb-4">
                <input type="text" name="username" id="typeEmailX-2" class="form-control form-control-lg"
                  placeholder="login" />
                <label class="form-label" for="typeEmailX-2">Lietotājvārds</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg"
                  placeholder="password" />
                <label class="form-label" for="typePasswordX-2">Parole</label>
              </div>

              <button class="btn btn-danger btn-lg btn-block" type="submit">Ielogoties</button>
            </form>

            <?php
              }


              if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<h3>Jus esat: ' . $username . '</h3>';
                if ($_SESSION['admin'] == 1) {
                  echo '<h4><a href="filmas.php">Filmas</a></h4>';
                } else {
                  echo "<br><a href='profile.php'>Profils</a>";
                }

                echo "<h3><br><a href='logout.php'>Iziet</a></h3>";
              }else{
                echo '<h4><a href="register.php">Reģistreties</a></h4>';
              }
              mysqli_close($connection);
              ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php
getFooter();
?>
</body>

</html>