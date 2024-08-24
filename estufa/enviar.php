<?php

$nome = $_POST['campoNome'];
$email = $_POST['campoEmail'];
$duvida = $_POST['campoDuvida'];

include("config.php");
include("vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();                                   //Send using SMTP
    $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                          //Enable SMTP authentication
    $mail->Username   = SMTP_USER;                     //SMTP username
    $mail->Password   = SMTP_PASS;                     //SMTP password
    $mail->Port       = SMTP_PORT;   
    $mail->CharSet = 'utf8';                                

    //Recipients
    $mail->setFrom($email, $nome);
    $mail->addAddress(SMTP_USER, 'GreenCode');
    $mail->addReplyTo($email, $nome);

    //Content
    $mail->isHTML(true);                                //Set email format to HTML
    $mail->Subject = 'Contato do site';
    $mail->Body    = $duvida;

    $mail->send();
    echo 'Success!';

} catch (Exception $e) {
    echo "No success. Mailer Error: {$mail->ErrorInfo}";
}

?>