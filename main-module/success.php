<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Success</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white flex flex-col justify-center items-center min-h-screen">

  <div class="bg-neutral-800 p-10 rounded-2xl text-center shadow-xl">
    <h1 class="text-3xl text-teal-400 font-semibold mb-4">Reservation Successful!</h1>
    <p class="text-gray-300 mb-6">
      🎉 Your booking has been successfully submitted. We’ll contact you soon for confirmation.
    </p>
    <a href="/CarRental/main-module/user_dashboard.php" 
       class="bg-teal-400 text-black px-6 py-2 rounded-lg hover:bg-teal-500 font-semibold">
      Back to Cars
    </a>
  </div>

</body>
</html>
