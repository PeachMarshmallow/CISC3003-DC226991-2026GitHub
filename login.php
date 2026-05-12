<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/php/connect.php";
    
    $sql = sprintf("SELECT * FROM users WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            if ($user["account_active"]) {
                $_SESSION["user_id"] = $user["id"];
                header("Location: dashboard.php");
                exit;
            } else {
                die("Please activate your account via email first.");
            }
        }
    }
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"></head>
<body>
    <h1>Login</h1>
    <?php if (isset($is_invalid)): ?><em>Invalid login</em><?php endif; ?>
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button>Log in</button>
    </form>
    <p><a href="forgot-password.php">Forgot password?</a></p>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
    <footer><p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p></footer>
</body>
</html>
