<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminAuthController extends BaseController
{

    public function login()
    {
        $title = "Admin Login";
        return view('auth/admin_login', ['title' => $title]);
    }

    public function loginAdmin()
    {

        // Validate the input
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ])) {
            return redirect()->to('/admin_login')->withInput();
        }
    
        // Get data from the form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('remember-me');
        
        $adminModel = new AdminModel();
        
        // Check if user credentials are valid
        $admin = $adminModel->validateAdminCredentials($email, $password);

        if (!is_array($admin)) {
            return redirect()->to('/admin_login')->with('error', $admin);
        }
    
        // Set user session
        session()->set('admin_id', $admin['id']);
        session()->set('admin_name', $admin['name']);

        if ($rememberMe) {
            // Set cookies for "Remember Me" functionality (email and password)
            setcookie('admin_email', $email, time() + (86400 * 30), '/', '', false, true);
            setcookie('admin_password', $password, time() + (86400 * 30), '/', '', false, true); 
        } 
    
        return redirect()->to('/users');
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin_login');
    }

    public function register()
    {
        $title = "Admin Register";
        return view('auth/admin_register', ['title' => $title]);
    }

    public function registerAdmin()
    {
        $model = new AdminModel();

        // Validate the input
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ])) {
            return redirect()->to('/admin_register')->withInput();
        }

        // Find the input data.
        $userData = [
            'name'    => $this->request->getPost('name'),
            'email'       => $this->request->getPost('email'),
            'password_hash'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Save the user in the database
        $model->save($userData);

        // Redirect back to the user list with a success message
        return redirect()->to('/admin_login')->with('message', 'Registration successfully!');
    }
}