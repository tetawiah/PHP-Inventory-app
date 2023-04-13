<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function base_path($path) {

    return str_replace('\\' , DIRECTORY_SEPARATOR, __DIR__ . '/../' . $path);
}

function view($path,$attr=[]) {
    extract($attr);
    return require base_path('views/' . $path);
}

function abort($code =404) {
    http_response_code($code);
  
    include base_path('404.php');
    
    exit();
  }

  function validateEmail($email) : bool {
    return preg_match('/.*@.*\..*/', $email);
  }

  function validatePassword($password) {


    if(strlen($password) < 8) {
        return "Password should be at least 8 characters";
    }
 
    if(!preg_match("/[A-Z]/", $password)) {
        return "Password should contain at least a capital letter";
    }

        return null;

  }

  
  