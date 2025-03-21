<?php
header('Access-Control-Allow-Origin: *');
define('SITE_ROOT', realpath(dirname(__FILE__)));

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
    header("Location: index.php");

include_once "./config/database.php";
include_once "./controller/functions.php";

if (isset($_POST['logSub'])) {
    $emailErr = $pwdErr = '';
    $email = isset($_POST['email_id']) && trim($_POST['email_id'] != '') ? mysqli_real_escape_string($con, trim($_POST['email_id'])) : '';
    $pwd = isset($_POST['password']) && trim($_POST['password'] != '') ? mysqli_real_escape_string($con, trim($_POST['password'])) : '';

    if ($email == '')
        $emailErr = "Email id is required";

    if ($pwd == '')
        $pwdErr = "Password is required";

    if ($emailErr == '' && $pwdErr == '') {
        $checkIsUser = json_decode(select_query($con, "*", "user_master", "enabled='1' AND (email='" . $email . "' OR phoneNumber='". $email ."')", "", "", ""));

        if (!empty($checkIsUser) && $checkIsUser != '') {
            foreach ($checkIsUser as $user) {
                if ($user->password == $pwd) {
                    $_SESSION['logged_in'] = 1;
                    $_SESSION['uid'] = $user->id;
                    $_SESSION['category'] = $user->category;
                    $_SESSION['name'] = ucwords($user->firstName . " " . $user->lastName);

                    header("Location: index.php");
                }
                $pwdErr = "Please enter correct password";
            }
        } else {
            $emailErr = "Email id not found. Please check your username and try again";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Food Share</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/sweetalert2.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/login-style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <script src="./assets/js/font-awesome.js" crossorigin="anonymous"></script>
    <script src="./assets/js/sweetalert2.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
</head>

<body>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <h2><span class="fas fa-recycle"></span></h2>
                </span>
                <h4 class="company_title">Food Share</h4>
            </div>
            <div class="col-md-8 col-xs-12 login_form">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <form class="form-group" method="POST" action="">
                            <div class="row">
                                <input type="text" name="email_id" class="form__input" placeholder="Enter Username" <?php echo isset($email) && $email != '' ? 'value="' . $email . '"' : ''; ?>>
                                <?php echo isset($emailErr) && $emailErr != '' ? '<small class="text-danger">' . $emailErr . '</small>' : ''; ?>
                            </div>
                            <div class="row">
                                <!-- <span class="fa fa-lock"></span> -->
                                <input type="password" name="password" class="form__input" placeholder="Enter Password">
                                <?php echo isset($pwdErr) && $pwdErr != '' ? '<small class="text-danger">' . $pwdErr . '</small>' : ''; ?>
                            </div>
                            <div class="row">
                                <input type="submit" name="logSub" value="Login" class="btn mx-auto">
                            </div>
                        </form>
                    </div>

                    <div class="row justify-content-center pyw-3">
                        <a href="signup.php">Not registered yet? Signup here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>