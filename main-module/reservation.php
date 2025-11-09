<?php
require_once('../component/config.php');
require_once('../component/function.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /CarRental/main-module/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: /CarRental/main-module/cars.php");
    exit;
}

$car_id = $_GET['id'];

// Dapatkan maklumat kereta
$stmt = $pdo->prepare("SELECT * FROM car WHERE car_id = :car_id");
$stmt->execute(['car_id' => $car_id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

// Dapatkan senarai pakej
$packages = $pdo->query("SELECT * FROM rental_packages")->fetchAll(PDO::FETCH_ASSOC);

// Dapatkan senarai negeri (state)
$states = $pdo->query("SELECT DISTINCT state FROM locations ORDER BY state ASC")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = getUserIdByEmail($pdo, $_SESSION['user']);
    $package_id = $_POST['package_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $pickup_state = $_POST['pickup_state'];
    $pickup_city = $_POST['pickup_city'];
    $dropoff_state = $_POST['dropoff_state'];
    $dropoff_city = $_POST['dropoff_city'];

    $stmt = $pdo->prepare("SELECT package_name, duration_days, price FROM rental_packages WHERE package_id = :id");
    $stmt->execute(['id' => $package_id]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$package) {
        echo "<script>alert('Invalid package selected.');</script>";
        exit;
    }

    $package_name = strtolower($package['package_name']);
    $duration_days = $package['duration_days'];
    $package_price = $package['price'];
    $car_price = $car['price_per_day'];

    $days = (strtotime($end_date) - strtotime($start_date)) / 86400 + 1;
    if ($days < 1) $days = 1;

    if ($package_name === 'daily' && $days > 1) {
        echo "<script>alert('Daily package is only valid for 1 day!'); window.history.back();</script>";
        exit;
    }

    $total_amount = ($car_price * $duration_days) + $package_price;

    $proof = $_FILES['payment_proof']['name'];
    $target_dir = "../uploads/payment/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $target_file = $target_dir . basename($proof);
    move_uploaded_file($_FILES['payment_proof']['tmp_name'], $target_file);

    $stmt = $pdo->prepare("INSERT INTO booking (user_id, car_id, package_id, start_date, end_date, total_amount, booking_status, pickup_state, pickup_city, dropoff_state, dropoff_city)
                           VALUES (:user_id, :car_id, :package_id, :start_date, :end_date, :total_amount, 'Pending', :pickup_state, :pickup_city, :dropoff_state, :dropoff_city)");
    $stmt->execute([
        'user_id' => $user_id,
        'car_id' => $car_id,
        'package_id' => $package_id,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'total_amount' => $total_amount,
        'pickup_state' => $pickup_state,
        'pickup_city' => $pickup_city,
        'dropoff_state' => $dropoff_state,
        'dropoff_city' => $dropoff_city
    ]);

    $booking_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO payment (booking_id, payment_date, amount_paid, payment_proof)
                           VALUES (:booking_id, NOW(), :amount_paid, :payment_proof)");
    $stmt->execute([
        'booking_id' => $booking_id,
        'amount_paid' => $total_amount,
        'payment_proof' => $proof
    ]);

    header("Location: /CarRental/main-module/success.php");
    exit;
}

function getUserIdByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT user_id FROM user WHERE name = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['user_id'] : null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-black text-white">

<div class="flex justify-center items-center min-h-screen bg-gradient-to-b from-black to-neutral-900">
  <div class="bg-neutral-800 p-10 rounded-2xl shadow-lg w-[90%] md:w-[50%] my-10">
    <h1 class="text-3xl font-bold text-teal-400 mb-6 text-center">Car Reservation</h1>

    <div class="mb-6">
      <h2 class="text-2xl font-semibold mb-2"><?php echo htmlspecialchars($car['car_name']); ?></h2>
      <p class="text-gray-400">RM <?php echo htmlspecialchars($car['price_per_day']); ?> / day</p>
      <img src="/CarRental/images/<?php echo htmlspecialchars($car['image']); ?>" class="w-full rounded-xl mt-3">
    </div>

    <form method="POST" enctype="multipart/form-data" class="flex flex-col space-y-5" id="reservationForm">

      <!-- 🟢 PICKUP LOCATION -->
      <div>
        <label class="font-semibold text-lg text-teal-300">Pickup Location</label>
        <div class="flex space-x-3 mt-2">
          <select name="pickup_state" id="pickup_state" required class="p-2 rounded bg-neutral-700 text-white w-1/2">
            <option value="">Select State</option>
            <?php foreach($states as $s): ?>
              <option value="<?= htmlspecialchars($s['state']) ?>"><?= htmlspecialchars($s['state']) ?></option>
            <?php endforeach; ?>
          </select>
          <select name="pickup_city" id="pickup_city" required class="p-2 rounded bg-neutral-700 text-white w-1/2">
            <option value="">Select City</option>
          </select>
        </div>
      </div>

      <!-- 🔵 DROPOFF LOCATION -->
      <div>
        <label class="font-semibold text-lg text-teal-300">Drop-off Location</label>
        <div class="flex space-x-3 mt-2">
          <select name="dropoff_state" id="dropoff_state" required class="p-2 rounded bg-neutral-700 text-white w-1/2">
            <option value="">Select State</option>
            <?php foreach($states as $s): ?>
              <option value="<?= htmlspecialchars($s['state']) ?>"><?= htmlspecialchars($s['state']) ?></option>
            <?php endforeach; ?>
          </select>
          <select name="dropoff_city" id="dropoff_city" required class="p-2 rounded bg-neutral-700 text-white w-1/2">
            <option value="">Select City</option>
          </select>
        </div>
      </div>

      <!-- Existing Package, Date & Payment -->
      <label class="font-semibold">Select Package</label>
      <select name="package_id" id="package" required class="p-2 rounded bg-neutral-700 text-white">
        <option value="">-- Choose Package --</option>
        <?php foreach($packages as $pkg): ?>
          <option 
            value="<?php echo $pkg['package_id']; ?>" 
            data-price="<?php echo $pkg['price']; ?>" 
            data-duration="<?php echo $pkg['duration_days']; ?>" 
            data-name="<?php echo strtolower($pkg['package_name']); ?>">
            <?php echo htmlspecialchars($pkg['package_name']); ?> (RM <?php echo htmlspecialchars($pkg['price']); ?>)
          </option>
        <?php endforeach; ?>
      </select>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="font-semibold">Start Date</label>
          <input type="date" id="start_date" name="start_date" required class="p-2 rounded w-full bg-neutral-700 text-white">
        </div>
        <div>
          <label class="font-semibold">End Date</label>
          <input type="date" id="end_date" name="end_date" required class="p-2 rounded w-full bg-neutral-700 text-white">
        </div>
      </div>

      <div class="mt-5">
        <label class="font-semibold">Scan QR to Pay</label>
        <img src="/CarRental/images/qr_maybank.jpg" class="rounded-lg mt-2 w-48 border border-teal-400">
      </div>

      <div>
        <label class="font-semibold">Upload Payment Proof</label>
        <input type="file" name="payment_proof" accept="image/*" required class="block mt-2 text-sm text-gray-300">
      </div>

      <p id="totalDisplay" class="text-xl text-teal-400 font-semibold text-center hidden">
        Total: RM <span id="totalAmount"></span>
      </p>

      <button type="submit" class="mt-5 bg-teal-400 hover:bg-teal-300 text-black font-bold py-2 px-4 rounded-xl transition duration-300">
        Confirm Reservation
      </button>
    </form>
  </div>
</div>

<script>
// 🧩 Dynamic City Fetch via AJAX
$('#pickup_state').change(function() {
  var state = $(this).val();
  $.post('get_city.php', { state: state }, function(data) {
    $('#pickup_city').html(data);
  });
});

$('#dropoff_state').change(function() {
  var state = $(this).val();
  $.post('get_city.php', { state: state }, function(data) {
    $('#dropoff_city').html(data);
  });
});

// 💰 Price Calculation
const carPrice = <?php echo $car['price_per_day']; ?>;
const packageSelect = document.getElementById('package');
const startDateInput = document.getElementById('start_date');
const endDateInput = document.getElementById('end_date');
const totalDisplay = document.getElementById('totalDisplay');
const totalAmount = document.getElementById('totalAmount');

function calculateTotal() {
  const selectedOption = packageSelect.options[packageSelect.selectedIndex];
  if (!selectedOption.value) return;

  const pkgPrice = parseFloat(selectedOption.dataset.price);
  const pkgDuration = parseInt(selectedOption.dataset.duration);
  const pkgName = selectedOption.dataset.name;

  const startDate = new Date(startDateInput.value);
  const endDate = new Date(endDateInput.value);
  const diffTime = endDate - startDate;
  const days = diffTime / (1000 * 3600 * 24) + 1;

  if (pkgName === 'daily' && days > 1) {
    alert('❌ Daily package is only valid for 1 day!');
    totalDisplay.classList.add('hidden');
    return;
  }

  if (!isNaN(pkgPrice)) {
    const total = (carPrice * pkgDuration) + pkgPrice;
    totalAmount.textContent = total.toFixed(2);
    totalDisplay.classList.remove('hidden');
  }
}

packageSelect.addEventListener('change', calculateTotal);
startDateInput.addEventListener('change', calculateTotal);
endDateInput.addEventListener('change', calculateTotal);
</script>

</body>
</html>
