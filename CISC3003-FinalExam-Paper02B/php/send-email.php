<?php
// B.02 & B.03: PHPMailer logic
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/autoload.php"; // Assuming composer is used

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = new PHPMailer(true);

    try {
        // B.04: Debugging
        $mail->SMTPDebug = 2; // Enable verbose debug output (0 = off, 1 = client messages, 2 = client and server messages)
        $mail->Debugoutput = 'html';

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'j4858890@gmail.com';
        $mail->Password   = 'pitn pype ueph cdhs';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($_POST["email"], $_POST["name"]);
        $mail->addAddress('j4858890@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body    = $_POST["message"];

        $mail->send();
        
        // B.05: Post/Redirect/Get pattern
        header("Location: ../success.html");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
