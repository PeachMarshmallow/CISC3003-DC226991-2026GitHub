<?php
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/php/connect.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (strlen($_POST["password"]) < 8) {
        die("Password must be at least 8 characters");
    }
    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        die("Passwords must match");
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "UPDATE users
            SET password_hash = ?,
                reset_token_hash = NULL,
                reset_token_expires_at = NULL
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si", $password_hash, $user["id"]);
    $stmt->execute();

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <p>Password updated. You can now <a href='login.php'>login</a>.</p>
        <footer>
            <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
        </footer>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Reset Password</h1>
    <form method="post">
        <label for="password">New Password</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <button>Reset Password</button>
    </form>

    <footer>
        <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
    </footer>
</body>
</html>