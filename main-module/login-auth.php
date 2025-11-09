<?php
require('../component/config.php');
session_start();

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    if (empty($email) || empty($pass)) {
        $error = "All fields are required!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $password_correct = false;

            // Check password hash
            if (password_verify($pass, $user['pass'])) {
                $password_correct = true;
            } 
            // Check plaintext (user lama)
            elseif ($pass === $user['pass']) {
                $password_correct = true;

                // Auto-update ke hash baru
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE user SET pass = :pass WHERE email = :email");
                $update->execute(['pass' => $newHash, 'email' => $email]);
            }

            if ($password_correct) {

                // Check kalau suspended
                if (isset($user['status']) && $user['status'] === 'suspended') {
                    $error = "Your account has been suspended. Please contact the admin for help.";
                } else {
                    // Simpan session
                    $_SESSION['user'] = $user['name'];
                    $_SESSION['user_type'] = $user['user_type'];

                    // Kalau ada redirect parameter
                    if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
                        header("Location: " . $_GET['redirect']);
                        exit;
                    }

                    // Redirect ikut user_type
                    if ($user['user_type'] === 'admin') {
                        header("Location: /CarRental/");
                        exit;
                    } elseif ($user['user_type'] === 'user') {
                        header("Location: /CarRental/main-module/user_dashboard.php");
                        exit;
                    } else {
                        $error = "User type not recognized!";
                    }
                }

            } else {
                $error = "Invalid email or password!";
            }

        } else {
            $error = "Invalid email or password!";
        }
    }

    // Kalau ada error, simpan error dalam session dan redirect balik ke login
    if (isset($error)) {
        $_SESSION['error'] = $error;
        header("Location: login.php");
        exit;
    }
}
?>
