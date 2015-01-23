<?php
/**
 * Markus Deutsch <markus.deutsch@moop.at>
 * 23.01.15 15:54
 */

include 'config.php';
include 'lib.php';

if(isLoggedIn()){
    header("Location: enter.php");
    exit();
}

if(isset($_POST['key']) && $_POST['key'] == $config['key']){
    setcookie($config['cookiename'], $config['key'], time() + 86400);
    header("Location: enter.php");
}

$title = 'TÖ Login';
include '_header.inc.php';
?>

<div id="login">
    <div id="header">
        <img src="img/toe.png" alt="TÖ" />
        <h1>TÖ Login</h1>
    </div>
    <div>Please sign in using the preshared key.</div>
    <form name="login" method="post" action="login.php">
        <input class="input-text" name="key" type="password" />
        <input class="input-button" name="submit" type="submit" value="Login" />
    </form>

</div>

<?php
include '_footer.inc.php';
?>


