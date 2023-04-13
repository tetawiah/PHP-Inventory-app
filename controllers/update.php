<?php
//require base_path("session.php");


$id = $_POST['id'];


Database::table('products')->where(column: 'id_product', operator: '=', value: $id)->update([
    'product' => $_POST['product'], 
    'price' => $_POST['price'],
    'stock' => $_POST['stock'],
    'email' => $_POST['editedby'],
    'updatedAt' => date('Y/m/d H:i:s')

]);

$manufID = Database::table('products')->select('manufacturer_id')->where(column:'id_product',operator: "=",value:$id)->first();


Database::table('manufacturer')->where(column: 'id_manf', operator: '=', value: $manufID['manufacturer_id'])->update([
'manufacturer' => $_POST['manufacturer']]);

header('location: /');
exit();
