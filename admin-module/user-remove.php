<?php
require_once('../component/config.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];


    $sql = "DELETE FROM user WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href='user-manage.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user.'); window.location.href='user-manage.php';</script>";
    }
} else {
    header("Location: user-manage.php");
    exit;
}
?>
