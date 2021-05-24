<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '/home/ddweba/testing-PHP-JS.ddwebapps.com/OOP_MVC_SG/controllers/controllerGlasaci.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="lib/js/vanillaJS_custom.js" type="text/javascript"></script>
        <script src="lib/js/jQuery_custom.js" type="text/javascript"></script>
    
        <title>Login page</title>
    </head>
    <body>

        <div class="container login-form">
            <h2 class="text-center">Логовање (Login)</h2>

            <form method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="username">Корисничко име (Username):</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <label for="pwd">Шифра (Password):</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <a href="#">Заборавили сте шифру? (Forgot password)</a>
                </div>
                <button type="submit" class="btn btn-primary" name="submit-btn">Улогуј се (Login)</button>
            </form>
            <?php
            if (isset($_POST['submit-btn'])) {
                if ((!isset($_POST['username'])) == '' && (!isset($_POST['pswd'])) == '') {
                    $username = $_POST['username'];
                    $password = $_POST['pswd'];

                    $ctrlGlasaci = new controllerGlasaci();
                    $rez = $ctrlGlasaci->checkLogin($username, $password);

                    //  var_dump($rez);
                    if ($rez) {
                        header("location: views/voiceForm.php");
                    } else {
                        echo '<h6 style="color: red;">Username or password is incorrect!</h6>';
                    }
                }
            }
            ?>
        </div>

   
    </body>
</html>
