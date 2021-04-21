<?php
session_start();
//PENGECEKAN SESSION LOGIN
if (!isset($_SESSION["name_user"])) {
    header("location: login.php");
    exit;
}
include "system/connect.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Care-pet</title>
</head>

<body>
    <!--HALAMAN PROFILE-->
    <div class="container">
        <div class="content-left">
            <a href="index.php"><img src="assets/img/logo.png" alt="logo"></a>
            <div class="title">PRO-<br>FILE</div>
        </div>
        <?php

        $name_session = $_SESSION['name_user'];
        //LOAD DATA PROFILE BERDASARKAN SESI NAMA USER
        $statement = $db->prepare("SELECT * FROM users WHERE name_user=:name_user");
        $statement->bindValue(":name_user", $name_session);
        $statement->execute();

        foreach ($statement as $row) {

        ?>

            <div class="content-right">
                <div class="form">
                    <!--MENAMPILKAN DATA ISIAN PROFILE-->
                    <div class="field">
                        <label>Username</label>
                        <br>
                        <input type="text" name="name_user" class="inp" placeholder="&emsp;Duscha Pavlyuchenko" value="<?php echo "{$row['name_user']}"; ?>" disabled>
                    </div>
                    <div class="field">
                        <label>Phone Number</label>
                        <br>
                        <input type="text" name="phone_user" class="inp" placeholder="&emsp;08789898xxxx" value="<?php echo "{$row['phone_user']}"; ?>" disabled>
                    </div>
                    <div class="field">
                        <label>Email Address</label>
                        <br>
                        <input type="text" name="email_user" class="inp" placeholder="&emsp;example@gmail.com" value="<?php echo "{$row['email_user']}"; ?>" disabled>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <br>
                        <input type="text" name="password_user" class="inp" placeholder="&emsp;**********" value="<?php echo "********"; ?>" disabled>
                    </div>
                    <br>
                <?php } ?>
                <!--BUTTON EDIT PROFILE-->
                <a href="editprofile.php" class="btn-blue"> Edit Profile</a>
                <!--BUTTON LOG OUT-->
                <a href="logout.php" class="btn-blue">Log out</a>

                </div>
            </div>
    </div>

</body>

</html>