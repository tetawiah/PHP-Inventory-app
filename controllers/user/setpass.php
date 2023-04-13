<?php


$email = $_POST['email'];
$newPassword = $_POST['newpass'];
$confirmPassword = $_POST['confpass'];

if (! User::verifyEmail($email)) {
    echo "<h2> Account not Found </h2>";
    exit();
}

if(validateEmail($email)) {
    if ($newPassword !== $confirmPassword) {
        echo "<h2> Password mismatch </h2>";
        exit();
    }
    
    User::reset($email, $newPassword);
    
    Router::redirect('location: /login');
}


