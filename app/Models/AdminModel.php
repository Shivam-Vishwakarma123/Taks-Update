<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'email', 'password_hash'];

    // Set the validation rules
    protected $validationRules = [
        'name'       => 'required|min_length[3]|max_length[255]',
        'password_hash' => 'required|min_length[3]',
    ];

    // Set the error messages
    protected $validationMessages = [
        'name' => [
            'required' => 'The name field is required.',
            'min_length' => 'The name must be at least 3 characters long.',
            'max_length' => 'The name cannot be longer than 255 characters.',
        ],
        'password_hash' => [
            'required' => 'The password field is required.',
            'min_length' => 'The password must be at least 3 characters long.',
        ],
    ];

    // Enable timestamps for created_at and updated_at fields
    protected $useTimestamps = true;

    // Check credentials
    // public function validateCredentials($email, $password)
    // {
    //     $user = $this->where('email', $email)->first();
    //     if ($user && ($password == $user['password_hash'])) {
    //         return $user;
    //     }
    //     return false;
    // }

    public function validateAdminCredentials($email, $password)
    {
        $admin = $this->where('email', $email)->first();

        if(!is_array($admin)){
            return "Email is not correct";
        }

        if ((count($admin) > 0) && (password_verify($password, $admin['password_hash']))) {
            return $admin;
        }else{
            return "Password is not correct";
        }
        
    }
}