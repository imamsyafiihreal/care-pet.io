<?php
session_start();

if (isset($_SESSION['name_user'])) {
    header("location: user/index.php");
    exit;
}
//IMPORT MODUL KONEKSI DAN VALIDASI
include "system/validate.php";
include "system/connect.php";

$error = "";
$usernameErr = $phoneErr = $emailErr = $passErr = ""; //deklarasi variabel validasi inputan login


if ($_POST) {
    //VALIDASI MASUKAN
    validUsername($usernameErr, 'name_user');
    validEmail($emailErr, 'email_user');
    validPhone($phoneErr, 'phone_user');
    validPassword($passErr, 'password_user');
    //PENGECEKAN
    if ($usernameErr == "" && $emailErr == "" && $phoneErr == "" && $passErr == "") {
        //PENAMBAHAN DATA USER
        $statement = $db->prepare("INSERT INTO users (id_status, name_user, email_user,password_user,phone_user) VALUES (:id_status, :name_user, :email_user, SHA2(:password_user,0),:phone_user)");
        //PARAMETER NILAI BERDASARKAN MASUKAN FORM
        $statement->bindValue(":name_user", $_POST['name_user']);
        $statement->bindValue(":phone_user", $_POST['phone_user']);
        $statement->bindValue(":email_user", $_POST['email_user']);
        $statement->bindValue(":password_user", $_POST['password_user']);
        $statement->bindValue(":id_status", $_POST['status']);
        $statement->execute();

        header("location: login.php");
        exit();
    } else {
        echo "gagal";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Sign Up | care-pet</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container">
        <div class="content-left">
            <a href="index.php"><img src="assets/img/logo.png" alt="logo"></a>
            <div class="title">SIGN- <br>UP</div>
        </div>
        <div class="content-right-signup">
            <div class="form">

                <form action="signup.php" method="POST">
                    <div class="field">
                        <label>Sign Up As</label>
                        <br><select name="status" id="status">
                            <option value="0" disabled>--- Select ---</option>
                            <option value="1">client</option>
                            <option value="2">expert</option>
                        </select></div>
                    <div class="field">
                        <label>Username</label>
                        <br>
                        <input type="text" name="name_user" class="inp" placeholder="&emsp;Duscha Pavlyuchenko">
                        <div class="error" style="color: red;"> <?php echo $usernameErr;
                                                                ?> </div>
                    </div>
                    <div class="field">
                        <label>Phone Number</label>
                        <br>
                        <input type="text" name="phone_user" class="inp" placeholder="&emsp;08789898xxxx">
                        <div class="error" style="color: red;"> <?php echo $phoneErr;
                                                                ?> </div>
                    </div>
                    <div class="field">
                        <label>Email Address</label>
                        <br>
                        <input type="text" name="email_user" class="inp" placeholder="&emsp;example@gmail.com">
                        <div class="error" style="color: red;"> <?php echo $emailErr;
                                                                ?> </div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <br>
                        <input type="text" name="password_user" class="inp" placeholder="&emsp;********">
                        <div class="error" style="color: red;"> <?php echo $passErr;
                                                                ?> </div>
                    </div>

                    <input type="submit" name="submit" value="Submit" class="btn-green"><br>
                    <p>Sudah punya akun? <a href="login.php">Log in</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>