<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{

    public function login()
    {
        $title = "User Login";
        return view('auth/login', ['title' => $title]);
    }

    public function loginUser()
    {
        // Validate the input
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ])) {
            return redirect()->to('/login')->withInput();
        }

        // Get data from the form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('remember-me');

        $userModel = new UserModel();

        // Check if user credentials are valid
        $user = $userModel->validateCredentials($email, $password);

        if (!is_array($user)) {
            return redirect()->to('/login')->with('error', $user);
        }

        // Set user session
        session()->set('user_id', $user['id']);
        session()->set('username', $user['username']);
        session()->set('user_email', $user['email']);

        if ($rememberMe) {
            // Set cookies for "Remember Me" functionality (email and password)
            setcookie('email', $email, time() + (86400 * 30), '/', '', false, true);
            setcookie('password', $password, time() + (86400 * 30), '/', '', false, true);
        }

        return redirect()->to('/tasks')->with('message', 'Logged In successfully');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        $title = "User Register";
        return view('auth/register', ['title' => $title]);
    }

    public function registerUser()
    {
        $model = new UserModel();

        // Validate the input
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ])) {
            return redirect()->to('/register')->withInput();
        }

        
        // Find the input data.
        $userData = [
            'username'    => $this->request->getPost('username'),
            'email'       => $this->request->getPost('email'),
            'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status'      => '1',
        ];

        // Save the user to the database
        if ($model->save($userData)) {
            // Redirect to login page with success message
            return redirect()->to('/login')->with('message', 'Registration successful! Please log in.');
        } else {
            // Get the last error message
            $errors = $model->errors();

            // If there are errors, grab the first one or display a generic message
            $errorMessage = !empty($errors) ? reset($errors) : 'Registration failed, please try again.';

            // Return to the register page with the error message
            return redirect()->to('/register')->with('error', $errorMessage);
        }
    }
}
