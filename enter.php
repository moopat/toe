<?php

include 'config.php';
include 'lib.php';
if(!isLoggedIn()){
    header("Location: login.php");
    exit();
}

$limit = 15;
$word = array();
$explanation = array();
$failedsubmission = false;

if(isset($_POST['submit'])){
    for($i=0; $i < $limit; $i++){
        if($_POST['word-'.$i] != '' && $_POST['explanation-'.$i] != ''){
            $word[] = mysqli_real_escape_string($db, trim($_POST['word-'.$i]));
            $explanation[] = mysqli_real_escape_string($db, trim($_POST['explanation-'.$i]));
        }
    }
    if(count($word) > 0){
        $ip = $_SERVER['REMOTE_ADDR'];
        // Build Query
        $query = "INSERT INTO vocab (word, explanation, entryip) VALUES ";
        for($i = 0; $i < count($word); $i++){
            $query .= "('".$word[$i]."', '".$explanation[$i]."', '$ip')";
            if($i < count($word) - 1) $query .= ", ";
        }
        if(mysqli_query($db, $query)){
            $success = count($word).' words were submitted successfully.';
        } else {
            $failedsubmission = true;
            $error = 'There was an error submitting your vocab: '.mysqli_error($db);
        }
    }
}

$title = 'TÖ Vocab Entry';
include '_header.inc.php';
?>
<div id="header">
    <img src="img/toe.png" alt="TÖ" />
    <h1>TÖ Vocab Submission</h1>
</div>
<div id="content">

    <?php

        if(isset($success)){
            echo '<div class="success">'.$success.'</div>';
        }

        if(isset($error)){
            echo '<div class="error">'.$error.'</div>';
        }

    ?>

    <div>Please enter your vocab here. You can enter up to <?php echo $limit; ?> word-explanation combinations at a time.</div>

    <form name="entry" method="post" action="enter.php">

    <table>
        <tr>
            <th>Word</th>
            <th>Explanation</th>
        </tr>
        <?php

            for($i = 0; $i < $limit; $i++){
                echo '<tr>';
                echo '<td><textarea name="word-'.$i.'">';
                if($failedsubmission && isset($_POST['word-'.$i])) echo $_POST['word-'.$i];
                echo '</textarea></td>';
                echo '<td><textarea name="explanation-'.$i.'">';
                if($failedsubmission && isset($_POST['explanation-'.$i])) echo $_POST['explanation-'.$i];
                echo '</textarea></td>';
                echo '</tr>';
            }

        ?>
    </table>
    <input class="input-button" name="submit" type="submit" value="Submit Vocab" />
    </form>
</div>
<?php
include '_footer.inc.php';
?>