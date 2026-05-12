<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30); // 30 mins

    $mysqli = require __DIR__ . "/php/connect.php";

    $sql = "UPDATE users
            SET reset_token_hash = ?,
                reset_token_expires_at = ?
            WHERE email = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($mysqli->affected_rows) {
        // In real apps, send email: reset-password.php?token=$token
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        </head>
        <body>
            <p>Reset link (for demo): <a href='reset-password.php?token=<?= $token ?>'>Reset Password</a></p>
            <footer>
                <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
            </footer>
        </body>
        </html>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        </head>
        <body>
            <p>Email not found.</p>
            <footer>
                <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
            </footer>
        </body>
        </html>
        <?php
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Forgot Password</h1>
    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <button>Send</button>
    </form>

    <footer>
        <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
    </footer>
</body>
</html>