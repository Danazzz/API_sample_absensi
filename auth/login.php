<?php 
require_once "core/init.php";
 
//mengecek parameter post
if (isset($_POST['username']) && isset($_POST['password'])) {
     
    //menampung parameter ke dalam variabel
    $username  = $_POST['username'];
    $password = $_POST['password'];
      
    $user = cek_data_user($username,$password);//validasi user
    // var_dump($user);die;
    if($user != false){
        //jika berhasil login
        $response["successfully"] = TRUE;
        $response["user"]["username"] = $user["username"];
        $response["user"]["ID"] = $user["id_user"];
        echo json_encode($response);
    }else{
        // user tidak ditemukan password/email salah
        $response["error"] = TRUE;
        $response["error_msg"] = "Login gagal. Password/Nik salah";
        echo json_encode($response);
    }
 
}else{
    $response["error"] = TRUE;
    $response["error_msg"] = "Nik atau Password tidak boleh kosong !";
    echo json_encode($response);
}
?>