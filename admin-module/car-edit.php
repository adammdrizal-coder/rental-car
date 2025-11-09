<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR - Edit</title>
</head>
<body>

    <?php
        include('../component/config.php');
        include('../component/function.php');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $pdo->prepare("SELECT * FROM car WHERE car_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $car = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$car) {
                echo "<script>alert('Car not found!'); window.location.href='car-package.php';</script>";
                exit;
            }
        } else {
            header("Location: car-package.php");
            exit;
        }
    ?>

    <div class="container max-w-full min-h-screen bg-black text-white flex flex-col items-center justify-center">
        <div class="wrap bg-neutral-900 w-120 flex flex-col items-center p-10 rounded-lg shadow-2xl shadow-teal-300/40">
            
            <form action="car-update.php" method="post" enctype="multipart/form-data" class="flex flex-col">

                <h1 class="font-semibold text-3xl text-center py-3">Edit Car</h1>
                <p class="text-center">Update any fields below.</p>
                <br>

                <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">

                <label for="car_name" class="text-neutral-300"> Car Name </label>
                <input type="text" name="car_name" value="<?php echo $car['car_name']; ?>" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">

                <label for="price_per_day" class="text-neutral-300"> Price (/day) </label>
                <input type="number" name="price_per_day" value="<?php echo $car['price_per_day']; ?>" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2" step="0.01">

                <label for="features" class="text-neutral-300"> Car Features </label>
                <input type="text" name="features" value="<?php echo $car['features']; ?>" class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">

                <label for="image" class="text-neutral-300"> Current Car Image </label>
                <img src="../images/<?php echo $car['image']; ?>" alt="Car Image" class="w-60 h-30 object-cover rounded-md border border-neutral-700 mb-4">

                <label for="image" class="text-neutral-300"> Replace Image (optional) </label>
                <input type="file" name="image" class="bg-neutral-700 rounded-lg w-80 p-2 mb-10 text-sm" accept="image/*">

                <input type="submit" value="Update Car" name="update" class="bg-teal-300 rounded-lg w-80 p-1 text-black font-semibold mb-1">
                <a href="car-package.php" class="bg-neutral-700 rounded-lg w-80 p-1 text-white text-center font-semibold">Cancel</a>

            </form>

        </div>
    </div>

</body>
</html>
