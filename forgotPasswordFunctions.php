<?php
@include 'config.php';
require_once 'sendotp.php';

$type = isset($_POST['type']) ? $_POST['type'] : '';

$data = array();

// Function to generate a random OTP
function generateOtp()
{
    $gen = "1357902468";
    $res = "";

    for ($i = 1; $i <= 6; $i++) {
        $res .= substr($gen, (rand() % strlen($gen)), 1);
    }

    return $res;
}

// Verify email
if ($type == 'verifyEmail') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $email = mysqli_real_escape_string($conn, $email); // Prevent SQL Injection

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $otp = generateOtp();

        $data = array(
            "error" => false,
            "message" => "Email verified",
            "otp" => $otp
        );
    } else {
        $data = array(
            "error" => true,
            "message" => "Email not found",
            "otp" => ""
        );
    }
}

// Send OTP
if ($type == 'sendOtp') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $otp = isset($_POST['otp']) ? $_POST['otp'] : '';

    $sendotp = new SendOTPToGmail();
    $sendToGmail = $sendotp->sendOtp($email, $otp);

    if ($sendToGmail['error']) {
        $data = array(
            "error" => true,
            "otp" => "",
            "message" => $sendToGmail['message']
        );
    } else {
        $data = array(
            "error" => false,
            "otp" => $otp,
            "message" => ""
        );
    }
}

if ($type == 'changePassword') {
    $email = $_POST['email'];

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $hashedPassword = md5(htmlspecialchars($pass));
    mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'") or die('query failed');

    $data = array(
        "error" => false,
        "message" => "Password Changed Successfully"
    );

}

// Send response
header('Content-Type: application/json'); // Ensure correct content type
echo json_encode($data);
?>