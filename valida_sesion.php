<?php 

session_start();
if (isset($_SESSION['luser']) ){
    $secondsInactive = time() - $_SESSION['start'];
    if ($secondsInactive > 30) {
        session_destroy();
        header('Location:home.php');
        exit();
    }
}
?>