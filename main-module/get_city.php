<?php
include('../component/config.php');

if (isset($_POST['state'])) {
    $state = $_POST['state'];
    $stmt = $pdo->prepare("SELECT city FROM locations WHERE state = ? ORDER BY city ASC");
    $stmt->execute([$state]);
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<option value="">Select City</option>';
    foreach ($cities as $c) {
        echo '<option value="' . htmlspecialchars($c['city']) . '">' . htmlspecialchars($c['city']) . '</option>';
    }
}
?>
