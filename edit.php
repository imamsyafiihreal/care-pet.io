<?php
session_start();

//PENGECEKAN LOGIN SESSIOM
if (!isset($_SESSION["name_user"])) {
    header("location: login.php");
    exit;
}
//IMPORT MODUL KONEKSI DAN VALIDASI
include "system/validate.php";
include "system/connect.php";

$error = "";
$contentErr = "";
//PENGAMBILAN NILAI SESI DARI VARIABEL URL
if (!isset($_SESSION["id_question"])) {
    $_SESSION["id_question"] = $_GET['id_question'];
} else {
    $id_question = $_SESSION["id_question"];
}

//VALIDASI EDIT PERTANYAAN CLIENT
if ($_SESSION['status'] == 1) {
    if ($_POST) {
        required($contentErr, 'content_question');
        if ($contentErr == "") {
            $statement = $db->prepare("UPDATE question SET content_question=:content_question WHERE id_question=:id_question");
            $statement->bindValue(':content_question', $_POST['content_question']);
            $statement->bindValue(':id_question', $_SESSION['id_question']);
            $statement->execute();

            //JIKA BERHASIL DI INPUT SESSION ID PERTANYAAN DI UNSET
            unset($_SESSION['id_question']);
            header("location: index.php");
            exit();
        }
    }
    //VALIDASI EDIT JAWABAN EXPERT
} else if ($_SESSION['status'] == 2) {
    if ($_POST) {
        required($contentErr, 'content_answer');
        if ($contentErr == "") {

            $statement = $db->prepare("UPDATE answer SET content_answer=:content_answer WHERE id_question=:id_question");
            $statement->bindValue(':content_answer', $_POST['content_answer']);
            $statement->bindValue(':id_question', $_SESSION['id_question']);
            $statement->execute();

            //JIKA BERHASIL DI INPUT SESSION ID PERTANYAAN DI UNSET
            unset($_SESSION['id_question']);
            header("location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Care-pet</title>
</head>

<body>
    <?php
    include "pages/layout/userHeader.php"; ?>
    <div class="wrapper">&emsp;</div>
    <?php

    if ($_SESSION['status'] == 1) {
        //IMPORT BAGIAN EDIT PERTANYAAN CLIENT
        include "pages/client/editQuestion.php";
    } else {
        //IMPORT BAGIAN EDIT JAWABAN EXPERT
        include "pages/expert/editReply.php";
    } ?>
    <?php include "pages/layout/footer.php";
    ?>
</body>

</html>