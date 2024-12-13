<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table      = 'tasks';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id', 'title', 'description', 'status', 'priority', 'due_date'];

    // Set the validation rules
    protected $validationRules = [
        'title'       => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty',
        'status'      => 'required|in_list[pending,completed]',
    ];

    // Set the error messages
    protected $validationMessages = [
        'title' => [
            'required' => 'The title field is required.',
            'min_length' => 'The title must be at least 3 characters long.',
            'max_length' => 'The title cannot be longer than 255 characters.',
        ],
        'status' => [
            'required' => 'The status field is required.',
            'in_list'  => 'The status must be either "pending" or "completed".',
        ],
    ];

    // Enable timestamps for created_at and updated_at fields
    protected $useTimestamps = true;
}
