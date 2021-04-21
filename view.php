<?php
session_start();
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
    <title>view | Care-Pet</title>
</head>

<body>
    <!--NAVBAR-->
    <?php
    include "pages/layout/userHeader.php";
    ?>

    <div class="wrapper">&emsp;</div>
    <!--SECTION VIEW DISKUSI-->
    <div class="question-box">
        <a href="index.php" class="btn-white">Back to Disscussion</a>
    </div>
    <div class="wrapper">&emsp;</div>
    <div class="form-question">

        <div class="form-field">
            <h1>Jawaban Pertanyaan</h1>
            <div class="field">
                <p><?php
                    //MENAMPILKAN FIELD VIEW SUATU DISKUSI BERDASARKAN PERTANYAAN
                    $id_question = $_GET['id_question'];
                    include "system/connect.php";
                    $statement = $db->query("SELECT * FROM answer a,users b,question c WHERE a.id_user=b.id_user AND a.id_question=c.id_question AND c.id_question=$id_question");
                    $statementuser = $db->query("SELECT * FROM question a, users b WHERE a.id_user=b.id_user AND id_question=$id_question")

                    ?>
                    <div class="disscuss-field">
                        <div class="topic-title">

                            <?php
                            foreach ($statementuser as $row2) {
                                foreach ($statement as $row) {
                                    //MENAMPILKAN FIELD DISKUSI 
                                    echo "<b>oleh : {$row2['name_user']}</b>";
                                    echo "<p>{$row['content_question']}</p><hr>";
                                    if ($row['content_answer'] == null) {
                                        if ($_SESSION['id_user'] == $row['id_user']) {

                                            //BUTTON PERUBAHAN PERTANYAAN(EDIT) (NOTE:JIKA SUDAH DIJAWAB EXPERT PERTANYAAN TIDAK DAPAT DIUBAH)
                                            echo "<a href='edit.php?id_question=$id_question'>Edit your question</a>";
                                            echo "<h4>Jawaban</h4>";
                                            echo "<i>belum di jawab </i>";
                                        }
                                    } else {
                                        echo "<b>Dijawab oleh: {$row['name_user']}</b>";
                                        echo "<br><br>{$row['content_answer']}";
                                    }
                                }
                            } ?>



                        </div>
                    </div>
            </div>

            <?php
            //JIKA STATUS EXPERT MAKA ADA BUTTON UNTUK MEREPLY
            if ($_SESSION['status'] == 2) {
                echo "<div class='field'>";
                echo "<br>";
                echo "<a href='edit.php?id_question=$id_question' class=btn-green>edit</a>";
                echo " </div>";
            }

            ?>
        </div>
    </div>
    <!--FOOTER -->
    <?php include "pages/layout/footer.php"; ?>
</body>
<!-- END FOOTER -->

</html>