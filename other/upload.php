<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
    echo json_encode(["success" => false, "message" => "กรุณาอัปโหลดรูปภาพ"]);
    exit;
}


$upload_dir = "uploads/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}


$name = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["description"];


$image_name = time() . "_" . basename($_FILES["image"]["name"]);
$image_path = $upload_dir . $image_name;


if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
   
    $sql = "INSERT INTO juices (name, price, description, image) VALUES ('$name', '$price', '$description', '$image_path')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "เพิ่มสินค้าสำเร็จ!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "อัปโหลดไฟล์ไม่สำเร็จ"]);
}

$conn->close();
?>
