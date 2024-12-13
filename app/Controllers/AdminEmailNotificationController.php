<?php

namespace App\Controllers;

use App\Models\EmailNotificationModel;

class AdminEmailNotificationController extends BaseController
{
    public function totalEmail()
    {
        // Get the model
        $EmailModel = new EmailNotificationModel();

        // Check if user credentials are valid
        $email = $EmailModel->getNotification();
        echo $email;
        die;
    }
}
