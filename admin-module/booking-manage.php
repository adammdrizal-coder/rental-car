<?php
require_once('../component/config.php');
require_once('../component/function.php');
require_once('../component/nav-admin.php');

// Handle approval/rejection/remove
if (isset($_POST['action'], $_POST['booking_id'])) {
    $action = $_POST['action'];
    $booking_id = $_POST['booking_id'];

    if (in_array($action, ['Approved', 'Rejected'])) {
        $stmt = $pdo->prepare("UPDATE booking SET booking_status = :status WHERE booking_id = :id");
        $stmt->execute(['status' => $action, 'id' => $booking_id]);
    } elseif ($action === 'Remove') {
        // Delete related payment first (if exists)
        $pdo->prepare("DELETE FROM payment WHERE booking_id = :id")->execute(['id' => $booking_id]);

        // Then delete booking
        $pdo->prepare("DELETE FROM booking WHERE booking_id = :id")->execute(['id' => $booking_id]);
    }
}

// Get all bookings
$stmt = $pdo->prepare("
    SELECT 
        b.booking_id, 
        u.name, 
        c.car_name, 
        p.package_name,
        b.pickup_state,
        b.pickup_city,
        b.dropoff_state,
        b.dropoff_city, 
        b.start_date, 
        b.end_date, 
        b.total_amount, 
        b.booking_status,
        pay.payment_proof
    FROM booking b
    JOIN user u ON b.user_id = u.user_id
    JOIN car c ON b.car_id = c.car_id
    JOIN rental_packages p ON b.package_id = p.package_id
    LEFT JOIN payment pay ON b.booking_id = pay.booking_id
    ORDER BY b.booking_id DESC
");
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Bookings</title>
  <script>
    function showProof(imgPath) {
      const modal = document.getElementById('proofModal');
      const img = document.getElementById('proofImg');
      img.src = imgPath;
      modal.classList.remove('hidden');
    }
    function closeModal() {
      document.getElementById('proofModal').classList.add('hidden');
    }
  </script>
</head>
<body class="bg-black text-white">

  <div class="min-h-screen flex flex-col items-center py-12">
    <h1 class="text-4xl font-bold text-teal-300 mb-10 drop-shadow-[0_0_15px_#14b8a6]">
      Manage Bookings
    </h1>

    <div class="w-full max-w-full bg-neutral-900 rounded-2xl p-6 shadow-lg shadow-teal-400/30 overflow-x-auto">
  <table class="min-w-full text-xs text-gray-300 whitespace-nowrap">
    <thead class="bg-neutral-800 text-teal-300 uppercase">
      <tr>
        <th class="px-2 py-2 text-left">Customer</th>
        <th class="px-2 py-2 text-left">Car</th>
        <th class="px-2 py-2 text-left">Package</th>
        <th class="px-2 py-2 text-left">Pickup</th>
        <th class="px-2 py-2 text-left">Dropoff</th>
        <th class="px-2 py-2 text-left">Start</th>
        <th class="px-2 py-2 text-left">End</th>
        <th class="px-2 py-2 text-left">Amount (RM)</th>
        <th class="px-2 py-2 text-left">Status</th>
        <th class="px-2 py-2 text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($bookings): ?>
        <?php foreach ($bookings as $b): ?>
          <tr class="border-b border-neutral-800 hover:bg-neutral-800/60 transition">
            <td class="px-2 py-2"><?= htmlspecialchars($b['name']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['car_name']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['package_name']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['pickup_state']); ?>, <?= htmlspecialchars($b['pickup_city']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['dropoff_state']); ?>, <?= htmlspecialchars($b['dropoff_city']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['start_date']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['end_date']); ?></td>
            <td class="px-2 py-2"><?= htmlspecialchars($b['total_amount']); ?></td>
            <td class="px-2 py-2">
              <?php if ($b['booking_status'] == 'Pending'): ?>
                <span class="text-yellow-400 font-semibold">Pending</span>
              <?php elseif ($b['booking_status'] == 'Approved'): ?>
                <span class="text-green-400 font-semibold">Approved</span>
              <?php else: ?>
                <span class="text-red-400 font-semibold">Rejected</span>
              <?php endif; ?>
            </td>
            <td class="px-2 py-2 text-center space-x-1">
              <?php if ($b['payment_proof']): ?>
                <button onclick="showProof('../uploads/payment/<?= $b['payment_proof']; ?>')" 
                        class="bg-blue-500 hover:bg-blue-400 text-white px-2 py-1 rounded-md text-[10px] font-semibold">
                  Proof
                </button>
              <?php endif; ?>

              <?php if ($b['booking_status'] == 'Pending'): ?>
                <form method="POST" class="inline">
                  <input type="hidden" name="booking_id" value="<?= $b['booking_id']; ?>">
                  <input type="hidden" name="action" value="Approved">
                  <button type="submit" class="bg-green-500 hover:bg-green-400 text-black px-2 py-1 rounded-md text-[10px] font-bold">Approve</button>
                </form>

                <form method="POST" class="inline">
                  <input type="hidden" name="booking_id" value="<?= $b['booking_id']; ?>">
                  <input type="hidden" name="action" value="Rejected">
                  <button type="submit" class="bg-red-500 hover:bg-red-400 text-black px-2 py-1 rounded-md text-[10px] font-bold">Reject</button>
                </form>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="10" class="text-center py-6 text-gray-500">No bookings found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

  </div>

  <!-- Modal Bukti Pembayaran -->
  <div id="proofModal" class="hidden fixed inset-0 bg-black/70 flex justify-center items-center z-50">
    <div class="bg-neutral-900 rounded-xl p-6 shadow-lg text-center relative">
      <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-400 hover:text-white text-2xl">&times;</button>
      <h2 class="text-xl font-semibold text-teal-300 mb-4">Payment Proof</h2>
      <img id="proofImg" src="" alt="Proof" class="max-h-[70vh] rounded-lg border border-teal-400 mx-auto">
    </div>
  </div>

</body>
</html>
