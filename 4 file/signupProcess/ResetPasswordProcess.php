<?php
include "../connection.php";

include "../emailS/SMTP.php";
include "../emailS/PHPMailer.php";
include "../emailS/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["e"];
$NewPassword = $_POST["n"];
$REPassword = $_POST["r"];
$Verification = $_POST["v"];

if ($NewPassword != $REPassword) {
    echo ("Password does not match.");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $Verification . "'");
    $num = $rs->num_rows;

    if ($num == 1) {

        Database::iud("UPDATE `user` SET `password`='" . $REPassword . "' WHERE `email`='" . $email . "'");

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

        $bodyContent = ' <div>
        <h2 style="color: #000;">Password Changed</h2>
        <h1 style="color: blue;">Successfully</h1>
        <br>
        <h4 style="color: #000;">Your password change was completed successfully.</h4>
    </div>';

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
