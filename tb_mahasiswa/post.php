<?php
include "../config/database.php";

$identitas = isset($_POST["identitas"]) ? $_POST["identitas"] : "";
$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
$username= isset($_POST["username"]) ? $_POST["username"] : "";
$password= isset($_POST["password"]) ? $_POST["password"] : "";
$jkel= isset($_POST["jkel"]) ? $_POST["jkel"] : "";
$alamat= isset($_POST["alamat"]) ? $_POST["alamat"] : "";
$no_telp= isset($_POST["no_telp"]) ? $_POST["no_telp"] : "";
$instansi= isset($_POST["instansi"]) ? $_POST["instansi"] : "";
$gambar= isset($_POST["gambar"]) ? $_POST["gambar"] : "";

$sql1= "INSERT INTO tb_user(id_user, username, password, role ) VALUES ( '$identitas', '$username', '$password', 'mahasiswa')
";
$sql2= "INSERT INTO tb_mahasiswa(id_mahasiswa, id_user, nama, username, jkel, alamat, no_telp, instansi, gambar) VALUES ('', '$identitas', '$nama', '$username', '$jkel', '$alamat', '$no_telp', '$instansi', '$gambar')
";

$query1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
$query2 = mysqli_query($con,$sql2) or die (mysqli_error($con));
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