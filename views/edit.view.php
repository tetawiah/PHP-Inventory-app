<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>


    <title>Update inventory</title>
</head>

<body>
    <main>

        <div class="flex items-center justify-center w-1/4 mt-9 w-full">
        <?php 
                        $manufacturer = Database::table("manufacturer")->select()->where("id_manf", "=", $product["manufacturer_id"])->first();
                        $user = Database::table("users")->select()->where("id_user", "=", $product["user_id"])->first();

        ?>
            <form class="border p-5" action="/update" method="post">
                <div class="ml-2 mt-4 mb-2">
                    <label class="inline">Product</label>
                    <input class="border-gray-400 w-full" type="text" name="product" value="<?php echo $product['product_name'] ?>" />
                </div>
                <div class="ml-2 mt-4 mb-2">
                    <label class="inline">Manufacturer</label>
                    <input class="border-gray-400 w-full" type="text" name="manufacturer" value="<?php echo $manufacturer['manufacturer_name'] ?>" />
                </div>
                <div class="ml-2 mt-4 mb-2">
                    <label class="inline">Price</label>
                    <input class="border-gray-400 w-full" type="text" name="price" value="<?php echo $product['price'] ?>" />
                </div>
                <div class="ml-2 mt-4 mb-2">
                    <label class="inline">Stock</label>
                    <input class="border-gray-400 w-full" type="text" name="stock" value="<?php echo $product['stock'] ?>" />
                </div>



                <div>
                    <button class="border bg-gray-800 text-white p-2 rounded-md mt-4 " name="update" type="submit">Update</button>
                </div>
                <input type="hidden" name="_method" value="PATCH"> </input>
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="editedby" value="<?= $log['email'] ?>">
            </form>
        </div>



    </main>
</body>

</html>