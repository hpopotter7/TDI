<?php
    setcookie ("user", "", time() - 3600);
    setcookie ("email", "", time() - 3600);
    setcookie ("pass", "", time() - 3600);
    setcookie ("nombre", "", time() - 3600);
    setcookie ("start", "", time() - 3600);
    header('Location:inicio.php');
    
?>