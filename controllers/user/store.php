<?php

$email = $_POST['email'];
$password = $_POST['password'];

if (User::verifyEmail($email)) {
    Router::redirect('location:/login');
}

if(!validateEmail($email)) {
    echo "<h2> Invalid email </h2>";
    exit();
}

$result = validatePassword($password);

if($result) {
    echo "<h2> $result </h2>";
    exit();

}

    User::register($email, password_hash($password, PASSWORD_BCRYPT));
    Router::redirect('location:/');




