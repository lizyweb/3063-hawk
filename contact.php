<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php';

// $mail = new PHPMailer(true);

// try {
//     $name = stripcslashes($_POST['name']);
//     $email = stripcslashes($_POST['email']);
//     $phone = stripcslashes($_POST['phone']);
//     $comment = stripcslashes($_POST['comments']);

//     $subject = 'Hawk Creations Contact Form';

//     $mail->Host = 'mail.lizyweb.com';
//     $mail->Username = 'smt@lizyweb.com';
//     $mail->Password = 'Lizyweb@123';

//     $mail->setFrom('smt@lizyweb.com', $name);
//     $mail->addAddress('info.hawkcreations@gmail.com');
//     $mail->Subject = $subject;

//     $message = "Name: $name<br /><br />";
//     $message .= "Email: $email<br /><br />";
//     $message .= "Phone: $phone<br /><br />";
//     $message .= "Comments: $comment";

//     $mail->MsgHTML($message);

//     if ($mail->Send()) {
//         echo "</fieldset>";
//         echo "<div id='success_page'>";
//         echo "<h1>Your Message Sent Successfully.</h1>";
//         echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us. We will contact you shortly.</p>";
//         echo "</div>";
//         echo "</fieldset>";

//         echo '<a href="index.html">Return to Home</a>';
//     } else {
//         echo "Mailer Error: " . $mail->ErrorInfo;
//     }
// } catch (Exception $e) {
//     echo "Mailer Error: " . $e->getMessage();
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $name = stripcslashes($_POST['name']);
    $email = stripcslashes($_POST['email']);
    $phone = stripcslashes($_POST['phone']);
    $comment = stripcslashes($_POST['comments']);

    $subject = 'Hawk Creations Contact Form'; // Define your email subject

    // SMTP configuration
    $mail->Host = 'mail.lizyweb.com';
    $mail->Username = 'smt@lizyweb.com';
    $mail->Password = 'Lizyweb@123';

    $mail->setFrom('smt@lizyweb.com', $name);
    $mail->addAddress('admin@punchex.in');
    $mail->Subject = $subject;

    // Create the HTML message
    $message = "Name: $name<br /><br />";
    $message .= "Email: $email<br /><br />";
    $message .= "Phone: $phone<br /><br />";
    $message .= "Comments: $comment";

    $mail->MsgHTML($message);

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadFilePath = $_FILES['file']['tmp_name'];
        $uploadFileName = $_FILES['file']['name'];
        
        // Ensure the file path exists and is readable before adding it as an attachment
        if (is_uploaded_file($uploadFilePath)) {
            $mail->addAttachment($uploadFilePath, $uploadFileName);
        } else {
            echo "File upload error. Please try again.";
        }
    }    

    // Send the email
    if ($mail->Send()) {
        echo "<div id='success_page'>";
        echo "<h1>Your Message Sent Successfully.</h1>";
        echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us. We will contact you shortly.</p>";
        echo "</div>";
        echo '<a href="index.html">Return to Home</a>';
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $e->getMessage();
}

?>