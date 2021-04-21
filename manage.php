<?php
session_start();
//PENGECEKAN LOGIN SESSION
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
    //IMPORT NAVBAR USER
    include "pages/layout/userHeader.php";
    ?>

    <div class="wrapper">&emsp;</div>
    <div class="container">
        <div class="question-box">
            <a href="index.php" class="btn-white">kembali ke Diskusi</a>
        </div>

        <?php
        //IMPORT FIELD DISKUSI BERDASARKAN FILTER 
        include "pages/layout/admDisscussion.php"; ?>
    </div>



    <?php
    //IMPORT FOOTER
    include "pages/layout/footer.php"; ?>
</body>

</html>