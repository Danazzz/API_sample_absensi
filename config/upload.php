<?php
require_once "config/database.php";
require_once "config/function.php";

//function upload gambar dan validasi gambar
function upload(){
    $data = json_decode(file_get_contents("php://input"), true);

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $formatGambar = ['jpg','jpeg','png'];
    $format = explode('.', $namaFile);
    $format = strtolower(end($format));
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $format;
    $upload_path = 'upload/';

    if(empty($namaFile) AND $error === 4){
        $errorMSG = json_encode(array("message" => "please select image", "status" => false));	
        echo $errorMSG;
    } else {
        // allow valid image file formats
        if(in_array($format, $formatGambar)){				
            //check file not exist our upload folder path
            if(!file_exists($upload_path . $namaFile)){
                // check file size '5MB'
                if($ukuranFile < 5000000){
                    move_uploaded_file($tmpName, $upload_path . $namaFileBaru); // move file from system temporary path to our upload folder path 
                } else {		
                    $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));	
                    echo $errorMSG;
                }
            } else {
                $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));	
                echo $errorMSG;
            }
        } else {		
            $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));	
            echo $errorMSG;		
        }
    }

    // if no error caused, continue ....
    if(!isset($errorMSG)){
        return $namaFileBaru;
    }
}

function update_file(){

}
?>