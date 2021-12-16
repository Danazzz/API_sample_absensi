<?php
require_once "core/init.php";

// json response array
//$response = array("error" => FALSE);
 
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['identitas'])) {
  
    // menerima parameter POST ( name, password, identitas )
    $username = $_POST['username'];
    $password = $_POST['password'];
    $identitas = $_POST['identitas'];
 
    //mengecek id apakah sudah pernah daftar atau belum
    if( cek_nama($username) == 0 ){
      //mendaftarkan user baru
      $user = register_user($username, $password, $identitas);
      if($user){
        // simpan user berhasil
        $response["successfully"] = TRUE;
        $response["user"]["username"] = $user["username"];
        $response["user"]["ID"] = $user["id_user"];
        echo json_encode($response);
      }else{
        // gagal menyimpan user
        echo mysqli_connect_error();
        $response["error"] = TRUE;
        $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
        echo json_encode($response);
      }
    }else{
      // user telah ada
      $response["error"] = TRUE;
      $response["error_msg"] = "User telah ada ";
      echo json_encode($response);
    }
}
?>