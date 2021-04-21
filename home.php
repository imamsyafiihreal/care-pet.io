<?php

if (!isset($_SESSION["name_user"])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Care-pet</title>
</head>

<body>

    <?php
    //HALAMAN HOME USER
    //IMPORT NAVBAR SESUDAH LOGIN(VERSI USER)
    include "pages/layout/userHeader.php";
    //CEK konten SESI USER (2=EXPERT)
    if ($_SESSION['status'] == 2) {
        include "pages/expert/userContent.php";
    } else {
        include "pages/client/userContent.php";
    }
    ?>

    <div class="wrapper">&emsp;</div>
    <?php
    //import footer
    include "pages/layout/footer.php"; ?>
</body>

</html>