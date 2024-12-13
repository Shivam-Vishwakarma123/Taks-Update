<?php

// Include Composer's autoloader
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function getMailer() {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);  // Enable exceptions

    // Set up SMTP for PHPMailer
    $mail->isSMTP();
    $mail->Host = 'smtppro.zoho.in'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'shivam.v@nirvaat.com'; 
    $mail->Password = 'Svni@9284';    
    $mail->SMTPSecure = 'ssl'; 
    $mail->Port = 465;  

    // Enable SMTP debugging (0 = off, 1 = client messages, 2 = client and server messages)
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html'; 

    return $mail;
}
