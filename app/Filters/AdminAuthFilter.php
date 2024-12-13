<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthFilter implements FilterInterface
{
    // Runs before the controller is executed
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the admin is logged in by checking session data
        if (!session()->get('admin_id')) {
            return redirect()->to('/admin_login')->with('error', 'You are not logged in');
        }
    }

    // Runs after the controller has been executed
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request is executed
    }
}