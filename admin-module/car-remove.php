<?php
require_once('../component/config.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Dapatkan nama gambar dulu
    $getImg = $pdo->prepare("SELECT image FROM car WHERE car_id = :id");
    $getImg->bindParam(':id', $id, PDO::PARAM_INT);
    $getImg->execute();
    $image = $getImg->fetchColumn();

    // Padam gambar dari folder
    if ($image && file_exists("../images/" . $image)) {
        unlink("../images/" . $image);
    }

    // Padam rekod dalam database
    $sql = "DELETE FROM car WHERE car_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Car deleted successfully!'); window.location.href='car-package.php';</script>";
    } else {
        echo "<script>alert('Failed to delete car.'); window.location.href='car-package.php';</script>";
    }
} else {
    header("Location: car-package.php");
    exit;
}
?>
