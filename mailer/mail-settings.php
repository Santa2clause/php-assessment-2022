<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "SMTP";

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "ssl/tls";
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "corne.firsttech@gmail.com";
    $mail->Password   = "d0f476345b0313c9eb51d489e5ff5ef7";

    $mail->IsHTML(true);
    $mail->SetFrom("corne.firsttech@gmail.com");

