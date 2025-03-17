<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error]));
}

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$image = '';  

if ($_FILES['image']['error'] == 0) {
   
    $image = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);  
}

if ($id && $name && $description && $price >= 0) {
    $sql = "UPDATE juices SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $name, $description, $price, $image, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "การแก้ไขสินค้าสำเร็จ"]);
    } else {
        echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการแก้ไข"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ข้อมูลไม่ครบ"]);
}

$conn->close();
?>
