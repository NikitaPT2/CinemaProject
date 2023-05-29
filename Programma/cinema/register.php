<?php
require('components.php');
getHeader(false, 4);
if (isset($_POST["registerUser"])) {
    require('connection.php');
    $userName = $_POST["user-name"];
    $userParole = $_POST["user-pass"];

    $checkUser = 'SELECT * FROM login WHERE username = "' . $userName . '"';

    $userCount = mysqli_query($connection, $checkUser) or die(mysqli_error($connection));

    if (mysqli_num_rows($userCount) > 0) {
        echo "<script>alert('Jau ir tads lietotājs:" . $userName . "'); window.location = 'register.php' </script>";
    } else {
        $query = "CALL createUser('" . $userName . "', '" . $userParole . "');";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($result == 1) { ?>
            <script> window.location = 'login.php' </script>
            <?php
        }
    }
}
?>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Sign up</h3>

                        <form method="post">
                            <input type="hidden" name="registerUser" value="1">
                            <div class="form-outline mb-4">
                                <input type="text" name="user-name" id="typeEmailX-2"
                                    class="form-control form-control-lg" placeholder="login" />
                                <label class="form-label" for="typeEmailX-2">Lietotājvārds</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="user-pass" id="typePasswordX"
                                    class="form-control form-control-lg" placeholder="password" />
                                <label class="form-label" for="typePasswordX">Parole</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="user-pass2" id="typePasswordX-2"
                                    class="form-control form-control-lg" placeholder="password" />
                                <label class="form-label" for="typePasswordX-2">Ievadi parole atkartoti</label>
                                <div class="pass-error" style="color:red; display:none;">Parolem jābūt vienādiem</div>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit" id="registerButton"
                                disabled>Register</button>
                        </form>

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
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p>
                        Mūsu uzņēmums tika dibināts 2022. gadā un jau tagad ir viens no labākajiem kinoteātriem.
                    </p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">kontaktinformācija</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #7c4dff; height: 2px" />
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
<script src="https://code.jquery.com/jquery-3.6.2.js"></script>
<script>
    $('#typePasswordX, #typePasswordX-2').on('change', function () {
        var pass1 = $('#typePasswordX').val();
        var pass2 = $('#typePasswordX-2').val();
        var errorBlock = $('.pass-error');
        var registerButton = $('#registerButton');

        if (pass1 != pass2) {
            errorBlock.show();
            registerButton.prop('disabled', true);
        } else {
            errorBlock.hide();
            registerButton.prop('disabled', false);
        }
    });
</script>

</body>

</html>