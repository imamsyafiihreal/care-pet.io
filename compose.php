<?php
session_start();
//PENGECEKAN LOGIN USER
if (!isset($_SESSION["name_user"])) {
    header("location: login.php");
    exit;
}
//IMPORT MODULE KONEKSI DAN VALIDASI
include "system/validate.php";
include "system/connect.php";

//INISIALISASI VARIABEL ERROR
$error = "";
$contentErr = "";

//PROSES SAAT MEMBUAT PERTANYAAN
if ($_POST) {
    required($contentErr, "content_question");
    //JIKA TIDAK ADA ERROR DI INPUTAN
    if ($contentErr == "") {
        //(TRICKY CONSEPT)
        //LANGKAH PERTAMA INSERT TOPIC DARI PERTANYAAN TSB
        $statementTopic = $db->prepare("INSERT INTO topic (name_topic) VALUES (:name_topic)");
        $statementTopic->bindValue(":name_topic", $_POST['name_topic']);
        $statementTopic->execute();
        //AMBIL NILAI ID NYA DENGAN CARA AMBIL DATA TERAKHIR 
        $statementIdTopic = $db->query("SELECT * FROM topic ORDER BY id_topic DESC LIMIT 1");
        foreach ($statementIdTopic as $row) {
            //LANGKAH KEDUA INSERT PERTANYAANNYA DAN TOPIC 
            $statement = $db->prepare("INSERT INTO question (id_user, id_topic, content_question) VALUES (:id_user ,:id_topic, :content_question)");
            $statement->bindValue(':id_user', $_SESSION['id_user']);
            $statement->bindValue(':id_topic', $row['id_topic']);
            $statement->bindValue(':content_question', $_POST['content_question']);
            $statement->execute();
        }
        //AMBIL NILAI ID PERTANYAAN NYA (KARENA AUTO_INCREAMENT PASTI ID YANG TERAKHIR)
        $statementIdQuestion = $db->query("SELECT * FROM question ORDER BY id_question DESC LIMIT 1");
        foreach ($statementIdQuestion as $row1) {
            //LANGKAH KETIGA MEMBUAT JAWABAN KOSONG(SEPERTI WADAH)
            $statementAnswer = $db->prepare("INSERT INTO answer (id_user,id_question, content_answer) VALUES (1,:id_question, '')");
            $statementAnswer->bindValue(":id_question", $row1['id_question']);
            $statementAnswer->execute();
        }

        header("location: index.php");
        exit();
    }
} ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pertanyaan | Care-pet</title>
</head>

<body>

    <?php
    //import navbar
    include "pages/layout/userHeader.php"; ?>

    <div class="wrapper">&emsp;</div>

    <div class="container">
        <div class="question-box">
            <a href="index.php" class="btn-white">kembali ke diskusi</a>
        </div>
        <div class="wrapper"></div>
        &emsp;&emsp;&emsp;&emsp;

        <?php
        //IMPORT SECTION BUAT PERTANYAAN
        include "pages/client/addQuestion.php"; ?>
    </div>

    <?php
    //IMPORT FOOTER
    include "pages/layout/footer.php";
    ?>
</body>

</html>