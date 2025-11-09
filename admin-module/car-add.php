<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR - Add</title>
</head>
<body>

    <?php

        include('../component/function.php');
        include('../component/config.php')

    ?>


    <div class="container max-w-full min-h-screen bg-black text-white flex flex-col items-center justify-center">
        <div class="wrap bg-neutral-900 w-110 flex flex-col items-center p-10 rounded-lg shadow-2xl shadow-teal-300/40">
            <form action="car-process.php" method="post" class="flex flex-col" enctype="multipart/form-data">

            <h1 class="font-semibold text-3xl text-center py-3">Add New Car</h1>
            <p class="text-center">All Fields Are Required!</p>

            <br>

                <label for="car-name" class="text-neutral-300"> Car Name </label>
                <input type="text" name="car-name" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">



                <label for="price-per-day" class="text-neutral-300"> Price (/day) </label>
                <input type="number" name="price_per_day" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2" step="0.01">



                <label for="features" class="text-neutral-300"> Car Features </label>
                <input type="text" name="features" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">



                <label for="image" class="text-neutral-300"> Car Image </label>
                <input type="file" name="image" class="bg-neutral-700 rounded-lg w-80 p-2 mb-10 text-sm" accept="image/*">



                <input type="submit" value="Add Car" name="add-car" class="bg-teal-300 rounded-lg w-80 p-1 text-black font-semibold mb-1">
                <input type="reset" value="Reset" class="bg-teal-300 rounded-lg w-80 p-1 text-black font-semibold">
                <a href="car-package.php" class="bg-neutral-700 rounded-lg w-80 p-1 text-white text-center font-semibold">Cancel</a>

                

            </form>
    </div>
    </div>

</body>
</html>