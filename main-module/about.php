<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require_once '../component/function.php'; ?>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <title>About us</title>
</head>
<body>

    <div class="container max-w-full min-h-screen">
    
        <?php require_once '../component/nav.php'; ?>

        <!-- HERO SECTION -->
        <div class="bg max-w-full min-h-screen bg-[url('/CarRental/images/about-bg.png')] opacity-100 bg-no-repeat bg-cover text-white">
            <div class="text flex flex-col justify-center items-center w-full">
                <h1 class="text-5xl font-bold mt-50 mb-3">About LuxRide</h1>
                <p>Elevating Every Journey with Unparalleled Luxury and Service</p>
                <button id="scrollBtn" class="mb-30 text-center pt-10 text-5xl hover:scale-105 duration-500 ease-in-out text-white">
                    <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <!-- OUR JOURNEY -->
        <div class="second-container max-w-full min-h-screen bg-black text-white flex flex-col justify-center items-center" id="container">

            <h1 class="font-semibold text-3xl text-teal-300">Our Journey: The LuxRide Story</h1>

            <div class="text flex my-20">
                <div class="left w-1/2 mx-10">
                    <p class="w-100">
                        LuxRide began with a singular vision: to redefine luxury transportation. Founded in 20XX, we set out to provide more than just a ride; we aimed to deliver an experience. 
                        From our meticulously maintained fleet to our professional chauffeurs, every detail is curated to ensure comfort, elegance, and peace of mind. 
                        Over the years, we've grown, but our core commitment remains steadfast: to offer an exceptional service that transcends expectations, 
                        making every journey with LuxRide a memorable one.
                    </p>
                </div>
                <div class="right w-1/2 mx-10">
                    <ul class="w-100">
                        <li class="p-2 list-disc">Seamless Booking: Effortless reservations through our intuitive platform.</li>
                        <li class="p-2 list-disc">Professional Chauffeurs: Expert, discreet, and dedicated to your safety and comfort.</li>
                        <li class="p-2 list-disc">Global Network: Offering premium service across major cities worldwide.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- OUR METRICS -->
        <div class="third-container max-w-full min-h-screen bg-neutral-800 text-white flex flex-col justify-center items-center">
            <div class="text flex flex-col justify-center items-center">
                <h1 class="text-3xl font-semibold">Our Metrics</h1>
                <p class="pt-4 mb-20">Dedicated to excellence and customer satisfaction.</p>
            </div>

            <div class="card-container flex justify-center items-center">
                <div class="grid grid-rows-1 md:grid-cols-4 gap-10">
                    <article class="w-50 bg-neutral-700 flex flex-col justify-center items-center py-10 rounded-xl">
                        <h1 class="text-4xl font-bold text-teal-300 py-3">250+</h1>
                        <p>Cars Available</p>
                    </article>
                    
                    <article class="w-50 bg-neutral-700 flex flex-col justify-center items-center py-10 rounded-xl">
                        <h1 class="text-4xl font-bold text-teal-300 py-3">15,000+</h1>
                        <p>Happy Customers</p>
                    </article>

                    <article class="w-50 bg-neutral-700 flex flex-col justify-center items-center py-10 rounded-xl">
                        <h1 class="text-4xl font-bold text-teal-300 py-3">Always On</h1>
                        <p>24/7 Support</p>
                    </article>

                    <article class="w-50 bg-neutral-700 flex flex-col justify-center items-center py-10 rounded-xl">
                        <h1 class="text-4xl font-bold text-teal-300 py-3">10 Years</h1>
                        <p>Experience</p>
                    </article>
                </div>
            </div>
        </div>

        <!-- OUR TEAM -->
        <div class="fourth-container max-w-full min-h-screen bg-black text-white flex flex-col justify-center items-center">
            <div class="text flex flex-col justify-center items-center">
                <h1 class="text-4xl font-semibold">Meet Our Team</h1>
                <p class="pt-3 mb-20">The passionate individuals driving LuxRide forward.</p>
            </div>

            <div class="image-container flex justify-center items-center">
                <main class="grid grid-rows-1 md:grid-cols-3 gap-20">
                    <article class="w-65 bg-neutral-800 p-10 flex flex-col justify-center items-center rounded-xl">
                        <img src="/CarRental/images/seller.png" alt="" class="rounded-full w-30 bg-white">
                        <h2 class="text-2xl font-semibold">John Doe</h2>
                        <p class="text-neutral-400 py-3">CEO & Founder</p>
                    </article>

                    <article class="w-65 bg-neutral-800 p-10 flex flex-col justify-center items-center rounded-xl">
                        <img src="/CarRental/images/seller.png" alt="" class="rounded-full w-30 bg-white">
                        <h2 class="text-2xl font-semibold">Jane Smith</h2>
                        <p class="text-neutral-400 py-3">Head of Operations</p>
                    </article>

                    <article class="w-65 bg-neutral-800 p-10 flex flex-col justify-center items-center rounded-xl">
                        <img src="/CarRental/images/seller.png" alt="" class="rounded-full w-30 bg-white">
                        <h2 class="text-2xl font-semibold">Alex Chen</h2>
                        <p class="text-neutral-400 py-3">Chief Experience Officer</p>
                    </article>
                </main>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="footer max-w-full min-h-80 bg-teal-900 flex flex-col justify-center items-center text-white">
            <div class="text flex justify-center items-center flex-col">
                <h1 class="text-2xl font-bold">Ready to Experience the LuxRide Difference?</h1>
                <button class="bg-teal-600 text-black p-2 rounded-xl px-10 my-5">
                    <a href="#">Book Your Ride Today</a>
                </button>
            </div>
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
