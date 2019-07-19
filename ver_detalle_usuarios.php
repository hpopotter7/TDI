<?php 
$valor=$_POST['valor'];
include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$sql="SELECT * FROM usuarios where Nombre='".$valor."'";
/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {
  /* fetch object array */
    while ($row = $result->fetch_row()) {
        $return = Array('nombre'=>$row[1], 
        				'user'=>$row[2], 
                    	'email'=>$row[3], 
                    	'eje'=>$row[5],
                    	'sol'=>$row[6],
                    	'cxp'=>$row[7],
                    	'dig'=>$row[8],
                    	'pro'=>$row[9],
                    	'dis'=>$row[10],
                        'dire'=>$row[11],

                        'cat_cli'=>$row[13],
                        'cat_prov'=>$row[14],
                        'cat_usu'=>$row[15],
                        'sodexo'=>$row[16],
                        'cat_fact'=>$row[17],
                    	'error'=>'nada',
                    	'sql'=>''
                    );
    }
    $result->close();
        
}
else{
	$return = Array('error'=>"Error", 
        			'sql'=>mysqli_error($mysqli));
   
}
$res=$res.json_encode($return)."\n";
echo $res;

$mysqli->close();
?>