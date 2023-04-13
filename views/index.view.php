<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

</head>

<body>
    <header class="bg-gray-800 text-white  w-full ">
        <div class="flex justify-between container mx-auto py-2 items-center">

            <div class="w-full flex justify-end">
                <h2 class="text-2xl font-bold">Inventory</h2>
            </div>
            <div class="w-full flex justify-end">
                <a href=/logout class=" font-bold">Log out</a>
            </div>
        </div>

    </header>
    <!--<main class="flex items-center justify-center"> -->
    <main>

        <div class="flex justify-evenly mt-9 w-full">
            <div>
                <form class="border p-5" action="/create" method="post">
                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Product</label>
                        <input class="border-gray-400 w-full" type="text" name="product" />
                    </div>
                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Manufacturer</label>
                        <input class="border-gray-400 w-full" type="text" name="manufacturer" />
                    </div>
                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Price</label>
                        <input class="border-gray-400 w-full" type="text" name="price" />
                    </div>
                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Stock</label>
                        <input class="border-gray-400 w-full" type="text" name="stock" />
                    </div>


                    <div>

                        <div><button class="border bg-gray-800 text-white p-2 rounded-md mt-4 " name="save" type="submit">Submit Form</button></div>

                    </div>
                </form>
            </div>



            <div>
                <form class="border p-5" action="/seach" method="get">
                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Product</label>
                        <input class="border-gray-400 w-full" type="text" name="product" />
                    </div>
                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Manufacturer</label>
                        <input class="border-gray-400 w-full" type="text" name="manufacturer" />
                    </div>

                    <div class="ml-2 mt-4 mb-2">
                        <label class="inline">Added by</label>
                        <input class="border-gray-400 w-full" type="text" name="addby" />
                    </div>


                    <div><button class="border bg-gray-800 text-white p-2 rounded-md mt-4 " name="serch" type="submit">Search</button></div>


                </form>

            </div>
        </div>



        <div class="m-2">
            <form action="/search" method="post">
                <input type="search" class="border p-2 w-1/4 bg-gray-100" name="search"> </input>
                <button class="border bg-gray-800 text-white p-2 rounded-md mt-4 " type="submit">Search</button>
        </div>


        <div class="w-full">
            <!-- <?php foreach ($result as $product) : ?>
            <ul><?= $product['product'] ?></ul>
        <?php endforeach ?> -->
            <table class=" border w-full mt-5">
                <thead class="bg-gray-800 text-white">
                    <th> <a href="/?sortby=product_name">Product </a></th>
                    <th> <a href="/?sortby=manufacturer_name"> Manufacturer </a> </th>
                    <th> <a href="/?sortby=price"> Price </a></th>
                    <th> <a href="/?sortby=stock"> Stock </a> </th>
                    <th><a href="/?sortby=added_by">Added By </a></th>

                    <th> <a href="?sortby=status">Edited By </a></th>
                    <th><a href="?sortby=createdAt">Created At</a></th>
                    <th><a href="/?sortby=updatedAt">Updated At</a></th>


                </thead>
                <tbody class="border text-center">
                    <?php
                    foreach ($products as $product) {
                        $prodInstance = new Product($product['manufacturer_id'], $product['user_id']);
                        $manufacturer = $prodInstance->manufacturer();
                        $user = $prodInstance->user();

                    ?>
                        <tr class>
                            <td><?php echo htmlspecialchars($product['product_name']) ?? ''; ?></td>
                            <td><?php echo htmlspecialchars($manufacturer['manufacturer_name']) ?? ''; ?></td>
                            <td><?php echo htmlspecialchars($product['price']) ?? ''; ?></td>
                            <td><?php echo htmlspecialchars($product['stock']) ?? ''; ?></td>
                            <td><?php echo htmlspecialchars($user['email']) ?? ''; ?></td>
                            <td><?= htmlspecialchars($product['editedby'] ?? 'None'); ?></td>
                            <td> <?= htmlspecialchars($product['createdAt'] ?? 'NaN') ?> </td>
                            <td> <?= htmlspecialchars($product['updatedAt'] ?? 'NaN') ?> </td>
                            <td>
                                <form method="POST" action="/delete">
                                    <button type="submit" class="bg-gray-200 hover:bg-gray-800 hover:text-white text-sm "> Remove</button>
                                    <input type="hidden" name='_method' value="DELETE"> </input>
                                    <input type="hidden" name='id' value=<?= $product['id_product'] ?>>
                                </form>
                            </td>
                            <td>
                                <form method="GET" action="/edit">
                                    <button type="submit" class="bg-gray-500 hover:bg-gray-800 hover:text-white text-sm "> Edit </button>
                                    <input type="hidden" name='id' value=<?= $product['id_product'] ?>>
                                </form>
                            </td>
                        </tr>

                    <?php

                    }
                    ?>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>