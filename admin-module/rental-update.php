<?php
require_once('../component/config.php');

if (isset($_POST['update'])) {
    $package_name = $_POST['package_name'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $duration_days = $_POST['duration'];
    $package_id = $_POST['package_id'];


        $sql = "UPDATE rental_packages 
                SET package_name = :package_name, details = :details, price = :price, duration_days = :duration_days
                WHERE package_id = :package_id";
        $stmt = $pdo->prepare($sql);


    $stmt->bindParam(':package_name', $package_name);
    $stmt->bindParam(':details', $details);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':duration_days', $duration_days);
     $stmt->bindParam(':package_id', $package_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Rental updated successfully!'); window.location.href='rental-package.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to update rent packages.'); window.history.back();</script>";
    }
} else {
    // Form not submitted
    header("Location: rental-package.php");
    exit;
}
?>
