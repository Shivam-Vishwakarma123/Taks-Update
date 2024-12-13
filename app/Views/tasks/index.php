<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Task List</h1>

<a href="/tasks/create" class="btn btn-primary mb-3">Create New Task</a>

<div class="row">
  <?php foreach ($tasks as $task): ?>
    <?php
    // Assign priority class based on task priority
    $priorityClass = '';

    switch (strtolower($task['priority'])) {
      case 'low':
        $priorityClass = 'priority-low';
        break;
      case 'medium':
        $priorityClass = 'priority-medium';
        break;
      case 'high':
        $priorityClass = 'priority-high text-white';
        break;
      default:
        $priorityClass = 'priority-default';
        break;
    }
    ?>

    <div class="col-md-4 mb-3">
      <div class="card <?= $priorityClass ?> border-0">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title d-inline"><?= esc($task['title']) ?></h5>
            <!-- Checkbox to mark as completed -->
            <form action="/tasks/update_status/<?= $task['id'] ?>" method="post" class="d-inline">
              <input type="hidden" name="status" value="<?= $task['status'] === 'completed' ? 'pending' : 'completed' ?>">
              <input
                type="checkbox"
                name="completed"
                class="form-check-input"
                id="completedCheckbox"
                <?= $task['status'] === 'completed' ? 'checked' : '' ?>
                onchange="this.form.submit()">
              <label class="form-check-label" for="completedCheckbox">
                <?= $task['status'] === 'completed' ? 'Completed' : 'Mark as Completed' ?>
              </label>
            </form>
          </div>
          <hr>
          <p class="card-text"><?= esc($task['description']) ?></p>
          <p class="card-text"><strong>Priority:</strong> <?= esc($task['priority']) ?></p>
          <p class="card-text">
            <strong>Status:</strong>
            <button class="btn btn-sm <?= $task['status'] === 'completed' ? 'btn-success' : ($task['status'] === 'pending' ? 'btn-info' : 'btn-secondary') ?>">
              <?= esc($task['status']) ?>
            </button>
          </p>
          <a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="/tasks/delete/<?= $task['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?= $this->endSection() ?>