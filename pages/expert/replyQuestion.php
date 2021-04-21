<!--BAGIAN TAMPILAN MENJAWAB PERTANYAAN{EXPERT)-->
<div class="form-question">
    <h1>Jawab Pertanyaan</h1>
    <div class="form-field">
        <?php
        //MENGAMBIL NILAI VARIABEL MASUKAN LEWAT URL
        $id_question = $_GET['id_question'];
        $sql = $db->query("SELECT * FROM question a, topic b,users c WHERE a.id_topic=b.id_topic AND a.id_user=c.id_user AND id_question=$id_question");

        //MENAMPILKAN ISIAN DARI PERTANYAAN YANG DIPILIH
        foreach ($sql as $row) {
        ?>

            <div class="field">
                <div class="disscuss-field">
                    <div class="topic-title">


                        <b><?php echo "{$row['name_topic']}";
                            $id_questionNow = $row['id_question']; ?>
                        </b>
                        <br><br> dari : <?php echo "{$row['name_user']}"; ?>
                        <hr>

                        <p><?php echo "{$row['content_question']}"; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!--BAGIAN FORM REPLY JAWABAN -->
        <form action="reply.php" method="POST">
            <div class="field">
                <!--MEMANIPULASI INPUTAN DENGAN CARA HIDDEN VALUE-->
                <input type="text" name="id_question" class="inp" value="<?php echo $id_questionNow; ?>" hidden>
                <input type="text" name="id_user" class="inp" value="<?php echo $_SESSION['id_user']; ?>" hidden>
                <label>Jawaban</label>
                <br>
                <div class="error" style="color: red;"> <?php echo $answerErr;
                                                        ?> </div>
                <!--TEMPAT ISIAN JAWABAN-->
                <textarea name="content_answer" cols="30" rows="15"></textarea>

            </div>
            <input type="submit" value="Submit" class="btn-green">
        </form>
    </div>
</div>