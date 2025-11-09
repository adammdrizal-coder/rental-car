<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        require_once 'component/function.php';
    ?>

    <title>Home</title>

    <!-- 🔹 Animation Style -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 1s ease-out;
        }

        .hover-glow:hover {
            box-shadow: 0 0 15px rgba(45, 212, 191, 0.6);
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-black text-neutral-200">

    <div class="container max-w-full min-h-screen">

        <?php require_once 'component/nav.php'; ?>

        <div class="child-container max-w-full min-h-screen m-auto flex">
            <div class="textContent w-full md:w-1/2 h-screen flex justify-center items-center">
                <div class="wrap w-105">

                    <h2 class="text-teal-300 font-bold text-5xl">Luxury <span class="text-white">on</span><br> Demand</h2>
                    <p class="mt-5 mb-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            
                    <!-- 🔹 Quick Explore Section -->
                    <div class="search bg-neutral-800 p-5 py-15 rounded-xl fade-in text-center">
                        <h3 class="text-3xl font-semibold text-teal-300 mb-3">Quick Explore</h3>
                        <p class="text-gray-300 mb-6">Browse our premium collection of cars and packages made for your comfort and style.</p>

                        <div class="flex flex-col md:flex-row justify-center space-y-3 md:space-y-0 md:space-x-5">
                            <a href="/CarRental/main-module/cars.php" class="hover-glow border border-teal-300 px-10 py-2 rounded-md cursor-pointer hover:bg-teal-300 hover:text-black transition font-semibold">
                                Explore Cars
                            </a>
                            <a href="/CarRental/main-module/rental.php" class="hover-glow border border-teal-300 px-10 py-2 rounded-md cursor-pointer hover:bg-teal-300 hover:text-black transition font-semibold">
                                View Packages
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="image-wrapper w-1/2 hidden md:block">
                <img src="/CarRental/images/home-ferrari.png" alt="home-ferrari" class="h-screen w-full">
            </div>
        </div>
    </div>

    <div class="second-container max-w-full min-h-screen flex bg-neutral-800 flex-col justify-center">
        <h1 class="text-5xl font-semibold text-center relative bottom-20">Why Choose Us</h1>

        <div class="box flex justify-center space-x-10">
            <div class="box-1 w-1/5 bg-neutral-700 p-10 rounded-xl">
                <h2 class="text-2xl font-semibold text-center pb-5">Wide Selection of Cars</h2>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi.</p>
            </div>

            <div class="box-2 w-1/5 bg-neutral-700 p-10 rounded-xl">
                <h2 class="text-2xl font-semibold text-center pb-5">Affordable Prices</h2>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi.</p>
            </div>

            <div class="box-3 w-1/5 bg-neutral-700 p-10 rounded-xl">
                <h2 class="text-2xl font-semibold text-center pb-5">24/7 Premium Support</h2>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex sapien vitae pellentesque sem placerat in id cursus mi.</p>
            </div>
        </div>
    </div>

    <div class="container-third max-w-full min-h-screen flex flex-col justify-center items-center">
        <h1 class="text-5xl font-semibold text-center relative bottom-20">Popular Cars</h1>

        <div class="car-box flex justify-center space-x-10">
            <div class="box-1 w-1/5 bg-neutral-700 rounded-xl hover:scale-105 ease-in-out duration-75">
                <div class="image-card"><img src="/CarRental/images/merc-card.png" alt="" class="rounded-xl"></div>
                <div class="details p-10">
                    <p>Automatic, 4 Seats, GPS Navigation, Bluetooth Connectivity</p>
                    <h2 class="pt-5 text-xl font-semibold">$120<span class="text-lg font-normal">/day</span></h2>
                    <div class="button w-full flex flex-col">
                        <button class="mt-2 py-1 border-2 border-teal-300 rounded-md cursor-pointer hover:bg-teal-300 hover:text-black"><a href="reservation">Book Now</a></button>
                    </div>
                </div>
            </div>

            <div class="box-2 w-1/5 bg-neutral-700 rounded-xl hover:scale-105 ease-in-out duration-75">
                <div class="image-card"><img src="/CarRental/images/x5-card.png" alt="" class="rounded-xl"></div>
                <div class="details p-10">
                    <p>Automatic, 5 Seats, All-Wheel Drive, Panoramic Sunroof, Advanced Safety</p>
                    <h2 class="pt-5 text-xl font-semibold">$180<span class="text-lg font-normal">/day</span></h2>
                    <div class="button w-full flex flex-col">
                        <button class="mt-2 py-1 border-2 border-teal-300 rounded-md cursor-pointer hover:bg-teal-300 hover:text-black"><a href="">Book Now</a></button>
                    </div>
                </div>
            </div>

            <div class="box-3 w-1/5 bg-neutral-700 rounded-xl hover:scale-105 ease-in-out duration-75">
                <div class="image-card"><img src="/CarRental/images/a4-card.png" alt="" class="rounded-xl"></div>
                <div class="details p-10">
                    <p>Automatic, 4 Seats, Sport Mode, Premium Sound System, Leather Interior</p>
                    <h2 class="pt-5 text-xl font-semibold">$100<span class="text-lg font-normal">/day</span></h2>
                    <div class="button w-full flex flex-col">
                        <button class="mt-2 py-1 border-2 border-teal-300 rounded-md cursor-pointer hover:bg-teal-300 hover:text-black"><a href="/CarRental/main-module/reservation.php">Book Now</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
