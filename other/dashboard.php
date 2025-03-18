<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>
<nav class="bg-blue-500 text-white p-4 flex justify-between">
    <span>Welcome, <?php echo $_SESSION["username"]; ?>!</span>
    <a href="logout.php" class="bg-red-500 px-4 py-2 rounded">Logout</a>
</nav>
<h2>Dashboard</h2>
