<div class="container">
    <div class="question-box">
        <a href="index.php" class="btn-white">Kembali ke diskusi</a>
    </div>
    <div class="wrapper"></div>
    &emsp;&emsp;&emsp;&emsp;
    <?php
    $id_question = $_SESSION["id_question"];
    $sql = $db->query("SELECT * FROM question a, users b, topic c WHERE a.id_user=b.id_user AND c.id_topic=a.id_topic AND id_question=$id_question");

    ?>
    <div class="form-question">
        <h1>Edit Pertanyaan</h1>
        <div class="form-field">
            <!--form edit pertanyaan-->
            <form action="edit.php" method="POST">
                <?php foreach ($sql as $row) {
                    //MENAMPILKAN ISIAN DATA DARI SESI PERTANYAAN INI
                ?>

                    <div class="field">
                        <br>
                        <input type="text" name="id_question" value="<?php echo "{$row['id_question']}"; ?>" disabled hidden>
                    </div>
                    <div class="field">
                        <label>Topic</label>
                        <br>
                        <input type="text" name="name_topic" value="<?php echo "{$row['name_topic']}"; ?>" disabled>
                    </div>
                    <div class="field">
                        <label>Pertanyaan</label>
                        <br>
                        <div class="error" style="color: red;"> <?php echo $contentErr;
                                                                ?> </div>

                        <textarea name="content_question" cols="30" rows="15"><?php echo "{$row['content_question']}";
                                                                                ?></textarea>
                    </div>
                    <input type="submit" value="Submit" class="btn-green">
            </form>
        </div>
    </div>
<?php }
?>

</div>