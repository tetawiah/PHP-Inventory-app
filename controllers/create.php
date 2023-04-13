<?php

//require base_path("session.php");

$prod = $_POST['product'];
$manf = $_POST['manufacturer'];
$price = $_POST['price'];
$stock = $_POST['stock'];


Database::table('products','manufacturer')->save($prod,$price,$stock,$manf);

Router::redirect('location: /');





