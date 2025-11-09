<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental - Edit</title>
</head>

<body>

    <?php
    include('../component/config.php');
    include('../component/function.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM rental_packages WHERE package_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $rental = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$rental) {
            echo "<script>alert('Rental not found!'); window.location.href='rental-package.php';</script>";
            exit;
        }
    } else {
        header("Location: rental-package.php");
        exit;
    }
    ?>

    <div class="container max-w-full min-h-screen bg-black text-white flex flex-col items-center justify-center">
        <div class="wrap bg-neutral-900 w-120 flex flex-col items-center p-10 rounded-lg shadow-2xl shadow-teal-300/40">

            <form action="rental-update.php" method="post" class="flex flex-col">

                <h1 class="font-semibold text-3xl text-center py-3">Edit Car</h1>
                <p class="text-center">Update any fields below.</p>
                <br>

                <input type="hidden" name="package_id" value="<?php echo $rental['package_id']; ?>">

                <label for="package_name" class="text-neutral-300"> Package Name </label>
                <input type="text" name="package_name" value="<?php echo $rental['package_name']; ?>"
                    class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">

                <label for="details" class="text-neutral-300"> Description </label>
                <input type="text" name="details" value="<?php echo $rental['details']; ?>"
                    class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">

                <label for="price" class="text-neutral-300"> Price (RM) </label>
                <input type="number" name="price" value="<?php echo $rental['price']; ?>"
                    class="bg-neutral-700 rounded-lg w-80 p-1 mb-2" step="0.01">


                <label for="duration" class="text-neutral-300"> Duration (Day, Week, Month) </label>
                <input type="text" name="duration" value="<?php echo $rental['duration_days']; ?>"
                    class="bg-neutral-700 rounded-lg w-80 p-1 mb-2">


                <input type="submit" value="Update Rent" name="update"
                    class="bg-teal-300 rounded-lg w-80 p-1 text-black font-semibold mb-1">
                <a href="rental-package.php"
                    class="bg-neutral-700 rounded-lg w-80 p-1 text-white text-center font-semibold">Cancel</a>

            </form>

        </div>
    </div>

</body>

</html>