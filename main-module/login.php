<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>login</title>
</head>
<body>

    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "
        <div class='fixed top-5 right-5 bg-red-500 text-white px-5 py-3 rounded-lg shadow-lg animate-bounce'>
            {$_SESSION['error']}
        </div>
        ";
        unset($_SESSION['error']); // clear supaya tak muncul lagi lepas refresh
    }
    ?>

    
    <div class="container max-w-full min-h-screen text-white bg-black">
    
    <header class="bg-black text-neutral-200 p-3 pt-6 text-md">
        <nav>
            <div class="navbar flex justify-around">

                <span class="cursor-pointer"><a href="/CarRental/index.php"><img src="/CarRental/images/logo.png" alt="" width="130"></a></span>
                    
                <span>

                    <button class="p-1 px-3 rounded-md bg-neutral-900"><a href="/CarRental/main-module/login.php"><i class="fa fa-user-plus mr-2" aria-hidden="true"></i>Login</a></button>
                    <button class="border p-1 px-5 rounded-md bg-teal-300 text-black font-semibold"><a href="/CarRental/main-module/register.php">Register</a></button>
                
                </span>

            </div>
        </nav>
        </header>

    <div class="parent flex flex-col justify-center items-center w-full h-screen text-white">
        <div class="form w-100 bg-neutral-800 p-5 flex flex-col items-center rounded-xl">
        <h1 class="text-4xl font-bold mb-20">Login</h1>
        <form action="login-auth.php" class="flex flex-col items-center" method="POST">
            <label for="emel">Email Address</label>
            <input type="email" name="email" id="" class="p-1 bg-neutral-700  rounded-lg w-60 my-2" required>
            <br>
            <label for="pass">Password</label>
            <input type="password" name="pass" id="" class="p-1 bg-neutral-700 rounded-lg w-60 my-2">
        

            <button class="w-60 border-1 border-teal-300 hover:bg-teal-300 hover:text-black py-2 rounded-xl my-10 cursor-pointer" name="login"> Sign In Securely </button>
        </form>
        <p class="text-neutral-200 mt-3 mb-2">Don't have an account?</p>
        <a href="/CarRental/main-module/register.php" class="text-teal-300 mb-3">Create Account</a>
        </div>
    </div>
    </div>
    </div>

</body>
</html>