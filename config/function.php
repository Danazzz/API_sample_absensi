<?php
require_once "database.php";
require_once "upload.php";

//kelas mahasiswa yang dimana berisikan function-function untuk CRUD tabel mahasiswa dan tabel user
class Mahasiswa {
   //function yang akan menampilkan seluruh data mahasiswa yang ada dalam tabel mahasiswa apabila tidak ada paramater yang diinput
   public  function get_mhss(){
      global $con;
      $query="SELECT * FROM tb_user
      INNER JOIN tb_mahasiswa ON tb_user.id_user = tb_mahasiswa.id_user
      ";
      $data=array();
      $result=$con->query($query);
      while($row=mysqli_fetch_object($result)){
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   //function yang akan menampilkan data mahasiswa yang spesifik berdasarkan id user sebagai paramaternya, menggunakan metode GET
   public function get_mhs($id=0){
      global $con;
      $query="SELECT * FROM tb_user
      INNER JOIN tb_mahasiswa ON tb_user.id_user = tb_mahasiswa.id_user
      ";
      if($id != 0){
         $query.=" WHERE tb_mahasiswa.id_user=".$id." 
         LIMIT 1";
      }
      $data=array();
      $result=$con->query($query) or die (mysqli_error($con));
      while($row=mysqli_fetch_object($result)){
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   //function untuk menambahkan data kedalam tabel user menggunakan metode POST, tanpa parameter
   public function insert_user()
   {
      global $con;
      $arrcheckpost = array( 'id_user' => '','username' => '', 'password' => '', 'role' => '');
      $hitung = count(array_intersect_key($_POST, $arrcheckpost));
      if($hitung == count($arrcheckpost)){
             $result = mysqli_query($con, "INSERT INTO tb_user SET
             id_user = '$_POST[id_user]',
             username = '$_POST[username]',
             password = '$_POST[password]',
             role = '$_POST[role]'
             ") or die (mysqli_error($con));
            if($result){
                 $response=array(
                     'status' => 1,
                     'message' =>'User Added Successfully.'
                 );
            } else {
               $response=array(
                  'status' => 0,
                  'message' =>'User Addition Failed.'
               );
            }
      } else {
         $response=array(
                  'status' => 0,
                  'message' =>'Parameter Do Not Match'
               );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   //function untuk menambahkan data kedalam tabel mahasiswa menggunakan metode POST, tanpa parameter
   public function insert_mhs(){
         global $con;
         $arrcheckpost = array( 'id_user' => '','username' => '', 'nama' => '',  'jkel' => '', 'alamat'   => '', 'no_telp' => '', 'instansi' => '');
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));

         if($hitung == count($arrcheckpost)){
            $gambar = upload();
            if(!$gambar){
                return false;
            }
            $result = mysqli_query($con, "INSERT INTO tb_mahasiswa SET
            id_user = '$_POST[id_user]',
            nama = '$_POST[nama]',
            username = '$_POST[username]',
            jkel = '$_POST[jkel]',
            alamat = '$_POST[alamat]',
            no_telp = '$_POST[no_telp]',
            instansi = '$_POST[instansi]',
            gambar = '$gambar'
            ") or die (mysqli_error($con));

            if($result){
                  $response=array(
                     'status' => 1,
                     'message' =>'Mahasiswa Added Successfully.'
                  );
            } else {
               $response=array(
                  'status' => 0,
                  'message' =>'Mahasiswa Addition Failed.'
               );
            }
         } else {
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }

   //function untuk edit atau merubah data yang sudah ada di dalam tabel user. menggunakan parameter id user untuk menentukan row mana yang ingin dirubah, data baru dapat ditulis dibagian form-data. menggunakan metode POST
   function update_user($id){
      global $con;
      $arrcheckpost = array( 'username' => '', 'password' => '', 'role' => '');
      $hitung = count(array_intersect_key($_POST, $arrcheckpost));
      if($hitung == count($arrcheckpost)){
         
         $result = mysqli_query($con, "UPDATE tb_user SET
         username = '$_POST[username]',
         password = '$_POST[password]',
         role = '$_POST[role]'
         WHERE id_user='$id'
         ") or die(mysqli_error($con));
         
         if($result){
            $response=array(
               'status' => 1,
               'message' =>'User Updated Successfully.'
            );
         } else {
            $response=array(
               'status' => 0,
               'message' =>'User Updation Failed.'
            );
         }
      } else {
         $response=array(
                  'status' => 0,
                  'message' =>'Parameter Do Not Match'
               );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   //function untuk edit atau merubah data yang sudah ada di dalam tabel mahasiswa. menggunakan parameter id user untuk menentukan row mana yang ingin dirubah, data baru dapat ditulis dibagian form-data. menggunakan metode POST
   function update_mhs($id){
      global $con;
      // $data = json_decode(file_get_contents("php://upload"), true);
      $sql = "SELECT * FROM tb_mahasiswa
      WHERE id_user='$id'
      ";
      $query = mysqli_query($con, $sql);
      $data = mysqli_fetch_array($query);
      $gambarLama = $data['gambar'];
      if($_FILES['gambar']['error'] === 4){
         $gambar = $gambarLama;
      } else {
         $path = "upload/";
         unlink($path.$gambarLama);
         $gambar = upload();
      }
      $arrcheckpost = array( 'nama' => '', 'username' => '', 'jkel' => '', 'alamat'   => '', 'no_telp' => '', 'instansi' => '');
      $hitung = count(array_intersect_key($_POST, $arrcheckpost));
      if($hitung == count($arrcheckpost)){
         
            $result = mysqli_query($con, "UPDATE tb_mahasiswa SET
            nama = '$_POST[nama]',
            username = '$_POST[username]',
            jkel = '$_POST[jkel]',
            alamat = '$_POST[alamat]',
            no_telp = '$_POST[no_telp]',
            instansi = '$_POST[instansi]',
            gambar = '$gambar'
            WHERE id_user='$id'
            ") or die(mysqli_error($con));
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Mahasiswa Updated Successfully.'
               );
            } else {
               $response=array(
                  'status' => 0,
                  'message' =>'Mahasiswa Updation Failed.'
               );
            }
      } else {
         $response=array(
                  'status' => 0,
                  'message' =>'Parameter Do Not Match'
               );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   //function untuk delete row yang ada didalam tabel user. menggunakan parameter id user. metode DELETE
   function delete_user($id){
      global $con;

      $sql = "SELECT * FROM tb_mahasiswa
      WHERE id_user='$id'
      ";
      $query = mysqli_query($con, $sql);
      $data = mysqli_fetch_array($query);
      $gambar = $data['gambar'];
      $path = "upload/";

      $query="DELETE FROM tb_user WHERE id_user=".$id;
      if(mysqli_query($con, $query)){
         unlink($path.$gambar);
         $response=array(
            'status' => 1,
            'message' =>'User & Mahasiswa Deleted Successfully.'
         );
      } else {
         $response=array(
            'status' => 0,
            'message' =>'User Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
?>