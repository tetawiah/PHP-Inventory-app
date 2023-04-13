<?php

//require base_path("session.php");


        //SELECT * FROM products where manufacturer_id IN (SELECT id_manf FROM manufacturer) AND user_id IN (SELECT id_user FROM users);

//$result = Database::table("products")->select()->where("manufacturer_id","IN","")->table("manufacturer")->select("id_manf")->where("user_id","IN","")->table("users")->select("id_user")->subQuery();

//$products = Database::table("products")->select()->orderby("product_name")->get();

$products = Product::all();

view('index.view.php',[
   'products' => $products,
]
);

