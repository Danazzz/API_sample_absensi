<?php
require_once "config/function.php";

//deklarasi variabel mhs untuk menampung kelas mahasiswa di function.php
$mhs = new Mahasiswa();

//deklarasi variabel untuk menampung $_SERVER["REQUEST_METHOD] = Mengembalikan metode permintaan yang digunakan untuk mengakses halaman
$request_method=$_SERVER["REQUEST_METHOD"];

switch ($request_method) {

   //apabila method yang digunakan GET
   case 'GET':
      //apabila parameter tidak kosong dan berisikan id, maka akan menjalankan function get_mhs yang dimana akan menampilkan salah satu data mahasiswa berdasarkan id
      if(!empty($_GET["id"]))
      {
         $id=intval($_GET["id"]);
         $mhs->get_mhs($id);
      }
      //apabila parameter kosong, maka akan menjalankan function get_mhss yang dimana akan menampilkan semua data yang ada didalam tabel mahasiswa
      else
      {
         $mhs->get_mhss();
      }
   break;

   //apabila method yang digunakan POST
   case 'POST':
      //apabila parameter tidak kosong dan berisikan id, maka akan menjalan function update untuk tabel user dan tabel mahasiswa. isikan data yang ingin diubah di form-data
      if(!empty($_GET["id"]))
      {
         $id=$_GET["id"];
         // $mhs->update_user($id);
         $mhs->update_mhs($id);
      }
      //jika tidak ada parameter, maka jalankan function insert untuk mengisi data baru di tabel user dan tabel mahasiswa. isikan data yang baru di form-data
      else
      {
         $mhs->insert_user();
         $mhs->insert_mhs();
      }
   break;

   case 'PUT':
      $id=$_GET["id"];
      $mhs->update_user($id);
      $mhs->update_mhs($id);
   break;

   //apabila method yang digunakan DELETE, maka jalankan function delete untuk menghapus data yang ada di tabel user dan tabel mahasiswa berdasarkan parameter yang masuk yaitu id
   case 'DELETE':
      $id= $_GET["id"];
      $mhs->delete_user($id);
      break;
   
   //case yang akan berjalan apabila tidak ada case yang cocok
   default:
   // Invalid Request Method
      header("HTTP/1.0 405 Method Not Allowed");
      break;
   break;
}
?>