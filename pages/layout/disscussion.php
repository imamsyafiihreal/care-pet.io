<?php
include "system/connect.php";

//KONDISI UNTUK MENAMPILKAN FIELD DIKUSI SESI EXPERT
if ($_SESSION['status'] == 2) {
?>
    <div class="sidebar">
        <?php $statement2 = $db->query("SELECT * FROM topic"); ?>
        <div class="topic-list">
            <h2>Topic List</h2>
            <ul>
                <?php foreach ($statement2 as $row2) {
                    echo "<li>{$row2['name_topic']}</li>";
                }
                ?>
            </ul>
        </div>
    </div>&emsp;&emsp;&emsp;&emsp;
    <div class="disscussion" id="disscussion">
        <?php
        $statement1 = $db->query("SELECT * FROM question a, answer b, users c ,topic d WHERE a.id_user=c.id_user AND a.id_question=b.id_question AND d.id_topic=a.id_topic ORDER BY a.id_question DESC");

        //MENAMPILKAN SEMUA FIELD DISKUSI 
        foreach ($statement1 as $row1) {
            $id_question = $row1['id_question'];
            //KONDISI JIKA PERTANYAAN BELUM DIJAWAB
            if ($row1['content_answer'] == Null) {
                echo "<div class='disscuss-field'>";
                echo "<div class='topic-title'>";
                echo "<p><b>{$row1['id_question']}-{$row1['name_topic']}</b>";
                echo "<br>Oleh : {$row1['name_user']}</p></div>";
                echo "<hr><div class='content-disscuss'>";
                echo "<p>{$row1['content_question']}</p>";
                //TERDAPAT BUTTON UNTUK MENUJU HALAMAN REPLY
                echo "<br><a href='reply.php?id_question=$id_question'>Jawab</a>";
                echo "</div>";
                echo "</div>";
            } else {
                //KONDISI JIKA PERTANYAAN SUDAH DIJAWAB
                echo "<div class='disscuss-field' style='background-color:#9acb34 ;'>";
                echo "<div class='topic-title'>";
                echo "<p><b>{$row1['id_question']}-{$row1['name_topic']}</b>";
                echo "<br>Oleh : {$row1['name_user']}</p></div>";
                echo "<hr><div class='content-disscuss'>";
                echo "<p>{$row1['content_question']}</p>";
                //TIDAK TERDAPAT BUTTON MENJAWAB JIKA SUDAH TERJAWAB
                echo "<br><span style='color: black;'><i>Telah Dijawab :<br>{$row1['content_answer']}</i></span>";
                echo "</div>";
                echo "</div>";
            }
        }

        ?>

    </div>
<?php } else
//KONDISI UNTUK MENAMPILKAN FIELD DIKUSI SESI CLIENT
{ ?>
    <div class="sidebar">
        <?php $statement2 = $db->query("SELECT * FROM topic"); ?>
        <div class="topic-list">
            <h2>Topic List</h2>
            <ul>
                <?php foreach ($statement2 as $row2) {
                    echo "<li>{$row2['name_topic']}</li>";
                }
                ?>
            </ul>
        </div>
    </div>&emsp;&emsp;&emsp;&emsp;
    <div class="disscussion" id="disscussion">
        <?php
        $statement1 = $db->query("SELECT * FROM question a, answer b, users c ,topic d WHERE a.id_user=c.id_user AND a.id_question=b.id_question AND d.id_topic=a.id_topic ORDER BY a.id_question DESC");

        foreach ($statement1 as $row1) {
            $id_question = $row1['id_question'];
            if ($row1['content_answer'] == Null) {
                echo "<div class='disscuss-field'>";
                echo "<div class='topic-title'>";
                echo "<p><b>{$row1['id_question']}-{$row1['name_topic']}</b>";
                echo "<br>Oleh : {$row1['name_user']}</p></div>";
                echo "<hr><div class='content-disscuss'>";
                echo "<p>{$row1['content_question']}</p>";
                echo "<br><a href='./view.php?id_question=$id_question'>Lihat Detail</a>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "<div class='disscuss-field'><br><i style='color:black;'>Telah dijawab oleh Expert</i>";
                echo "<div class='topic-title'>";
                echo "<p><b>{$row1['id_question']}-{$row1['name_topic']}</b>";
                echo "<br>Oleh : {$row1['name_user']}</p></div>";
                echo "<hr><div class='content-disscuss'>";
                echo "<p>{$row1['content_question']}</p>";
                echo "<br><a href='./view.php?id_question=$id_question'>Lihat Detail</a>";
                echo "</div>";
                echo "</div>";
            }
        }

        ?>

    </div>
<?php } ?>