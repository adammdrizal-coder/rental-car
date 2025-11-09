<?php
include('../component/config.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    if (isset($_POST['suspend'])) {
        $newStatus = 'suspended';
    } elseif (isset($_POST['activate'])) {
        $newStatus = 'active';
    } else {
        header("Location: user-manage.php");
        exit;
    }

    $stmt = $pdo->prepare("UPDATE user SET status = :status WHERE user_id = :id");
    $stmt->execute(['status' => $newStatus, 'id' => $id]);

    header("Location: user-manage.php");
    exit;
}
?>
