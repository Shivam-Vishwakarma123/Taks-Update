<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{

    public function main()
    {
        $model = new TaskModel();
        $tasks = $model->where('user_id', session()->get('user_id'))->findAll();

        return view('tasks/index', ['tasks' => $tasks]);
    }

    public function create($id = null)
    {
        $task = null;

        if ($id != null) {
            $model = new TaskModel();
            $task = $model->find($id);

            if (!$task) {
                return redirect()->to('/tasks')->with('error', 'Task not found.');
            }
        }

        // Pass task data to the view to pre-fill the form
        return view('tasks/create', ['task' => $task]);
    }

    public function store($id = null)
    {
        $model = new TaskModel();

        // Validate the input data
        if (!$this->validate($model->validationRules)) {
            // If validation fails, return the form with errors
            return view('tasks/create', [
                'validation' => $this->validator,
                'task' => null
            ]);
        }

        // Find the input data. status	priority	due_date	
        $taskData = [
            'user_id'     => session()->get('user_id'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'priority'    => $this->request->getPost('priority'),
            'due_date'    => $this->request->getPost('due_date'),
        ];

        if ($id == null) {
            // Use the Model's validate() method to check validation rules
            if ($model->save($taskData)) {
                return redirect()->to('/tasks')->with('message', 'Task created successfully!');
            } else {
                // If validation fails, return to the form with error messages
                return redirect()->back()->withInput()->with('errors', $model->errors());
            }
        } else {
            // Check if the task exists
            $task = $model->find($id);
            if (!$task) {
                return redirect()->to('/tasks')->with('error', 'Task not found.');
            }

            // Update the task in the database
            $model->update($id, $taskData);

            // Redirect back to the task list with a success message
            return redirect()->to('/tasks')->with('message', 'Task updated successfully!');
        }
    }


    public function delete($id)
    {
        $model = new TaskModel();

        // Check if the task exists
        $task = $model->find($id);
        if (!$task) {
            // Task not found, redirect with an error message
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        // Delete the task from the database
        $model->delete($id);

        // Redirect back to the task list with a success message
        return redirect()->to('/tasks')->with('message', 'Task deleted successfully!');
    }

    public function update_status($id)
    {
        $model = new TaskModel();

        // Check if the task exists
        $task = $model->find($id);
        if (!$task) {
            // Task not found, redirect with an error message
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        // Get the new status from the form
        $newStatus = $this->request->getPost('status');
        
        // Update the task status in the database
        $model->update($id, ['status' => $newStatus]);

        // Redirect back to the task list with a success message
        return redirect()->to('/tasks')->with('message', 'Task deleted successfully!');
    }
}