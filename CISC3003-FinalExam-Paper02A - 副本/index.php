<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario A - User Registration</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>User Registration Form</h1>
    <form action="php/process-form.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="male"> Male
        <input type="radio" id="female" name="gender" value="female"> Female

        <label for="interests">Interests:</label>
        <input type="checkbox" name="interests[]" value="Coding"> Coding
        <input type="checkbox" name="interests[]" value="Music"> Music

        <label for="country">Country:</label>
        <select id="country" name="country">
            <option value="Macau">Macau</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Mainland China">Mainland China</option>
        </select>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4"></textarea>

        <button type="submit">Submit Record</button>
    </form>

    <footer>
        <p>CISC3003 Web Programming： TAN PAK LONG+ DC226991+ 2026</p>
    </footer>
</body>
</html>
