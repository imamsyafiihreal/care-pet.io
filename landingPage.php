<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="icon" href="assets/img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page | Care-pet</title>
</head>

<body>
    <!--NAVBAR -->
    <?php include "pages/layout/header.php"; ?>
    <!--END NAVBAR -->
    <div class="wrapper"> </div>
    <!--SECTION TAMPILAN UTAMA -->
    <?php include "pages/layout/mainContent.php"; ?>
    <!--END SECTION TAMPILAN UTAMA -->
    <div class="wrapper">&emsp;</div>
    <!--SECTION DISKUSI -->
    <div class="container">
        <div class="question-box">
            <h1>Riwayat Diskusi</h1>
        </div>
        <?php
        ?>
        <!--SIDEBAR TOPIK -->
        <div class="sidebar">
            <?php $statement2 = $db->query("SELECT * FROM topic"); ?>
            <div class="topic-list">
                <h2>Daftar Topic</h2>
                <ul>
                    <?php foreach ($statement2 as $row2) {
                        echo "<li>{$row2['name_topic']}</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!--END SIDEBAR TOPIK -->
        &emsp;&emsp;&emsp;&emsp;
        <!--FIELD DISSKUSI -->
        <div class="disscussion" id="disscussion">
            <?php
            $statement1 = $db->query("SELECT * FROM question a, topic b, users c WHERE a.id_user=c.id_user AND a.id_topic=b.id_topic ORDER BY a.id_question DESC LIMIT 5");
            foreach ($statement1 as $row) {
                echo "<div class='disscuss-field'>";
                echo "<div class='topic-title'>";
                echo "<p><b>{$row['name_topic']}</b>";
                echo "<br>Oleh : {$row['name_user']}</p></div>";
                echo "<hr><div class='content-disscuss'>";
                echo "<p>{$row['content_question']}</p>";
                echo "<br><a href='view.php'>Lihat Detail</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <a href="login.php"> Tampilkan Lebih banyak</a>

        </div>

    </div>
    <!--END SECTION DISKUSI -->
    <div class="wrapper"> </div>
    <!--FOOTER -->
    <?php include "pages/layout/footer.php"; ?>
</body>
<!-- END FOOTER -->

</html>