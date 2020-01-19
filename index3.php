<?php
    session_start();

    if (!isset($_SESSION['luser'])) {
        echo "Inicie sesion de nuevo";
        echo "<a href='http://localhost/tdi/index.php'>Click Here to Login</a>";
    }
    else {
        $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
            session_destroy();
            echo "La sesión ha caducado<p> <a href='http://localhost/somefolder/login.php'>Login here</a>";
        }
        else { //Starting this else one [else1]
?>
            <!-- From here all HTML coding can be done -->
            <html>
                Welcome
                <?php
                    echo $_SESSION['luser'];
                    echo "<a href='http://localhost/tdi/logout.php'>Log out</a>";
                ?>
            </html>
<?php
        }
    }
?>