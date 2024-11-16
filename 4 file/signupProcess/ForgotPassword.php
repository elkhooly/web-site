<?php
include "../connection.php";

include "../emailS/SMTP.php";
include "../emailS/PHPMailer.php";
include "../emailS/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your email';
        $mail->Password = 'your password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('your email', 'Reset Password');
        $mail->addReplyTo('your email', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Forgot Password Verification Code';

        $bodyContent = '<h2 style="color: #000;">Your Verification Code is</h2>
        <h1 style="color: blue;">'.$code.'</h1>';

        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending failed.';
        } else {
            echo 'Success';
        }
    } else {
        echo ("Invalid Email Address.");
    }
}
