<?php
session_start();
require_once('function.php');

$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="bg-black text-neutral-200 p-3 pt-6 text-md">
  <nav>
    <div class="navbar flex justify-around items-center">

      <!-- LOGO -->
      <span class="cursor-pointer">
        <img src="/CarRental/images/logo.png" alt="Logo" width="130">
      </span>

      <!-- NAVIGATION LINKS -->
      <ul class="lg:flex space-x-10 hidden">
        <li>
          <a href="/CarRental"
            class="<?= ($current_page == 'index.php') ? 'text-teal-300' : 'text-neutral-300 hover:text-neutral-100'; ?>">
            Home
          </a>
        </li>
        <li>
          <a href="/CarRental/main-module/cars.php"
            class="<?= ($current_page == 'cars.php') ? 'text-teal-300' : 'text-neutral-300 hover:text-neutral-100'; ?>">
            Cars
          </a>
        </li>
        <li>
          <a href="/CarRental/main-module/rental.php"
            class="<?= ($current_page == 'rental.php') ? 'text-teal-300' : 'text-neutral-300 hover:text-neutral-100'; ?>">
            Rental Packages
          </a>
        </li>
        <li>
          <a href="/CarRental/main-module/about.php"
            class="<?= ($current_page == 'about.php') ? 'text-teal-300' : 'text-neutral-300 hover:text-neutral-100'; ?>">
            About
          </a>
        </li>
        <li>
          <a href="/CarRental/main-module/contact.php"
            class="<?= ($current_page == 'contact.php') ? 'text-teal-300' : 'text-neutral-300 hover:text-neutral-100'; ?>">
            Contact
          </a>
        </li>

        <!-- ADMIN / USER DASHBOARD LINK -->
        <?php if (isset($_SESSION['user_type'])): ?>
          <?php if ($_SESSION['user_type'] === 'admin'): ?>
            <li>
              <a href="/CarRental/admin-module/admin.php"
                class="<?= ($current_page == 'admin.php') ? 'text-teal-300 font-semibold' : 'text-red-400 hover:text-red-300 font-semibold'; ?>">
                Admin Panel
              </a>
            </li>
          <?php elseif ($_SESSION['user_type'] === 'user'): ?>
            <li>
              <a href="/CarRental/main-module/user_dashboard.php"
                class="<?= ($current_page == 'user_dashboard.php') ? 'text-teal-300 font-semibold' : 'text-neutral-300 hover:text-neutral-100'; ?>">
                My Dashboard
              </a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>

      <!-- RIGHT SIDE: LOGIN / LOGOUT -->
      <span>
        <?php if (isset($_SESSION['user'])): ?>
          <span class="mr-4 text-teal-300 font-semibold">
            👋 Hi, <?= htmlspecialchars($_SESSION['user']); ?>
          </span>
          <button class="p-1 px-3 rounded-md bg-teal-300 text-black font-semibold">
            <a href="/CarRental/main-module/logout.php">
              <i class="fa fa-sign-out mr-2" aria-hidden="true"></i>Sign out
            </a>
          </button>
        <?php else: ?>
          <button class="p-1 px-3 rounded-md bg-neutral-900 hover:bg-neutral-800">
            <a href="/CarRental/main-module/login.php">
              <i class="fa fa-user-plus mr-2"></i>Login
            </a>
          </button>
          <button class="border p-1 px-5 rounded-md bg-teal-300 text-black font-semibold ml-2 hover:bg-teal-400">
            <a href="/CarRental/main-module/register.php">Register</a>
          </button>
        <?php endif; ?>
      </span>

    </div>
  </nav>
</header>
