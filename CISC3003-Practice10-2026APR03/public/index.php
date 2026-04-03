<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>dc226991 John tan pak long PHP</title>
</head>
<body>
    <h1>John PHP</h1>

    <p>ASCII ART:</p>
    <pre>
    JJJJJJJJ
        J
        J
        J
    J   J
     JJJ
    </pre>

    <p>SHA256 of "John":</p>
    <?php
        echo hash('sha256', 'John');
    ?>

    <p>
        <a href="fail.php">Click here to cause an error</a><br>
        <a href="check.php">Click here to check the setting</a>
    </p>
</body>
</html>
