<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip, pdf, doc, docx, xls, xlxs');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error1"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'archivos/'.$_FILES['upl']['name'])){
		echo '{"status":"success"}';
		exit;
	}
}

echo '{"status":"error2"}';
exit;