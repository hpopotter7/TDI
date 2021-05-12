<?php
/* if (($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/gif")) { */
    $mes=$_GET['mes'];
    if(!file_exists("nomina/".$mes."/")){
        mkdir("nomina/".$mes."/", 0777);
    }
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "nomina/".$mes."/".$_FILES['file']['name'])) {
        echo 'si';
    } else {
        echo 'no';
    }
//}
?>