<?php
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/connect.php";

$sql = "SELECT * FROM users
        WHERE activation_token_hash = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

$sql = "UPDATE users
        SET account_active = 1,
            activation_token_hash = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user["id"]);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Activated</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Account Activated</h1>
    <p>Your account has been successfully activated. You can now <a href="../login.php">login</a>.</p>

    <footer>
        <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
    </footer>
</body>
</html>