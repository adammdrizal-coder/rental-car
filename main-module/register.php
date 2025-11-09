<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>login</title>
</head>
<body>


    <div class="container bg-black">

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

    <div class="parent max-w-full min-h-screen flex flex-col justify-center items-center text-white">

    

        <div class="form w-100 bg-neutral-800 p-5 flex flex-col items-center rounded-xl">
        <h1 class="text-4xl font-bold mb-20">Signup</h1>
        <form action="register-auth.php" class="flex flex-col items-center" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="" class="p-1 bg-neutral-700 my-3 rounded-lg w-60" required>

            <label for="emel">Email Address</label>
            <input type="email" name="email" id="" class="p-1 bg-neutral-700 my-3 rounded-lg w-60" required>

            <label for="phoneNumber">Phone Number</label>
            <input type="text" name="phone_number" id="" class="p-1 bg-neutral-700 my-3 rounded-lg w-60" required>

            <label for="pass">Password</label>
            <input type="password" name="pass" id="" class="p-1 bg-neutral-700 my-3 rounded-lg w-60">

            <label for="pass">Confirm Password</label>
            <input type="password" name="confirm_pass" id="" class="p-1 bg-neutral-700 my-3 rounded-lg w-60">

        <button class="w-60 border-1 border-teal-300 hover:bg-teal-300 hover:text-black py-2 rounded-xl my-5" name="register">Sign Up</button>
        
        </form>

        <p class="text-neutral-200 mt-3 mb-2">Already have an account?</p>
        <a href="/CarRental/main-module/login.php" class="text-teal-300 mb-3">Login</a>
        </div>
    </div>
</div>
</body>
</html>