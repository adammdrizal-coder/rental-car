<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
</head>
<body class="bg-black text-white font-sans">

  <?php
    require_once('../component/config.php');
    require_once('../component/function.php');
    require_once('../component/nav-admin.php');

    // Stats
    $totalCars = $pdo->query("SELECT COUNT(*) FROM car")->fetchColumn();
    $totalUsers = $pdo->query("SELECT COUNT(*) FROM user")->fetchColumn();
    $totalBookings = $pdo->query("SELECT COUNT(*) FROM booking")->fetchColumn();

    // Latest bookings
    $stmt = $pdo->prepare("
      SELECT b.Booking_ID, u.name, c.car_name, p.package_name, b.booking_status, b.start_date, b.end_date
      FROM booking b
      JOIN user u ON b.user_id = u.user_id
      JOIN car c ON b.car_id = c.car_id
      JOIN rental_packages p ON b.package_id = p.package_id
      ORDER BY b.booking_id DESC
      LIMIT 5
    ");
    $stmt->execute();
    $latestBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <div class="min-h-screen flex flex-col items-center justify-center pb-30">
    
    <!-- Title -->
    <h1 class="text-4xl font-bold text-teal-300 mb-12 drop-shadow-[0_0_15px_#14b8a6]">
      Admin Dashboard
    </h1>

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-12 w-[80%] max-w-6xl mb-12">
      <div class="bg-neutral-900 shadow-lg shadow-teal-400/30 rounded-2xl p-8 text-center">
        <h2 class="text-xl text-gray-300">Total Cars</h2>
        <p class="text-5xl font-bold text-teal-300 mt-2"><?= $totalCars; ?></p>
      </div>
      <div class="bg-neutral-900 shadow-lg shadow-teal-400/30 rounded-2xl p-8 text-center">
        <h2 class="text-xl text-gray-300">Total Users</h2>
        <p class="text-5xl font-bold text-teal-300 mt-2"><?= $totalUsers; ?></p>
      </div>
      <div class="bg-neutral-900 shadow-lg shadow-teal-400/30 rounded-2xl p-8 text-center">
        <h2 class="text-xl text-gray-300">Bookings</h2>
        <p class="text-5xl font-bold text-teal-300 mt-2"><?= $totalBookings; ?></p>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-6 mb-14">
      <a href="car-add.php" class="bg-teal-400 hover:bg-teal-300 text-black font-semibold px-6 py-2 rounded-lg shadow-md transition-all">
        + Add New Car
      </a>
      <a href="car-package.php" class="bg-neutral-900 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-lg border border-teal-400 transition-all">
        Manage Cars
      </a>
      <a href="user-manage.php" class="bg-neutral-900 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-lg border border-teal-400 transition-all">
        Manage Users
      </a>
      <a href="rental-package.php" class="bg-neutral-900 hover:bg-neutral-800 text-white font-semibold px-6 py-2 rounded-lg border border-teal-400 transition-all">
        Manage Rental
      </a>
    </div>

    <!-- Latest Bookings -->
    <div class="w-[90%] max-w-6xl bg-neutral-900 rounded-2xl p-8 shadow-lg shadow-teal-400/30">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-teal-300">Latest Bookings</h2>
        <a href="booking-manage.php" class="text-teal-400 hover:text-teal-300 text-sm font-semibold">View All</a>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-300">
          <thead class="bg-neutral-800 text-teal-300">
            <tr>
              <th class="px-4 py-2 text-left">Customer</th>
              <th class="px-4 py-2 text-left">Car</th>
              <th class="px-4 py-2 text-left">Package</th>
              <th class="px-4 py-2 text-left">Start</th>
              <th class="px-4 py-2 text-left">End</th>
              <th class="px-4 py-2 text-left">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($latestBookings): ?>
              <?php foreach ($latestBookings as $b): ?>
                <tr class="border-b border-neutral-800 hover:bg-neutral-800/60 transition">
                  <td class="px-4 py-2"><?= htmlspecialchars($b['name']); ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($b['car_name']); ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($b['package_name']); ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($b['start_date']); ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($b['end_date']); ?></td>
                  <td class="px-4 py-2">
                    <?php if ($b['booking_status'] == 'Pending'): ?>
                      <span class="text-yellow-400 font-semibold">Pending</span>
                    <?php elseif ($b['booking_status'] == 'Approved'): ?>
                      <span class="text-green-400 font-semibold">Approved</span>
                    <?php else: ?>
                      <span class="text-red-400 font-semibold"><?= htmlspecialchars($b['booking_status']); ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="6" class="text-center py-4 text-gray-500">No bookings found</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</body>
</html>
