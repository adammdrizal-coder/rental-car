<?php

    require('../component/config.php');

    if ($_POST['add-car']) {
        
        $car_name = $_POST['car-name'];
        $price_per_day = $_POST['price_per_day'];
        $features = $_POST['features'];

        $car_image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $target_dir = "../images/" . basename($car_image);

        if(move_uploaded_file($tmp_name, $target_dir)) {

            $sql = "INSERT INTO car (car_name, price_per_day, features, image) VALUES (:car_name, :price_per_day, :features, :image)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':car_name', $car_name);
            $stmt->bindParam(':price_per_day', $price_per_day);
            $stmt->bindParam(':features', $features);
            $stmt->bindParam(':image', $car_image);

            if($stmt->execute()){

                echo '<script>alert("Successfully Adding New Item..."); window.location = "car-package.php"</script>';

            } else {

                echo '<script>alert("Failed to Add New Item..."); window.location = "car-add.php"</script>';

            }

        

        } else {

            echo '<script>alert("Failed to upload Image...")';

        }

    }