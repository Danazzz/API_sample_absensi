<?php
include "../config/database.php";

$id_user = $_GET["id_user"];

$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
$username= isset($_POST["username"]) ? $_POST["username"] : "";
$password= isset($_POST["password"]) ? $_POST["password"] : "";
$jkel= isset($_POST["jkel"]) ? $_POST["jkel"] : "";
$alamat= isset($_POST["alamat"]) ? $_POST["alamat"] : "";
$no_telp= isset($_POST["no_telp"]) ? $_POST["no_telp"] : "";
$instansi= isset($_POST["instansi"]) ? $_POST["instansi"] : "";
$gambar= isset($_POST["gambar"]) ? $_POST["gambar"] : "";

$sql1= "UPDATE tb_user SET username = '$username', password = '$password' WHERE id_user = '$id_user'
";
$sql2= "UPDATE tb_mahasiswa SET nama = '$nama', username = '$username', jkel = '$jkel', alamat = '$alamat', no_telp = '$no_telp', instansi = '$instansi', gambar = '$gambar' WHERE id_user = '$id_user'
";

$query1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
$query2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
if($query1){
    if($query2){
        $mesaage =  "Succes";
    }
}else{
    $mesaage =  "Failed";
}

$response = array(
    "Status"=>"OK",
    "message"=>$mesaage
);
echo json_encode($response);

?>