<?php
include "../config/database.php";

//$query = mysqli_query($conn, $sql);
if(mysqli_query($con, "DELETE FROM tb_absensi WHERE id_absensi = '$_GET[id]'") or die(mysqli_error($con))){
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