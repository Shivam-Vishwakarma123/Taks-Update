<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h1 class="mb-4"><?= $task ? 'Update' : 'Create New'; ?> Task</h1>

<form action="<?= $task ? '/tasks/update/' . $task['id'] : '/tasks/store'; ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= old('title', $task ? $task['title'] : '') ?>">
        <!-- Show validation error for title -->
        <?php if (isset($validation) && $validation->getError('title')): ?>
            <div class="text-danger"><?= $validation->getError('title') ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description"><?= old('description', $task ? $task['description'] : '') ?></textarea>
        <!-- Show validation error for description -->
        <?php if (isset($validation) && $validation->getError('description')): ?>
            <div class="text-danger"><?= $validation->getError('description') ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status">
            <option value="pending" <?= old('status', $task ? $task['status'] : '') == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="completed" <?= old('status', $task ? $task['status'] : '') == 'completed' ? 'selected' : '' ?>>Completed</option>
        </select>
        <!-- Show validation error for status -->
        <?php if (isset($validation) && $validation->getError('status')): ?>
            <div class="text-danger"><?= $validation->getError('status') ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="priority" class="form-label">Priority</label>
        <select class="form-select" name="priority" id="priority" required>
            <option value="low" <?= old('priority', $task ? $task['priority'] : '') == 'low' ? 'selected' : '' ?>>Low</option>
            <option value="medium" <?= old('priority', $task ? $task['priority'] : '') == 'medium' ? 'selected' : '' ?>>Medium</option>
            <option value="high" <?= old('priority', $task ? $task['priority'] : '') == 'high' ? 'selected' : '' ?>>High</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input class="form-control" type="date" name="due_date" id="due_date" value="<?= old('due_date', $task ? $task['due_date'] : '') ?>" required />
    </div>

    <button type="submit" class="btn btn-primary"><?= $task ? 'Update' : 'Create' ?> Task</button>
</form>

<?= $this->endSection() ?>