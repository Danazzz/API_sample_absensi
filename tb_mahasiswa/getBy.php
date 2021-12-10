<?php
include "../config/database.php";

$id_user = $_GET["id_user"];


$sql = "SELECT * FROM tb_user
INNER JOIN tb_mahasiswa ON tb_user.id_user = tb_mahasiswa.id_user
WHERE tb_mahasiswa.id_user = '$id_user'
";

$query = mysqli_query($con, $sql) or die(mysqli_error($con));
while($data = mysqli_fetch_array($query)){
    $item[]=array(
        "id"=>$data["id_user"],
        "nama"=>$data["nama"],
        "username"=>$data["username"],   
        "jenisKelamin"=>$data["jkel"],  
        "alamat"=>$data["alamat"],   
        "no_telp"=>$data["no_telp"],
        "gambar"=>$data["gambar"]  
    );
}  

$response = array(
    "Status"=>"OK",
    "data"=>$item
);
echo json_encode($response);

?>