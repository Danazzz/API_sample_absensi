<?php
require_once "database.php";

  //method login dan register
function register_user($username, $password, $identitas){
    global $con;
        
    //mencegah sql injection
    $username = escape($username);
    $password = escape($password);
    $password = sha1(trim($_POST['password']));
  
    //$hash = hashSSHA($password); //mengencrypt password
    $identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
    //$encrypted_password = $hash["encrypted"]; //mengambil data password yang sudah di enkripsi untuk ditampung pada variabel encrypted_password
        
    $query = "INSERT INTO tb_user(username, password, id_user, role) VALUES('$username', '$password', '$identitas', 'mahasiswa') ON DUPLICATE KEY UPDATE id_user = '$identitas'";
     
    $user_new = mysqli_query($con, $query);
    if( $user_new ) {
          $usr = "SELECT * FROM tb_user WHERE username = '$username'";
          $result = mysqli_query($con, $usr);
          $user = mysqli_fetch_assoc($result);
          return $user;
    }else{
          return NULL;
    }
  }
  //-------------- *** end *** -------------------//
    
  //---- mencegah sql injection -----//
  function escape($data){
      global $con;
      return mysqli_real_escape_string($con, $data);
  }
  //----------- *** end *** ---------//
    
  //--- mengecek nama apakah sudah terdaftar atau belum ---//
  function cek_nama($username){
      global $con;
      $query = "SELECT * FROM tb_user WHERE username = '$username'";
      if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
  }
  //---------------- *** end ***-------------------------//
    
  //------------ mengenkripsi password ----------------//
  // function hashSSHA($password) {
  //     $salt = sha1(rand());
  //     $salt = substr($salt, 0, 10);
  //     $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
  //     $hash = array("salt" => $salt, "encrypted" => $encrypted);
  //     return $hash;
  // }
  //------------ *** end *** -------------------------//
    
  // -------- mengenkripsi password yang dimasukkan user saat login -->
  // function checkhashSSHA($salt, $password) {
   
  //     $hash = base64_encode(sha1($password . $salt, true) . $salt);
   
  //     return $hash;
  // }
  //------------ *** end *** -------------------------//
   
  //----------------- cek data user dan validasi------------------//
  function cek_data_user($username,$password){
      global $con;
      //mencegah sql injection
      $username = escape($username);
      $password = escape($password);
      $pass = sha1(trim($password));
       
      $query  = "SELECT * FROM tb_user WHERE username = '$username'";
      $result = mysqli_query($con, $query);
      $data = mysqli_fetch_assoc($result);
       
      // $id_user = $data['id_user'];
      $encrypted_password = $data['password'];
      // mengencrypt password
      // $hash = checkhashSSHA($id_user, $password);
      //validasi password
      if($encrypted_password == $pass){
          return $data;
      }else{
          return false;
      }
  }
  //---------------------- *** end *** -------------------------//
?>