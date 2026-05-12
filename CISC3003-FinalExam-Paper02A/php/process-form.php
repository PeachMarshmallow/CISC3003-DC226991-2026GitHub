<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/connect.php";

    // A.06: Validate data
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $gender = $_POST["gender"] ?? "";
    $interests = isset($_POST["interests"]) ? implode(", ", $_POST["interests"]) : "";
    $country = $_POST["country"] ?? "";
    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$email) {
        die("Invalid email format");
    }

    // A.07 & A.08: Prepared Statement to avoid SQL Injection
    $sql = "INSERT INTO users_a (name, email, gender, interests, country, message) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("ssssss", $name, $email, $gender, $interests, $country, $message);

    if ($stmt->execute()) {
        echo "Record saved successfully!";
    } else {
        die("Error: " . $mysqli->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <footer>
        <p>CISC3003 Web Programming： TAN PAK LONG+ DC226991+ 2026</p>
    </footer>
</body>
</html>
