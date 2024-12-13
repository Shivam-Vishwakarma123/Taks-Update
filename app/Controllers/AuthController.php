<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    // Display the login form
    public function login()
    {
        return view('auth/login', ['title' => 'User Login']);
    }

    // Handle login logic
    public function loginUser()
    {
        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/login')->withInput()->with('error', 'Invalid input data.');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('remember-me');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Invalid credentials.');
        }

        // Set user session
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'user_email' => $user['email'],
        ]);

        // Handle "Remember Me" functionality
        if ($rememberMe) {
            setcookie('email', $email, time() + (86400 * 30), '/', '', false, true);
            setcookie('password', $password, time() + (86400 * 30), '/', '', false, true);
        }

        return redirect()->to('/tasks')->with('message', 'Logged in successfully.');
    }

    // Handle user logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Logged out successfully.');
    }

    // Display the registration form
    public function register()
    {
        return view('auth/register', ['title' => 'User Register']);
    }

    // Handle user registration
    public function registerUser()
    {
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/register')->withInput()->with('error', 'Invalid input data.');
        }

        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => '1',
        ];

        $userModel = new UserModel();
        if ($userModel->save($userData)) {
            return redirect()->to('/login')->with('message', 'Registration successful! Please log in.');
        } else {
            $errors = $userModel->errors();
            $errorMessage = !empty($errors) ? reset($errors) : 'Registration failed, please try again.';
            return redirect()->to('/register')->with('error', $errorMessage);
        }
    }
}
