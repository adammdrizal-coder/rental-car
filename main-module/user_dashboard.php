<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-black text-white">

<?php
    include('../component/config.php');
    include('../component/nav.php');

    if (!isset($_SESSION['user'])) {
        header("Location: /CarRental/auth/login.php");
        exit;
    }

    $user_name = $_SESSION['user'];
  $stmt = $pdo->prepare("
    SELECT b.*, c.car_name, p.package_name
    FROM booking b
    LEFT JOIN car c ON b.car_id = c.car_id
    LEFT JOIN rental_packages p ON b.package_id = p.package_id
    LEFT JOIN user u ON b.user_id = u.user_id
    WHERE u.name = ?
    ORDER BY b.booking_id ASC
    ");
    $stmt->execute([$user_name]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container max-w-8xl mx-auto p-8">
    <h1 class="text-4xl font-bold text-teal-300 mb-8 text-center">My Dashboard</h1>

    <?php if (count($bookings) > 0): ?>
        <div class="overflow-x-auto rounded-xl shadow-md border border-neutral-800">
            <table class="min-w-full text-left">
                <thead class="bg-neutral-900 text-teal-300 uppercase">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Car</th>
                        <th class="px-4 py-3">Package</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Pickup Location</th>
                        <th class="px-4 py-3">Dropoff Location</th>
                        <th class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($bookings as $b): ?>
                        <tr class="border-b border-neutral-800 odd:bg-neutral-950 even:bg-neutral-800 hover:bg-neutral-700">
                            <td class="px-4 py-3"><?= $no++ ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($b['car_name']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($b['package_name']) ?></td>
                            <td class="px-4 py-3 text-teal-400">RM<?= number_format($b['total_amount'], 2) ?></td>
                            <td class="px-4 py-3">
                                <?php
                                    $status = strtolower($b['booking_status']);
                                    $color = $status == 'pending' ? 'text-yellow-400' :
                                             ($status == 'approved' ? 'text-green-400' :
                                             ($status == 'rejected' ? 'text-red-400' : 'text-neutral-400'));
                                ?>
                                <span class="<?= $color ?> font-semibold"><?= ucfirst($b['booking_status']) ?></span>
                            </td>
                            <td class="px-4 py-3"><?= htmlspecialchars($b['pickup_state'])?>, <?= htmlspecialchars($b['pickup_city']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($b['dropoff_state'])?>, <?= htmlspecialchars($b['dropoff_city']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($b['start_date']) ?> → <?= htmlspecialchars($b['end_date'])?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-neutral-400 mt-10">You have no bookings yet. <a href="/CarRental/main-module/cars.php" class="text-teal-400 hover:text-teal-300">Book now</a>.</p>
    <?php endif; ?>
</div>

</body>
</html>
