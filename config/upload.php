<?php
require_once "config/database.php";
require_once "config/function.php";

$user = $_POST['user'];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {

  if ($_FILES["file"]["error"] > 0) {

    echo "Error: " . $_FILES["file"]["error"] . "<br>";

  } else {

    //Move the file to the uploads folder
    move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);

    //Get the File Location
    $filelocation = 'http://yourdomain.com/uploads/'.$_FILES["file"]["name"];

    //Get the File Size
    $size = ($_FILES["file"]["size"]/1024).' kB';

    //Save to your Database
    mysqli_query($connect_to_db, "INSERT INTO images (user, filelocation, size) VALUES ('$user', '$filelocation', '$size')");

    //Redirect to the confirmation page, and include the file location in the URL
    header('Location: confirm.php?location='.$filelocation);
  }
} else {
  //File type was invalid, so throw up a red flag!
  echo "Invalid File Type";
}

   //function upload gambar dan validasi gambar
function upload(){
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFIle = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];
  $formatGambar = ['jpg','jpeg','png'];
  $format = explode('.', $namaFile);
  $format = strtolower(end($format));
  if($error === 4){
      echo "<script>alert ('Gambar tidak ada!')</script>";
      return false;
  }
  if(!in_array($format,$formatGambar)){
      echo "<script>alert ('yang anda upload bukan gambar!')</script>";
      return false;
  }
  if($ukuranFIle > 10000000){
      echo "<script>alert ('Ukuran terlalu besar!')</script>";
      return false;
  }
  $namafilebaru = uniqid();
  $namafilebaru .= '.';
  $namafilebaru .= $format; 
  move_uploaded_file($tmpName,'upload/' . $namafilebaru);
  return $namafilebaru;
}
?>