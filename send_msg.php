<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@example.com';
        $mail->Password = 'your-email-password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; // TCP port to connect to (e.g., 587 for TLS, 465 for SSL)

        $mail->setFrom('from@example.com', 'Contact form');
        $mail->addAddress('joe@example.net', 'SRS Electrical');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = $message;

        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request!";
}
