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

                $query = "SELECT * FROM login WHERE username = '$username' and password = '$password'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));


                $count = mysqli_num_rows($result);
                if ($count == 1) {
                  $row = mysqli_fetch_assoc($result);

                  $_SESSION['username'] = $username;
                  $_SESSION['admin'] = $row['admin'];
                  #header('Location: authorize.php');
                } else {
                  $msg = 'Kļuda!';
                }
              }

              if (!isset($_SESSION['username'])) {
              ?>

            <h3 class="mb-5">Sign in</h3>

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

              <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
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
                echo '<h4><a href="register.php">Register</a></h4>';
              }
              mysqli_close($connection);
              ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">

  <section class="d-flex justify-content-between p-4" style="background-color: #7c4dffc4">
  </section>

  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold">GRONEMA</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
          <p>
            Mūsu uzņēmums tika dibināts 2022. gadā un jau tagad ir viens no labākajiem kinoteātriem.
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
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">©2022 Copyright:
    <a class="text-white">Nikita Groshev</a>
  </div>
</footer>
</body>

</html>