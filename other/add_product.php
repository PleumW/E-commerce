<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$image = $_POST['image']; 
$sql = "INSERT INTO juices (name, price, description, image) VALUES ('$name', '$price', '$description', '$image')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Product added successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
