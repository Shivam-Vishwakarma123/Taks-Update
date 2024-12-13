<?php

namespace App\Commands;

use DateTime;
use PHPMailer\PHPMailer\Exception;

// Include the database and email configuration
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/email_config.php';

// Fetch the database connection
$conn = require __DIR__ . '/config.php';

// Get the due date (tomorrow)
$tomorrowDate = (new DateTime())->modify('+1 day')->format('Y-m-d');

// Fetch tasks due tomorrow
$query = "SELECT * FROM tasks WHERE status != 'completed' AND due_date = '{$tomorrowDate}'";
$result = $conn->query($query);

// Check for query errors
if (!$result) {
    echo "Error executing query: " . $conn->error . "\n";
    exit;
}

// Process tasks
while ($task = $result->fetch_assoc()) {
    $userId = $task['user_id'];
    $userResult = $conn->query("SELECT * FROM users WHERE id = '{$userId}'");

    // Skip if user query fails or no user is found
    if (!$userResult || !$user = $userResult->fetch_assoc()) {
        continue;
    }

    $username = $user['username'];
    $userEmail = $user['email'];

    // Prepare email content
    $subject = 'Urgent: Task Notification - Due Tomorrow: ' . $task['title'];
    $message = "Hello {$username},\n\nThis is a reminder that your task \"{$task['title']}\" is due tomorrow, {$task['due_date']}.\n\n";
    $message .= "Task Description: {$task['description']}\n\nPlease make sure to complete it before the due date.\n\nBest Regards, Nirvaat Internet Private Limited";

    // Send email using PHPMailer
    $sender = 'shivam.v@nirvaat.com';
    $mail = getMailer();
    try {
        $mail->setFrom('shivam.v@nirvaat.com', 'Nirvaat Internet Private Limited');
        $mail->addAddress($userEmail);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            // Prepare the SQL query with proper inline variable interpolation
            $sql = "INSERT INTO email_notifications 
                        (task_id, sender, recipient, subject, body, task_name, due_date, status) 
                        VALUES ('{$task['id']}', 'shivam.v@nirvaat.com', '$userEmail', '$subject', '$message', '{$task['title']}', '{$task['due_date']}', '{$task['status']}')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                echo "Email notification inserted successfully.\n";
            } else {
                echo "Error: " . $sql . "\n" . $conn->error;
            }
        } else {
            echo "Failed to send notification to: {$userEmail}\n";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}\n";
    }
}

// Close the database connection
$conn->close();
