<?php

    # mailer.inc.php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rafael.jaques@bento.ifrs.edu.br';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;