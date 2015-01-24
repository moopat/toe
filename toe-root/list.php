<?php

include 'config.php';
include 'lib.php';
if(!isLoggedIn()){
    header("Location: login.php");
    exit();
}

$title = 'TÖ Complete Vocab List';
include '_header.inc.php';
?>
<div id="header">
    <img src="img/toe.png" alt="TÖ" />
    <h1>TÖ Complete Vocab List</h1>
</div>
<div id="content">

    <table>
        <tr>
            <th>ID</th>
            <th>Word</th>
            <th>Explanation</th>
        </tr>
        <?php

            $query = "SELECT vocabid, word, explanation FROM vocab ORDER BY word ASC;";
            $result = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'.$row['vocabid'].'</td>';
                echo '<td>'.strip_tags(stripslashes($row['word'])).'</td>';
                echo '<td>'.strip_tags(stripslashes($row['explanation'])).'</td>';
                echo '</tr>';
            }

        ?>
    </table>
</div>
<?php
include '_footer.inc.php';
?>