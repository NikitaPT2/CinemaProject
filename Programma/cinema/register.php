<?php
require('components.php');
getHeader(false, 4);

if (isset($_POST["registerUser"])) {
    require('connection.php');
    $userName = $_POST["user-name"];
    $userParole = $_POST["user-pass"];
    $userVards = $_POST["user-vards"];
    $userUzvards = $_POST["user-uzvards"];
    $userTelefons = $_POST["user-telefons"];

    if (empty($userVards) || empty($userUzvards) || empty($userTelefons)) {
        echo "<script>alert('Lūdzu, aizpildiet visus obligātos laukus!');</script>";
    } else {
        $checkUser = 'SELECT * FROM login WHERE username = "' . $userName . '"';
        $userCount = mysqli_query($connection, $checkUser) or die(mysqli_error($connection));

        if (mysqli_num_rows($userCount) > 0) {
            echo "<script>alert('Jau ir tads lietotājs:" . $userName . "'); window.location = 'register.php' </script>";
        } else {
            $hashedPassword = password_hash($userParole, PASSWORD_DEFAULT);
            $query = "CALL createUser('" . $userName . "', '" . $hashedPassword . "', '" . $userVards . "', '" . $userUzvards . "', '" . $userTelefons . "');";

            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

            if ($result == 1) {
                
                echo "<script>alert('Reģistrācija veiksmīga!'); window.location = 'login.php'</script>";
            }
        }
    }
}
?>

<section class="vh-100" style="margin-top: 1px; margin-bottom: 70px;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h3 class="mb-5" style="color:black;">Reģistrēties</h3>
                        <form method="post">
                            <input type="hidden" name="registerUser" value="1">

                            <div class="form-outline mb-4">
                                <input type="text" name="user-name" id="typeEmailX-2"
                                    class="form-control form-control-lg" placeholder="E-pasts" required />
                                <label class="form-label" for="typeEmailX-2" style="color:black;">E-pasts</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="user-vards" id="typeEmailX-2"
                                    class="form-control form-control-lg" placeholder="Vards" required />
                                <label class="form-label" for="typeEmailX-2" style="color:black;">Vards</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="user-uzvards" id="typeEmailX-2"
                                    class="form-control form-control-lg" placeholder="Uzvārds" required />
                                <label class="form-label" for="typeEmailX-2" style="color:black;">Uzvārds</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="user-telefons" id="typeEmailX-2"
                                    class="form-control form-control-lg" placeholder="Telefons" required />
                                <label class="form-label" for="typeEmailX-2" style="color:black;">Telefona
                                    numurs</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="user-pass" id="typePasswordX"
                                    class="form-control form-control-lg" placeholder="Parole" required />
                                <label class="form-label" for="typePasswordX" style="color:black;">Parole</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="user-pass2" id="typePasswordX-2"
                                    class="form-control form-control-lg" placeholder="Parole vēlreiz" required />
                                <label class="form-label" for="typePasswordX-2" style="color:black;">Ievadi parole
                                    atkartoti</label>
                                <div class="pass-error" style="color:red; display:none;">Parolem jābūt vienādiem</div>
                                <div class="pass-error-2" style="color:red; display:none;">Parole neatbilst kritērijiem
                                    (jābūt vismaz 8 simboliem, 1 mazai burtai, 1 lielai burtai un 1 simbolam)</div>
                            </div>

                            <button class="btn btn-danger btn-lg btn-block" type="submit" id="registerButton"
                                disabled>Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
getFooter();
?>

<script src="https://code.jquery.com/jquery-3.6.2.js"></script>
<script>

    function isPasswordValid(password) {
        if (password.length < 8) {
            return false;
        }

        let hasLowerCase = false;
        let hasUpperCase = false;
        let hasDigit = false;
        let hasSpecialChar = false;

        for (let i = 0; i < password.length; i++) {
            const char = password[i];
            if (/[a-z]/.test(char)) {
                hasLowerCase = true;
            } else if (/[A-Z]/.test(char)) {
                hasUpperCase = true;
            } else if (/\d/.test(char)) {
                hasDigit = true;
            } else if (/[#$@!%&?-]/.test(char)) {
                hasSpecialChar = true;
            }
        }

        return hasLowerCase && hasUpperCase && hasDigit && hasSpecialChar;
    }

    $('#typePasswordX, #typePasswordX-2').on('change', function () {
        var pass1 = $('#typePasswordX').val();
        var pass2 = $('#typePasswordX-2').val();
        var errorBlock = $('.pass-error');
        var errorBlock2 = $('.pass-error-2');
        var registerButton = $('#registerButton');
        var buttonEnabled1 = false;
        var buttonEnabled2 = false;

        if (!isPasswordValid(pass1)) {
            errorBlock2.show();
            buttonEnabled1 = false;
        } else {
            errorBlock2.hide();
            buttonEnabled1 = true;
        }

        if (pass1 != pass2) {
            errorBlock.show();
            buttonEnabled2 = false;
        } else {
            errorBlock.hide();
            buttonEnabled2 = true;
        }

        if (buttonEnabled1 && buttonEnabled2) {
            registerButton.prop('disabled', false);
        } else {
            registerButton.prop('disabled', true);
        }
    });
</script>

</body>

</html>