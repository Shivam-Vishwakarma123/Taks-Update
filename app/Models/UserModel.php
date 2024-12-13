<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'email', 'password', 'status'];

    // Set the validation rules
    protected $validationRules = [
        'username'       => 'required|min_length[3]|max_length[255]',
        'password' => 'required|min_length[3]',
    ];

    // Set the error messages
    protected $validationMessages = [
        'username' => [
            'required' => 'The username field is required.',
            'min_length' => 'The username must be at least 3 characters long.',
            'max_length' => 'The username cannot be longer than 255 characters.',
        ],
        'password' => [
            'required' => 'The password field is required.',
            'min_length' => 'The password must be at least 3 characters long.',
        ],
    ];

    // Enable timestamps for created_at and updated_at fields
    protected $useTimestamps = true;

    // Check credentials
    public function validateCredentials($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if(!is_array($user)){
            return "Email is not correct";
        }

        if ((count($user) > 0) && password_verify($password, $user['password'])) {
            if ($user && ($user['status'] == 1)) {
                return $user;
            }else{
                return "Status is inactive, Please connect to admin";
            }
        }else{
            return "Password is not correct";
        }
        
    }
}