<?php

namespace App\Controllers;

$env = parse_ini_file('../.env');

use App\PHPMailer\PHPMailer;
use App\PHPMailer\Exception;
use App\PHPMailer\SMTP;

// Define the email details
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $env['EMAIL_HOST'];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $env['EMAIL_ADDRESS'];                     //SMTP username
    $mail->Password   = $env['EMAIL_PASSWORD'];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = $env['EMAIL_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->CharSet = $env['EMAIL_CHARSET'];

    //Recipients
    $mail->setFrom('your.email@email.com', 'Freight Exchange');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your reset password link at Freight Exchange';
    $mail->Body    = '<!DOCTYPE html><html lang="pl"><meta charset="UTF-8">
                        <p>Hi &#128075;</p>
                        <p>The link to reset your password is below. Click it and follow the instructions.</p>
                        <p><a href=https://yourdomain.com/reset-password?token=' . $token . '>Reset your password</a></p>
                        <p>Kind regards,</p></html>
                        <p>Freight Exchange &#128666;</p>';
    $mail->AltBody = 'Your reset password link at Freight Exchange';
    $mail->addAddress($email);
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}