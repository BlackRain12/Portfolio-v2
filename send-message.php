<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\autoload.php'; // Make sure the path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Use SMTP
        $mail->Host = 'smtp.mailtrap.io'; // Replace with your SMTP server
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = '525ff61b333ca5'; // SMTP username from your provider
        $mail->Password = '0e46e7e36ce8fe'; // SMTP password from your provider
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to (587 for TLS, 465 for SSL)

        // Recipients
        $mail->setFrom($email, $name); // Set sender from form input
        $mail->addAddress('dvdsiaw@gmail.com', 'David'); // Replace with your email address and name

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = '<p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>' .
                         '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>' .
                         '<p><strong>Message:</strong></p><p>' . nl2br(htmlspecialchars($message)) . '</p>';
        $mail->AltBody = 'Name: ' . htmlspecialchars($name) . "\n" .
                         'Email: ' . htmlspecialchars($email) . "\n" .
                         'Message: ' . htmlspecialchars($message);

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
