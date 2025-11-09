<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental - Add</title>
</head>
<body>

    <?php

        include('../component/function.php');
        include('../component/config.php')

    ?>


    <div class="container max-w-full min-h-screen bg-black text-white flex flex-col items-center justify-center">
        <div class="wrap bg-neutral-900 w-110 flex flex-col items-center p-10 rounded-lg shadow-2xl shadow-teal-300/40">
            <form action="rental-process.php" method="post" class="flex flex-col" enctype="multipart/form-data">

            <h1 class="font-semibold text-3xl text-center py-3">Add New Rental Package</h1>
            <p class="text-center">All Fields Are Required!</p>

            <br>

                <label for="package_name" class="text-neutral-300"> Package Name </label>
                <input type="text" name="package_name" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">



                <label for="details" class="text-neutral-300"> Description </label>
                <input type="text" name="details" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2" step="0.01">



                <label for="price" class="text-neutral-300"> Price </label>
                <input type="number" name="price" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">



                <label for="duration" class="text-neutral-300"> Duration (day, week, month) </label>
                <input type="text" name="duration" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">



                <input type="submit" value="Add Rental" name="add-rental" class="bg-teal-300 rounded-lg w-80 p-1 text-black font-semibold mb-1">
                <input type="reset" value="Reset" class="bg-teal-300 rounded-lg w-80 p-1 text-black font-semibold">
                <a href="rental-package.php" class="bg-neutral-700 rounded-lg w-80 p-1 text-white text-center font-semibold">Cancel</a>

                

            </form>
    </div>
    </div>

</body>
</html>