<?php

//require base_path("session.php");

if (isset($_GET['id'])) {;
    $id = $_GET['id'];
}

$loggedID= $_SESSION['id_user'];

$product = Database::table("products")->select()->where(column:'id_product',operator:"=",value:$id)->first();

$log = Database::table('users')->select('email')->where('id_user','=',$loggedID)->first();


view('edit.view.php',[
    'id' => $id,
    'product' => $product,
    'log' => $log,
]);
