<?php
require_once('../component/config.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Padam rekod dalam database
    $sql = "DELETE FROM rental_Packages WHERE package_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Package deleted successfully!'); window.location.href='rental-package.php';</script>";
    } else {
        echo "<script>alert('Failed to delete package.'); window.location.href='rental-package.php';</script>";
    }
} else {
    header("Location: rental-package.php");
    exit;
}
?>