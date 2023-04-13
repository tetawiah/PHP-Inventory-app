<?php


class Product
{
    //    private string $id_product;
    //    private string $product_name;
    //    private string $price;
    //    private string $stock;
    private string $manufacturer_id;
    private string $user_id;
    //    private string $editedby;
    //    private string $createdAt;
    //    private string $updatedAt;

    public function __construct(string $manufacturer_id = "", string $user_id = "")
    {
        $this->manufacturer_id = $manufacturer_id;
        $this->user_id = $user_id;
    }

    public static function all()
    {
        return Database::table('products')->select()->get();
    }

    public function manufacturer()
    {
        return Database::table('manufacturer')->select()->where('id_manf', "=", $this->manufacturer_id)->first();
    }

    public function user()
    {
        return Database::table('users')->select()->where("id_user", "=", $this->user_id)->first();
    }
}
