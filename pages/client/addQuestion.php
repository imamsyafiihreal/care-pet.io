<!-- BAGIAN UNTUK FORM BUAT PERTANYAAN-->
<div class="form-question">
    <h1>Buat Pertanyaan</h1>
    <div class="form-field">
        <form action="compose.php" method="POST">
            <div class="field">
                <label>Topic</label>
                <br>
                <input type="text" name="name_topic">
            </div>
            <div class="field">
                <label>Pertanyaan</label>
                <br>
                <div class="error" style="color: red;"> <?php echo $contentErr;
                                                        ?> </div>
                <textarea name="content_question" cols="30" rows="15"></textarea>


            </div>
            <input type="submit" value="Submit" class="btn-green">
        </form>
    </div>
</div>