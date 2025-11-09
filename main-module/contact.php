<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php

        require_once '../component/function.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        // Include PHPMailer files
        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';

        $success = $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
                $mail = new PHPMailer(true);
                try {
                    // Gmail SMTP settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'adamrizal.dev@gmail.com';
                    $mail->Password   = 'bzpu xpyt kqju juag';     
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    // Recipients
                    $mail->setFrom($email, $name);
                    $mail->addAddress('adamrizal.dev@gmail.com', 'CarRental Admin');

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = "Contact Form: " . htmlspecialchars($subject);
                    $mail->Body    = "
                        <h3>New Contact Message</h3>
                        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                        <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
                    ";

                    $mail->send();
                    $success = "Your message has been sent successfully!";
                } catch (Exception $e) {
                    $error = "Failed to send message. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $error = "Please fill out all fields.";
            }
        }
    

    ?>

    <title>Contact</title>
</head>
<body>
    
    <div class="container max-w-full min-h-screen bg-black text-white">
        
        <?php

            require_once '../component/nav.php'

        ?>

            <div class="items-container flex justify-around items-center max-w-full min-h-150">
                <div class="items-left w-1/2 flex flex-col justify-center items-center ml-30">

                    <h1 class="text-4xl font-bold w-120">Get in Touch With Us</h1>
                    <p class="w-120 py-5">We'd love to hear from you! Whether you have a question about our services, need support, or just want to provide feedback, our team is ready to assist you. Reach out through the form or direct contact methods below.</p>

                </div>

                <div class="items-right w-1/2 flex items-center justify-center mr-30">

                    <img src="/CarRental/images/contact.png" alt="" class="w-100 rounded-xl">

                </div>
            </div>

            </div>

            <div class="form-contact max-w-full min-h-screen bg-black text-white flex flex-col justify-center">
                <main class="grid grid-cols-2 grid-rows-3">
                    <article class="bg-neutral-800 w-180 p-10 rounded-xl flex flex-col justify-center row-span-3 mx-30">
                        <h1 class="text-3xl font-bold py-1">Send Us a Message</h1>
                        <p class="pb-5">Fill Out the form below and we will get back to you as soon as possible.</p>

                        <form action="" method="POST" class="pb-3">

                            <label for="Name">Name</label>
                            <br>
                            <input type="text" name="name" placeholder="Your Full Name" class="mt-2 w-full bg-neutral-700 p-2 rounded-xl">

                       

                        <br><br>

                            <label for="Name">Email</label>
                            <br>
                            <input type="text" name="email" placeholder="you@example.com" class="mt-2 w-full bg-neutral-700 p-2 rounded-xl">

                       

                        <br><br>

                            <label for="Name">Subject</label>
                            <br>
                            <input type="text" name="subject" placeholder="Topic of your inquiry" class="mt-2 w-full bg-neutral-700 p-2 rounded-xl">

                      

                        <br><br>

                            <label for="Name">Message</label>
                            <br>
                            <textarea name="message"  cols="30" rows="5" placeholder="Type your message here..." class="mt-2 w-full bg-neutral-700 p-2 rounded-xl"></textarea>

                        

                        <br>
                        <button type="submit" class="bg-teal-300 p-2 rounded-xl w-full text-black font-semibold hover:bg-teal-400 transition">Submit</button>
                        </form>

                        <?php if ($success): ?>
                            <p class="text-green-400 mt-3"><?php echo $success; ?></p>
                        <?php elseif ($error): ?>
                            <p class="text-red-400 mt-3"><?php echo $error; ?></p>
                        <?php endif; ?>

                    </article>
                   
                    <article class="bg-neutral-800 h-40 w-95 p-5 rounded-xl mx-35">
                        <h1 class="text-xl font-semibold">Phone Support</h1>
                        <p class="w-90 py-3">Our Support team is Available during business hours to assist you.</p>

                        <h2 class="text-lg font-semibold">+1 (800) 123-4567</h2>
                    </article>
                    <article class="bg-neutral-800 h-40 w-95 p-5 rounded-xl mx-35">
                        <h1 class="text-xl font-semibold">Email Support</h1>
                        <p class="w-90 py-3">Our Support team is Available during business hours to assist you.</p>

                        <h2 class="text-lg font-semibold">+1 (800) 123-4567</h2>
                    </article>
                    <article class="bg-neutral-800 h-60 w-95 p-5 rounded-xl mx-35">
                        <h1 class="text-xl font-semibold">Office Location</h1>
                        <p class="w-90 py-3">Visit our main office during business hours for in-person assistance.</p>

                        <h2 class="text-lg font-semibold">123 Global Street, Suite 200, Innovation City, GX 98765</h2>
                    </article>
                </main>
            </div>

</body>
</html>