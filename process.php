<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "shivamchx16@gmail.com"; // Replace with your email address
    $subject = "New Form Submission";

    // Sanitize and validate form input
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST["number"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
    if (empty($name) || empty($number) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        // Compose the email message
        $messageBody = "Name: $name\n";
        $messageBody .= "Phone Number: $number\n";
        $messageBody .= "Email: $email\n";
        $messageBody .= "Message: $message";
        
        $headers = "From: $email";
        
        if (mail($to, $subject, $messageBody, $headers)) {
            // Redirect to the custom "Thank you" page
            header("Location: thank-you.html"); // Replace with the actual URL of your "Thank you" page
            exit;
        } else {
            echo "Error sending the email. Please try again later.";
        }
    }
}
?>
