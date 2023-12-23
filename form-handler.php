<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $client_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($client_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $email_from = 'noreply123@alglazo.com';

    $email_subject = 'New Form Submission';

    $email_body = "User Name: $name.\n" .
        "User Email: $client_email.\n" .
        "Subject: $subject.\n" .
        "User Message: $message.\n";

    $to = 'sales@alglazo.com';

    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $client_email \r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        header("Location: contact");
        exit;
    } else {
        echo "Error sending email. Please try again later.";
    }
} else {
    echo "Invalid request";
}
?>
