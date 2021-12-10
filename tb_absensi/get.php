<?php
include "../config/database.php";

$sql = "SELECT * FROM tb_absensi";
$query = mysqli_query($con, $sql);
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