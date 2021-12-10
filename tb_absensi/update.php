<?php
include "../config/database.php";

$id_absensi = $_GET["id"];

$identitas = isset($_POST["identitas"]) ? $_POST["identitas"] : "";
$tgl = isset($_POST["tgl"]) ? $_POST["tgl"] : "";
$s_in = isset($_POST["s_in"]) ? $_POST["s_in"] : "";
$ket = isset($_POST["ket"]) ? $_POST["ket"] : "";

$sql="UPDATE tb_absensi SET tgl = '$tgl', s_in = '$s_in', ket = '$ket' WHERE id_absensi = '$id_absensi'
";
$query= mysqli_query($con,$sql);
if($query){
    $mesaage =  "Succes";
}else{
    $mesaage =  "Failed";
}

$response = array(
    "Status"=>"OK",
    "message"=>$mesaage
);
echo json_encode($response);

?>