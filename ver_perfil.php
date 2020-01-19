<?php 
    
$user=$_COOKIE["user"];
$res="";
include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$eje="";
$sol="";
$cxc="";
$dig="";
$pro="";
$dis="";
$dire="";
$cat_cli="";
$cat_prov="";
$cat_usu="";
$cat_fact="";
    $result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT * FROM usuarios where Nombre='".$user."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        	$usuario=$row[1];
            if($row[5]=="X"){
                $eje="Ejecutivo de cuenta";
            }
            if($row[6]=="X"){
                $sol="Solicitante";
            }
            if($row[7]=="X"){
                $cxc="Cuentas por pagar";
            }
            if($row[8]=="X"){
                $dig="Digital";
            }
            if($row[9]=="X"){
                $pro="Productor";
            }
            if($row[10]=="X"){
                $dis="Diseño";
            }
             if($row[11]=="X"){
                $dire="Directivo";
            }
            if($row[13]=="X"){
                $cat_cli="cat_cli";
            }
            if($row[14]=="X"){
                $cat_prov="cat_prov";
            }
            if($row[15]=="X"){
                $cat_usu="cat_usu";
            }
            if($row[17]=="X"){
                $cat_fact="cat_fact";
            }
    }
    /* free result set */
    $result->close();
}
else{
    echo $mysqli->error;
    exit();
}
$return = Array('usuario'=>$usuario, 
                'eje'=>$eje, 
                'sol'=>$sol, 
                'cxc'=>$cxc,
                'dig'=>$dig,
                'pro'=>$pro,
                'dis'=>$dis,
                'dire'=>$dire,
                'cat_cli'=>$cat_cli,
                'cat_prov'=>$cat_prov,
                'cat_usu'=>$cat_usu,
                'cat_fact'=>$cat_fact
            );
$res=$res.json_encode($return)."\n";
echo $res;

$mysqli->close();
?>