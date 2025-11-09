<?php
require_once('../component/config.php');

if (isset($_POST['update'])) {
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $price_per_day = $_POST['price_per_day'];
    $features = $_POST['features'];

    // Kalau user tukar gambar baru
    if (!empty($_FILES['image']['name'])) {
        $car_image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $target_dir = "../images/" . basename($car_image);

        // Ambil gambar lama
        $stmt = $pdo->prepare("SELECT image FROM car WHERE car_id = :car_id");
        $stmt->bindParam(':car_id', $car_id);
        $stmt->execute();
        $old_image = $stmt->fetchColumn();

        if (move_uploaded_file($tmp_name, $target_dir)) {
            if ($old_image && file_exists("../images/" . $old_image)) {
                unlink("../images/" . $old_image);
            }
        } else {
            echo "<script>alert('Failed to upload new image.'); window.history.back();</script>";
            exit;
        }

        $sql = "UPDATE car 
                SET car_name = :car_name, price_per_day = :price_per_day, features = :features, image = :image 
                WHERE car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':image', $car_image);
    } else {
        // Tak tukar gambar
        $sql = "UPDATE car 
                SET car_name = :car_name, price_per_day = :price_per_day, features = :features 
                WHERE car_id = :car_id";
        $stmt = $pdo->prepare($sql);
    }

    $stmt->bindParam(':car_name', $car_name);
    $stmt->bindParam(':price_per_day', $price_per_day);
    $stmt->bindParam(':features', $features);
    $stmt->bindParam(':car_id', $car_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Car updated successfully!'); window.location.href='car-package.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to update car.'); window.history.back();</script>";
    }
} else {
    header("Location: car-package.php");
    exit;
}
?>
