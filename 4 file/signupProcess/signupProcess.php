<?php
include "../connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$email = $_POST["e"];
$password = $_POST["p"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo ("Please Enter Your First Name.");
} else if (strlen($fname) > 50) {
    echo ("First Name Must Contain LOWER THAN 50 characters.");
} else if (empty($lname)) {
    echo ("Please Enter Your Last Name.");
} else if (strlen($lname) > 50) {
    echo ("Last Name Must Contain LOWER THAN 50 characters.");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number Must Contain 10 characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalid Mobile Number."); //sri lankan mobile number
} else if (empty($email)) {
    echo ("Please Enter Your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email Address Must Contain LOWER THAN 100 characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($password)) {
    echo ("Please Enter Your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password Must Contain 5 to 20 Characters.");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "' OR `mobile`='" . $mobile . "'");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User with the same Email Address or same Mobile Number already exists.");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo"); //sri lankan time zone
        $d->setTimezone($tz);
        $data = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` 
    (`fname`,`lname`,`mobile`,`email`,`password`,`joined_date`,`gender_id`,`status_id`)
    VALUES 
    ('" . $fname . "','" . $lname . "','" . $mobile . "','" . $email . "','" . $password . "','" . $data . "','" . $gender . "','1')");

        $rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "'");
        $n = $rs->num_rows;

        if ($n == 1) {
            echo 'Success , Sign in please ';
        } else {
            echo 'Unsuccess Full';
        }
    }
}
