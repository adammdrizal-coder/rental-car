<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require_once ('../component/config.php');
        require_once '../component/function.php';
        $cars = totalCar($pdo);
    ?>
    <title>Cars</title>
</head>
<body class="bg-black text-white">

    <?php require_once '../component/nav.php'; ?>

    <!-- Hero Section -->
    <div class="rectangle bg-[url('/CarRental/images/cars-page.png')] bg-cover bg-no-repeat max-w-full min-h-screen flex justify-center items-center text-center">
        <div class="center-box flex flex-col items-center">
            <h1 class="text-white text-5xl font-semibold drop-shadow-lg">Explore Our Cars</h1>
            <button id="scrollBtn" class="mt-10 text-5xl hover:scale-110 duration-300 ease-in-out text-teal-300">
                <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
            </button>       
        </div>
    </div>

    <!-- Cars Section -->
    <div class="container-car max-w-full min-h-screen bg-black text-white flex flex-col" id="container">
        <div class="cards-car grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 items-center m-auto p-10">

            <?php foreach($cars as $car): ?>
                <div class="cars w-80 bg-neutral-900 border border-neutral-800 rounded-2xl shadow-lg hover:scale-105 transition duration-300 ease-in-out overflow-hidden">
                    
                    <img src="/CarRental/images/<?php echo htmlspecialchars($car['image']); ?>" 
                         alt="Car Image" 
                         class="w-full h-48 object-cover rounded-t-2xl">

                    <div class="text-image p-5">
                        <h1 class="text-2xl font-bold mb-3 text-white">
                            <?php echo htmlspecialchars($car['car_name']); ?>
                        </h1>

                        <div class="menu flex flex-wrap gap-2 mb-4">
                            <p class="bg-neutral-700 px-4 py-1 rounded-xl text-sm">
                                <?php echo htmlspecialchars($car['features']); ?>
                            </p>
                        </div>

                        <h2 class="text-teal-300 text-xl font-semibold mb-4">
                            RM <?php echo htmlspecialchars($car['price_per_day']); ?>
                            <span class="text-sm font-normal text-white">/day</span>
                        </h2>

                        <?php if (isset($_SESSION['user'])): ?>
                            <!-- ✅ Logged in -->
                            <a href="/CarRental/main-module/reservation.php?id=<?php echo $car['car_id']; ?>" 
                               class="block w-full text-center p-2 bg-teal-400 hover:bg-teal-300 rounded-xl text-black font-semibold transition">
                                Book Now
                            </a>
                        <?php else: ?>
                            <!-- 🚫 Not logged in -->
                            <a href="/CarRental/main-module/login.php?redirect=/CarRental/main-module/reservation.php?id=<?php echo $car['car_id']; ?>" 
                               class="block w-full text-center p-2 bg-neutral-800 hover:bg-neutral-700 rounded-xl text-gray-300 transition">
                                Login to Book
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script>
            document.getElementById('scrollBtn').addEventListener('click', function(e) {
                e.preventDefault(); // elak default jump
                const target = document.getElementById('container');
                const startPosition = window.scrollY;
                const targetPosition = target.getBoundingClientRect().top + window.scrollY;
                const distance = targetPosition - startPosition;
                const duration = 500; // dalam ms (1s)
                let start = null;

                function smoothStep(timestamp) {
                    if (!start) start = timestamp;
                    const progress = timestamp - start;
                    const percent = Math.min(progress / duration, 1);
                    window.scrollTo(0, startPosition + distance * percent);
                    if (progress < duration) {
                        requestAnimationFrame(smoothStep);
                    }
                }

                requestAnimationFrame(smoothStep);
            });
    </script>


</body>
</html>
