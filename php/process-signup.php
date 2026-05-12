<?php
if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$activation_token = bin2hex(random_bytes(16));
$activation_token_hash = hash("sha256", $activation_token);

$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO users (name, email, password_hash, activation_token_hash)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash,
                  $activation_token_hash);
                  
if ($stmt->execute()) {
    // In a real application, you would send an email with the link:
    // http://localhost/php/activate-account.php?token=$activation_token
    // For this exam, we will output it for demonstration or just redirect
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <p>Signup successful. Please check your email to activate your account.</p>
        <p>Activation link (for demo): <a href='activate-account.php?token=<?= $activation_token ?>'>Activate Account</a></p>
        <footer>
            <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
        </footer>
    </body>
    </html>
    <?php
    exit;
} else {
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
