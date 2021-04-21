<?php
session_start();
// PENGECEKAN APAKAH BERDA PADA SESSION USER 
if (isset($_SESSION['name_user'])) {
    header("location: index.php");
    exit;
}
// IMPORT KONEKSI DATABASE DAN VALIDASI MASUKAN
include "system/connect.php";
include "system/validate.php";

//DEKLARASI VARIABEL KOSONG
$error = "";
$emailErr = $passErr = "";

//PENGECEKAN INPUTAN LOGIN
if ($_POST) {
    loginEmail($emailErr, "email_user"); //PENGECEKAN KESESUAI FORMAT EMAIL
    loginPass($passErr, 'password_user'); //PENGECEKAN KESESUAIN FORMAT PASSWORD
    if ($emailErr == "" && $passErr == "") {
        if (authacc($_POST["email_user"], $_POST['password_user'])) { //PENGECEKAN DI DATABASE
            $statement = $db->prepare("SELECT * FROM users WHERE email_user = :email_user"); //MENGAMBIL NILAI RECORD DARI DATABASE
            $statement->bindValue(":email_user", $_POST['email_user']);
            $statement->execute();

            //PEMBUATAN NAMA SESSION
            foreach ($statement as $row) {
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['status'] = $row['id_status'];
                $_SESSION['name_user'] = $row['name_user'];
            }
            header("location: index.php");
            exit();
        } else {
            $error = "Email or password didn't match";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log in | care-pet</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!--HALAMAN LOGIN-->
    <div class="container">
        <div class="content-left">
            <a href="index.php"><img src="assets/img/logo.png" alt="logo"></a>
            <div class="title">LOG-<br> IN</div>
        </div>
        <div class="content-right">
            <div class="form">
                <!--FORM LOGIN-->
                <form action="login.php" method="POST">
                    <div class="success-signup" style="color: white;"><?php ?></div>
                    <div class="field">
                        <label>Email</label>
                        <br>
                        <input type="text" name="email_user" class="inp" placeholder="&emsp;example@gmail.com" autocomplete="email">
                        <div class="error" style="color: red;"> <?php echo $emailErr;
                                                                ?> </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <br>
                        <input type="text" name="password_user" class="inp" placeholder="&emsp;********">
                        <div class="error" style="color: red;"> <?php echo $passErr; ?></div>
                    </div>
                    <div class="error" style="color: red;"> <?php echo $error;
                                                            ?> </div>
                    <input type="submit" name="submit" value="Submit" class="btn-blue"><br>
                    <p>Belum Memiliki akun? <a href="signup.php">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>