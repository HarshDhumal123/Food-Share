<?php
header('Access-Control-Allow-Origin: *');
define('SITE_ROOT', realpath(dirname(__FILE__)));

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
    header("Location: index.php");

include_once "./config/database.php";
include_once "./controller/functions.php";

if (isset($_POST['logSub'])) {
    $emailErr = $pwdErr = $nameErr = $lnameErr = $phoneErr = $categoryErr = $addErr = $cityErr = $pincodeErr = '';
    $fname = isset($_POST['fname']) && trim($_POST['fname'] != '') ? mysqli_real_escape_string($con, trim($_POST['fname'])) : '';
    $lname = isset($_POST['lname']) && trim($_POST['lname'] != '') ? mysqli_real_escape_string($con, trim($_POST['lname'])) : '';
    $email = isset($_POST['email_id']) && trim($_POST['email_id'] != '') ? mysqli_real_escape_string($con, trim($_POST['email_id'])) : '';
    $phone = isset($_POST['phoneNumber']) && trim($_POST['phoneNumber'] != '') ? mysqli_real_escape_string($con, trim($_POST['phoneNumber'])) : '';
    $category = isset($_POST['category']) && trim($_POST['category'] != '') ? mysqli_real_escape_string($con, trim($_POST['category'])) : '';
    $add1 = isset($_POST['address1']) && trim($_POST['address1'] != '') ? mysqli_real_escape_string($con, trim($_POST['address1'])) : '';
    $add2 = isset($_POST['address2']) && trim($_POST['address2'] != '') ? mysqli_real_escape_string($con, trim($_POST['address2'])) : '';
    $city = isset($_POST['city']) && trim($_POST['city'] != '') ? mysqli_real_escape_string($con, trim($_POST['city'])) : '';
    $pincode = isset($_POST['pincode']) && trim($_POST['pincode'] != '') ? mysqli_real_escape_string($con, trim($_POST['pincode'])) : '';
    $pwd = isset($_POST['password']) && trim($_POST['password'] != '') ? mysqli_real_escape_string($con, trim($_POST['password'])) : '';

    if ($email == '')
        $emailErr = "Email id is required";

    if ($phone == '')
        $phoneErr = "Contact number is required";

    if (strlen($phone) != 10)
        $phoneErr = "Contact number should be of length 10";

    if ($pwd == '')
        $pwdErr = "Password is required";

    if ($fname == '')
        $nameErr = "First name is required";

    if ($lname == '')
        $lnameErr = "Last name is required";

    if ($category == '')
        $categoryErr = "Category is required";

    if ($add1 == '' && $add2 == '')
        $addErr = "Address is required";

    if ($city == '')
        $cityErr = "City is required";

    if ($pincode == '')
        $pincodeErr = "Pincode is required";

    if (strlen($pincode) != 6)
        $pincodeErr = "pincode should be of length 6";

    if ($emailErr == '' && $pwdErr == '' && $nameErr == '' && $lnameErr == '' && $phoneErr == '' && $categoryErr == '' && $addErr == '' && $cityErr == '' && $pincodeErr == '') {
        $checkIsUser = json_decode(select_query($con, "*", "user_master", "enabled='1' AND email='" . $email . "'", "", "", ""));

        if (!empty($checkIsUser) && $checkIsUser != '') {
            $emailErr = "User already exist. Please try again";
        } else {
            $insertedUser = json_decode(insert_query($con, array('firstName', 'lastName', 'email', 'phoneNumber', 'password', 'category', 'addressLine1', 'addressLine2', 'city', 'pincode'), array($fname, $lname, $email, $phone, $pwd, $category, $add1, $add2, $city, $pincode), "user_master"));

            if ($insertedUser) {
                $checkIsUser = json_decode(select_query($con, "*", "user_master", "enabled='1' AND email='" . $email . "'", "", "", ""));
                foreach ($checkIsUser as $user) {
                    if ($user->password == $pwd) {
                        $_SESSION['logged_in'] = 1;
                        $_SESSION['uid'] = $user->id;
                        $_SESSION['category'] = $user->category;
                        $_SESSION['name'] = ucwords($user->fname . " " . $user->lname);

                        header("Location: index.php");
                    }
                    $pwdErr = "Please enter correct password";
                }
            }
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
    <title>Signup | Food Management</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/sweetalert2.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/login-style.css">

    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/font-awesome.js" crossorigin="anonymous"></script>
    <script src="./assets/js/sweetalert2.min.js"></script>
</head>

<body>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <h2><span class="fas fa-recycle"></span></h2>
                </span>
                <h4 class="company_title">Food Management</h4>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <form class="form-group" method="POST" action="">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="fname" class="form__input" placeholder="Enter your first name" <?php echo isset($fname) && $fname != '' ? 'value="' . $fname . '"' : ''; ?>>
                                    <?php echo isset($nameErr) && $nameErr != '' ? '<small class="text-danger">' . $nameErr . '</small>' : ''; ?>
                                </div>
                                <div class="col">
                                    <input type="text" name="lname" class="form__input" placeholder="Enter your last name" <?php echo isset($lname) && $lname != '' ? 'value="' . $lname . '"' : ''; ?>>
                                    <?php echo isset($lnameErr) && $lnameErr != '' ? '<small class="text-danger">' . $lnameErr . '</small>' : ''; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="email_id" class="form__input" placeholder="Enter Email Id" <?php echo isset($email) && $email != '' ? 'value="' . $email . '"' : ''; ?>>
                                    <?php echo isset($emailErr) && $emailErr != '' ? '<small class="text-danger">' . $emailErr . '</small>' : ''; ?>
                                </div>

                                <div class="col">
                                    <input type="number" name="phoneNumber" class="form__input" placeholder="Enter contact" <?php echo isset($phone) && $phone != '' ? 'value="' . $phone . '"' : ''; ?>>
                                    <?php echo isset($phoneErr) && $phoneErr != '' ? '<small class="text-danger">' . $phoneErr . '</small>' : ''; ?>
                                </div>
                            </div>
                            <div class="row justify-content-center py-1">
                                <input type="radio" name="category" value="0" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '0' ? 'checked' : ''; ?>> NGO
                                <input type="radio" name="category" value="1" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '1' ? 'checked' : ''; ?>> User
                                <input type="radio" name="category" value="2" class="custom-control custom-radio custom-control-inline mx-3" <?php echo isset($category) && $category != '' && $category == '2' ? 'checked' : ''; ?>> Farmer
                            </div>
                            <?php echo isset($categoryErr) && $categoryErr != '' ? '<small class="text-danger">' . $categoryErr . '</small>' : ''; ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="address1" class="form__input" placeholder="Enter address line1" <?php echo isset($add1) && $add1 != '' ? 'value="' . $add1 . '"' : ''; ?>>
                            <?php echo isset($addErr) && $addErr != '' ? '<small class="text-danger">' . $addErr . '</small>' : ''; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="address2" class="form__input" placeholder="Enter address line 2" <?php echo isset($add2) && $add2 != '' ? 'value="' . $add2 . '"' : ''; ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="city" class="form__input" placeholder="Enter city" <?php echo isset($city) && $city != '' ? 'value="' . $city . '"' : ''; ?>>
                            <?php echo isset($cityErr) && $cityErr != '' ? '<small class="text-danger">' . $cityErr . '</small>' : ''; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="number" name="pincode" class="form__input" placeholder="Enter pincode" <?php echo isset($pincode) && $pincode != '' ? 'value="' . $pincode . '"' : ''; ?>>
                            <?php echo isset($pincodeErr) && $pincodeErr != '' ? '<small class="text-danger">' . $pincodeErr . '</small>' : ''; ?>
                        </div>
                    </div>
                    <div class="row">
                        <input type="password" name="password" class="form__input" placeholder="Enter Password">
                        <?php echo isset($pwdErr) && $pwdErr != '' ? '<small class="text-danger">' . $pwdErr . '</small>' : ''; ?>
                    </div>
                    <div class="row">
                        <input type="submit" name="logSub" value="Signup" class="btn mx-auto">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid text-center footer">
        Made in <span class="text-danger"> &hearts; </span> by <a href="https://venturesystems.in/">Venture Systems</a>
    </div>
</body>

</html>