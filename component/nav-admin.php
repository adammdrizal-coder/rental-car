<?php $current_page = basename($_SERVER['PHP_SELF']) ?>
<header class="bg-black text-neutral-200 p-3 pt-6 text-md">
        <nav>
            <div class="navbar flex justify-around">

                <span class="cursor-pointer"><img src="/CarRental/images/logo.png" alt="" width="130"></span>

                <ul class="lg:flex space-x-10 hidden">
                    <li><a href="/CarRental/admin-module/admin.php" class="<?php echo($current_page == 'admin.php') ? 'text-teal-300' : 'text-neutral-300 text-neutral-100';?>">Home</a></li>
                    <li><a href="/CarRental/admin-module/car-package.php" class="<?php echo($current_page == 'car-package.php') ? 'text-teal-300' : 'text-neutral-300 text-neutral-100';?>">Cars Packages</a></li>
                    <li><a href="/CarRental/admin-module/rental-package.php" class="<?php echo($current_page == 'rental-package.php') ? 'text-teal-300' : 'text-neutral-300 text-neutral-100';?>">Rental Packages</a></li>
                </ul>

                <span>
                    
                    <button class="p-1 px-3 rounded-md bg-neutral-900"><a href="#"><i class="fa fa-user mr-2" aria-hidden="true"></i>Admin</a></button>
                    <button class="border p-1 px-5 rounded-md bg-teal-300 text-black font-semibold"><a href="/CarRental/"><i class="fa fa-sign-out mr-2" aria-hidden="true"></i>Quit</a></button>
                 
                </span>

            </div>
        </nav>
</header>