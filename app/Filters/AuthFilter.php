<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    // Runs before the controller is executed
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the user is logged in by checking session data
        if (!session()->get('user_id')) {
            return redirect()->to('/login')->with('error', 'You are not logged in');
        }
        
    }

    // Runs after the controller has been executed
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request is executed
    }
}