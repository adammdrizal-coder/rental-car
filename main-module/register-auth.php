<?php
require('../component/config.php');

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone_number']);
    $pass = trim($_POST['pass']);
    $confirm_pass = trim($_POST['confirm_pass']);

    // Validate empty fields
    if (empty($name) || empty($email) || empty($phone) || empty($pass) || empty($confirm_pass)) {
        $error = "All fields are required!";
    } elseif ($pass !== $confirm_pass) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $error = "Email is already registered!";
        } else {
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO user (name, email, pass, phone_number, user_type)
                                   VALUES (:name, :email, :pass, :phone_number, :user_type)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'pass' => password_hash($pass, PASSWORD_DEFAULT),
                'phone_number' => $phone,
                'user_type' => 'user'
            ]);

            // Redirect after successful registration

            echo "<script>alert('Successfully Registered!'); window.location.href='login.php?registered=1';</script>";
            exit;
        }
    }
}
?>
