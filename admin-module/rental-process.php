<?php

    require('../component/config.php');

    if ($_POST['add-rental']) {
        
        $package_name = $_POST['package_name'];
        $details = $_POST['details'];
        $price = $_POST['price'];
        $duration_days = $_POST['duration'];
        

            $sql = "INSERT INTO rental_packages (package_name, details, price, duration_days) VALUES (:package_name, :details, :price, :duration_days)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':package_name', $package_name);
            $stmt->bindParam(':details', $details);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':duration_days', $duration_days);

            if($stmt->execute()){

                echo '<script>alert("Successfully Adding New Item..."); window.location = "rental-package.php"</script>';

            } else {

                echo '<script>alert("Failed to Add New Item..."); window.location = "rental-add.php"</script>';

            }



    }