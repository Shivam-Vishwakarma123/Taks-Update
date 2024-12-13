<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{

    public function main()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();

        return view('users/index', $data);
    }

    public function create($id = null)
    {
        $user = null;

        if ($id != null) {
            $model = new UserModel();
            $user = $model->find($id);

            if (!$user) {
                return redirect()->to('/users')->with('error', 'User not found.');
            }
        }

        // Pass user data to the view to pre-fill the form
        return view('users/create', ['user' => $user]);
    }

    public function store($id = null)
    {
        $model = new UserModel();

        // Validate the input data
        if (!$this->validate($model->validationRules)) {
            // If validation fails, return the form with errors
            return view('users/create', [
                'validation' => $this->validator,
                'user' => null
            ]);
        }

        // Find the input data.
        $userData = [
            'username'    => $this->request->getPost('username'),
            'email'       => $this->request->getPost('email'),
            'password'    => $this->request->getPost('password'),
            'status'      => $this->request->getPost('status'),
        ];

        if ($id == null) {
            // Use the Model's validate() method to check validation rules
            if ($model->save($userData)) {
                return redirect()->to('/users')->with('message', 'User created successfully!');
            } else {
                // If validation fails, return to the form with error messages
                return redirect()->back()->withInput()->with('errors', $model->errors());
            }
        } else {
            // Check if the user exists
            $user = $model->find($id);
            if (!$user) {
                return redirect()->to('/users')->with('error', 'User not found.');
            }

            // Update the user in the database
            $model->update($id, $userData);

            // Redirect back to the user list with a success message
            return redirect()->to('/users')->with('message', 'User updated successfully!');
        }
    }


    public function delete($id)
    {
        $model = new UserModel();

        // Check if the user exists
        $user = $model->find($id);
        if (!$user) {
            // User not found, redirect with an error message
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        // Delete the user from the database
        $model->delete($id);

        // Redirect back to the user list with a success message
        return redirect()->to('/users')->with('message', 'User deleted successfully!');
    }


    public function status($id)
    {
        $model = new UserModel();

        // Check if the user exists
        $user = $model->find($id);
        if (!$user) {
            // User not found, redirect with an error message
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        // Toggle the user's status
        $newStatus = ($user['status'] == 1) ? 0 : 1; // Assuming 1 = active, 0 = inactive

        // Update the user's status in the database
        $model->update($id, ['status' => $newStatus]);

        // Determine the message type and content based on the new status
        if ($newStatus == 1) {
            // Activated
            $statusMessage = $user["username"] . ' is activated now!';
            $messageType = 'message';  // For success message
        } else {
            // Deactivated
            $statusMessage = $user["username"] . ' is deactivated now!';
            $messageType = 'error';  // For error message
        }

        // Redirect back to the user list with the appropriate message
        return redirect()->to('/users')->with($messageType, $statusMessage);
    }
}
