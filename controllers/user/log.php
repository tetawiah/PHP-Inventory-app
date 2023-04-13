<?php

$email = $_POST['email'];
$password = $_POST['password'];


User::login($email,$password);