<?php
/**
 * Markus Deutsch <markus.deutsch@moop.at>
 * 23.01.15 15:54
 */

include 'config.php';
include 'lib.php';

$title = 'TÖ mit Ö';
include '_header.inc.php';

// Get a question
$query = "SELECT * FROM vocab ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db, $query);

$answers = array();

while($row = mysqli_fetch_assoc($result)){
    $answers[] = array('id' => $row['vocabid'], 'word' => $row['explanation']);
    $question = $row['word'];
    $questionid = $row['vocabid'];
}

// Get random answers
$query2 = "SELECT vocabid, explanation FROM vocab WHERE vocabid != '$questionid' ORDER BY RAND() LIMIT 3;";
$result2 = mysqli_query($db, $query2);
while($row2 = mysqli_fetch_assoc($result2)){
    $answers[] = array('id' => $row2['vocabid'], 'word' => $row2['explanation']);
}

shuffle($answers);
?>

<div id="header">
    <img src="img/toe.png" alt="TÖ" />
    <h1>TÖ mit Ö</h1>
</div>

<div id="quiz">
    <?php
        // Validate the previous question.
        if(isset($_GET['q'])){
            if(md5($_GET['q']) == $_GET['a']){
                echo '<div class="answer-correct">Richtig!</div>';
            } else {
                $qid = mysqli_real_escape_string($db, $_GET['q']);
                $aq = "SELECT word, explanation FROM vocab WHERE vocabid = '$qid'";
                $ar = mysqli_query($db, $aq);
                while($arr = mysqli_fetch_assoc($ar)){
                    echo '<div class="answer-wrong">Falsch! Die richtige Antwort auf "<i>'.strip_tags(stripslashes($arr['word'])).'</i>" wäre "<i>'.strip_tags(stripslashes($arr['explanation'])).'</i>" gewesen.</div>';
                }
            }
        }
    ?>
    <div class="question">
        <?php echo strip_tags(stripslashes($question)); ?>
    </div>
    <?php
        foreach($answers as $a){
            echo '<a class="answer" href="?q='.$questionid.'&a='.md5($a['id']).'">';
            echo strip_tags(stripslashes($a['word']));
            echo '</a>';
        }
    ?>
</div>

<?php
include '_footer.inc.php';
?>


