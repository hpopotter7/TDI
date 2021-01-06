<?php 
//$mysqli = new mysqli("localhost", "admini27_root", "@ERPideas2019", "admini27_erp");
$mysqli = new mysqli("209.59.139.52:3306", "admini27_demo", "@ERPideas2019", "admini27_demo");
//$mysqli = new mysqli("209.59.139.52:3306", "admini27_root", "@ERPideas2019", "admini27_erp");
//$mysqli = new mysqli("localhost", "admini27_demo", "@ERPideas2019", "admini27_demo");

    if (isset($_COOKIE['user'])){
        $secondsInactive = time() - $_COOKIE['start'];
        if ($secondsInactive > (60*60)) {  //en segundos
            
            setcookie ("user", "caducada", time() - 3600);
            setcookie ("nombre", "", time() - 3600);
            setcookie ("start", "", time() - 3600);
            echo "<script>
                   swal({
                      type: 'warning',
                      title: 'La sesión ha caducado',
                      text:  'Debe iniciar sesion de nuevo',
                      onClose: () => {
                        window.location.href='logout.php';
                      }
                    });
                    </script>";
        }
        else{
            setcookie("start", time());
        }
    }

    if (!isset($_COOKIE['user'])){
        
        echo "<script>
        swal({
           type: 'warning',
           title: 'La sesión ha caducado',
           text:  'Debe iniciar sesion de nuevo',
           onClose: () => {
             window.location.href='logout.php';
           }
         });
         </script>";
    }



?>

