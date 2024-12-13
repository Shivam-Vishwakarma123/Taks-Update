<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailNotificationModel extends Model
{
    // Define the table name
    protected $table = 'email_notifications';

    // Define the primary key
    protected $primaryKey = 'id';

    // Specify the allowed fields for insertion/updating
    protected $allowedFields = ['sender', 'recipient', 'subject', 'body', 'task_name', 'due_date', 'status'];

    // Define the timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // You can set validation rules here, for example:
    protected $validationRules = [
        'sender'    => 'required|valid_email',
        'recipient' => 'required|valid_email',
        'subject'   => 'permit_empty|max_length[255]',
        'body'      => 'permit_empty',
        'task_name' => 'permit_empty|max_length[255]',
        'due_date'  => 'required|valid_date[Y-m-d]',
        'status'    => 'in_list[pending,in_progress,completed]',
    ];

    // Optionally, set validation messages
    protected $validationMessages = [
        'sender'    => ['required' => 'Sender email is required.', 'valid_email' => 'Sender must be a valid email address.'],
        'recipient' => ['required' => 'Recipient email is required.', 'valid_email' => 'Recipient must be a valid email address.'],
        'status'    => ['in_list' => 'Status must be either pending or completed.'],
    ];

    // You can also set custom callbacks for before insert, update, etc.
    // Example: Protect sensitive data or format values before saving.


    public function getNotification()
    {

        // Fetch notifications based on status
        $notifications = $this->findAll();

        if ($notifications) {
            // If data is found, pass the notifications to the view
            return count($notifications);
        } else {
            // If no notifications are found, pass a message
            return 'No notifications found for this status.';
        }
    }
}
