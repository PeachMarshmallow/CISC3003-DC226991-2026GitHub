<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario C - Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Sign Up</h1>
    <form action="php/process-signup.php" method="post" id="signup">
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <button>Sign up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>

    <footer>
        <p>CISC3003 Web Programming: TAN PAK LONG + DC226991 + 2026</p>
    </footer>

    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <script src="js/validation.js"></script>
</body>
</html>
