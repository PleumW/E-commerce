<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            header("Location: index.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head> 
<body class="flex items-center justify-center min-h-screen bg-orange-50 bg-cover bg-center bg-[url('https://images.pexels.com/photos/1410138/pexels-photo-1410138.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')]" >

    <div class="w-96 h-96 p-6 bg-orange-300 rounded-full shadow-xl text-center flex flex-col items-center justify-center">
        <h2 class="text-black text-2xl font-bold mb-2">เข้าสู่ระบบ</h2>
        <div class="flex items-center justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>
        <form method="POST" class="flex flex-col items-center w-full space-y-2">
            <input type="text" name="username" placeholder="Username" required class="w-4/5 p-2 border border-gray-300 rounded-full text-center focus:outline-none focus:ring-2 focus:ring-orange-300">
            <input type="password" name="password" placeholder="Password" required class="w-4/5 p-2 border border-gray-300 rounded-full text-center focus:outline-none focus:ring-2 focus:ring-orange-300">
            <button type="submit" class="w-4/5 bg-orange-700 hover:bg-orange-900 text-white py-1 rounded-full font-semibold">Login</button>
        </form>
        <a href="register.php" class="mt-2 text-black hover:text-orange-700 text-md">หากยังไม่มีบัญชี? ลงทะเบียน</a>
    </div>



</body>
</html>

