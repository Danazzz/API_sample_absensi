<?php
include "../config/database.php";

// $id_mahasiswa = $_GET["id"];

//$sql ="SELECT * FROM `mahasiswa` WHERE id_mahasiswa = ".$id_mahasiswa."";

$query = mysqli_query($con, "SELECT * FROM tb_absensi WHERE id_absensi = '$_GET[id]'") or die(mysqli_error($con));
while($data = mysqli_fetch_array($query)){
    $item[]=array(
        "id"=>$data["id_absensi"],
        "id_user"=>$data["id_user"],
        "tgl"=>$data["tgl"],
        "s_in"=>$data["s_in"],
        "ket"=>$data["ket"],
    );
}  

$response = array(
    "Status"=>"OK",
    "data"=>$item
);
echo json_encode($response);

?>