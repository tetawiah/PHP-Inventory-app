<?php 

//require base_path("session.php");

$id = $_POST['id'];

Database::table("products")->where("id_product","=",$id)->destroy($id);

header('location: /');
exit();