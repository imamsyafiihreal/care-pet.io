<div class="container">
    <div class="form-question">
        <h1>Edit Jawaban</h1>
        <div class="form-field">
            <?php
            //MENGAMBIL NILAI VARIABEL MASUKAN LEWAT SESSION
            $id_question = $_SESSION['id_question'];
            $sql = $db->query("SELECT * FROM answer a,users b,question c WHERE a.id_user=b.id_user AND a.id_question=c.id_question AND c.id_question=$id_question");

            //MENAMPILKAN ISIAN DARI PERTANYAAN YANG DIPILIH
            foreach ($sql as $row) {
            ?>
                <div class="field">
                    <div class="disscuss-field">
                        <div class="topic-title">

                            <?php echo "<b>{$row['content_question']}</b>"; ?>
                            <br><br>dari : <?php echo "{$row['name_user']}"; ?>
                            <hr>
                        </div>
                    </div>
                </div>

                <!--BAGIAN FORM REPLY JAWABAN -->
                <form action="edit.php" method="POST">
                    <div class="field">
                        <!--MEMANIPULASI INPUTAN DENGAN CARA HIDDEN VALUE-->
                        <input type="text" name="id_question" class="inp" value="<?php echo "{$row['id_question']}"; ?>" hidden>
                        <input type="text" name="id_user" class="inp" value="<?php echo $_SESSION['id_user']; ?>" hidden>
                        <label>Jawaban</label>
                        <br>
                        <div class="error" style="color: red;"> <?php echo $contentErr;
                                                                ?> </div>
                        <!--TEMPAT ISIAN JAWABAN-->
                        <textarea name="content_answer" cols="30" rows="15"><?php echo "{$row['content_answer']}";
                                                                            ?></textarea>

                    </div>
                    <input type="submit" value="Submit" class="btn-green">
                </form>
            <?php } ?>
        </div>
    </div>
</div>