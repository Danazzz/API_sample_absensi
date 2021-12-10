<?php
include "../config/database.php";

$identitas = isset($_POST["identitas"]) ? $_POST["identitas"] : "";
$tgl = isset($_POST["tgl"]) ? $_POST["tgl"] : "";
$s_in = isset($_POST["s_in"]) ? $_POST["s_in"] : "";
$ket = isset($_POST["ket"]) ? $_POST["ket"] : "";

if(mysqli_query($con,"INSERT INTO tb_absensi (id_user, tgl, s_in, ket) VALUES ('$identitas', '$tgl', '$s_in', '$ket')") or die (mysqli_error($con))){
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