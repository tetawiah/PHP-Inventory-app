<?php


class Manufacturer
{

    private string $id_manf;

    public function all() {
        Database::table('manufacturer')->select()->get();
    }

    public function products() {
        Database::table('products')->select()->where('manufacturer_id',"=",$this->id_manf)->get();
    }
}
