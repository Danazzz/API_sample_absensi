<?php
include "../config/database.php";

$id_user = $_GET['id_user'];

$sql = "DELETE tb_user FROM tb_user
JOIN tb_mahasiswa ON tb_user.id_user = tb_mahasiswa.id_user
WHERE tb_user.id_user ='$id_user'
";
//var_dump($sql);die;

$query = mysqli_query($con, $sql) or die(mysqli_error($con));
if($query){
    $mesaage =  "Success";
}else{
    $mesaage =  "Failed";
}

$response = array(
    "Status"=>"OK",
    "message"=>$mesaage
);
echo json_encode($response);

?>