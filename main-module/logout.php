<?php
session_start();

// Hapus session
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logging Out...</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta http-equiv="refresh" content="2;url=/CarRental/index.php"> <!-- auto redirect -->
</head>
<body class="bg-black flex items-center justify-center h-screen text-white font-sans">

  <div class="text-center animate-fade-in">
    <div class="w-16 h-16 border-4 border-t-teal-400 border-gray-700 rounded-full animate-spin mx-auto mb-6"></div>
    <h1 class="text-2xl font-semibold text-teal-300">Logging you out...</h1>
    <p class="text-neutral-400 mt-2">Please wait, you’ll be redirected shortly.</p>
  </div>

  <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fade-in 0.8s ease-out forwards;
    }
  </style>

</body>
</html>
