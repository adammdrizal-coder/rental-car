<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Packages</title>
</head>
<body>

    <?php

        require_once('../component/config.php');
        require_once('../component/function.php');
        $product = rental($pdo)

    ?>

    <div class="container min-h-screen max-w-full bg-black text-white">

    <?php

        require_once('../component/nav-admin.php');

    ?>

        <div class="content flex flex-col justify-center items-center p-2">

            <h1 class="text-3xl text-white my-10"> Rental Packages </h1>

            <span class="w-11/12"><button class="bg-teal-300 text-black p-1 px-3 rounded-lg mb-3"><a href="rental-add.php"> + Add New</a></button></span>

            <table class="border-collapse border border-gray-700 w-11/12 text-center text-sm">
                <thead>
                    <tr>
                        <th class="border border-l-0 border-gray-700 p-2">Bil</th>
                        <th class="border border-gray-700 p-2">Package Name</th>
                        <th class="border border-gray-700 p-2">Description</th>
                        <th class="border border-gray-700 p-2">Price (RM)</th>
                        <th class="border border-gray-700 p-2">Day</th>
                        <th class="border border-r-0 border-gray-700 p-2">Action</th>
                    </tr>
                </thead>
                <tbody class="[&>tr:nth-child(odd)]:bg-neutral-900 [&>tr:nth-child(even)]:bg-neutral-800">

                <?php

                    $sno = 1;
                    foreach ($product as $data1) {
                        
                        ?>

                    <tr>
                        <td class="border-y border-gray-700 p-2"><?php echo $sno; ?></td>
                        <td class="border-y border-gray-700 p-2"><?php echo $data1['package_name']; ?></td>
                        <td class="border-y border-gray-700 p-2"><?php echo $data1['details']; ?></td>
                        <td class="border-y border-gray-700 p-2">RM <?php echo $data1['price']; ?></td>
                        <td class="border-y border-gray-700 p-2"><?php echo $data1['duration_days']; ?></td>
                        <td class="border-y border-gray-700 p-2">

                            <button class="bg-neutral-900 rounded-xl p-1 px-3"><a href="rental-edit.php?id=<?php echo $data1['package_id']; ?>">Edit</a></button>
                            <form action="rental-remove.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this package?')">
                                <input type="hidden" name="id" value="<?php echo $data1['package_id']; ?>">
                                <button type="submit" name="delete" class="bg-teal-300 text-black rounded-xl p-1 px-3 cursor-pointer">
                                
                                    Remove

                            </button>
                            </form>


                        </td>
                    </tr>



                <?php

                    $sno++;
                    }

                ?>
                </tbody>
            </table>

        </div>


    </div>


</body>
</html>