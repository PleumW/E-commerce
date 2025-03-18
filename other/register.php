<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $stmt->error . "');
              </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-orange-50 bg-cover bg-center bg-[url('https://images.pexels.com/photos/1410138/pexels-photo-1410138.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')]" >

<div class="w-96 h-96 p-6 bg-orange-300 rounded-full shadow-xl text-center flex flex-col items-center justify-center">
    <h2 class="text-black text-2xl font-bold mb-2">ลงทะเบียน</h2>
    <div class="flex items-center justify-center mb-2">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
</svg>

    </div>
    <form method="POST" class="flex flex-col items-center w-full space-y-2">
        <input type="text" name="username" placeholder="Username" required class="w-4/5 p-2 border border-gray-300 rounded-full text-center focus:outline-none focus:ring-2 focus:ring-orange-300">
        <input type="password" name="password" placeholder="Password" required class="w-4/5 p-2 border border-gray-300 rounded-full text-center focus:outline-none focus:ring-2 focus:ring-orange-300">
        <button type="submit" class="w-4/5 bg-orange-700 hover:bg-orange-900 text-white py-1 rounded-full font-semibold">Login</button>
    </form>
    <a href="login.php" class="mt-2 text-black hover:text-orange-700 text-md">หากมีบัญชีอยู่แล้ว? คลิ๊กเพื่อเข้าสู่ระบบ</a>
</div>


    
</body>
</html>

