<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/php/connect.php";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
} else {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"></head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user["name"]) ?></h1>
    <p>You joined our site on: <?= htmlspecialchars($user["created_at"]) ?></p>
    
    <h2>User Services</h2>
    <ul>
        <li><a href="#">Profile Settings</a></li>
        <li><a href="#">Security Options</a></li>
        <li><a href="#">Activity Logs</a></li>
    </ul>

    <a href="logout.php">Log out</a>
    <footer><p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p></footer>
</body>
</html>
