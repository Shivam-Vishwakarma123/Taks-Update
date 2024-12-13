<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>
<h1 class="mb-4"><?= $user ? 'Update' : 'Create New'; ?> User</h1>

<form action="<?= $user ? '/users/update/' . $user['id'] : '/users/store'; ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="username" class="form-label">User Name</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= old('username', $user ? $user['username'] : '') ?>">
        <!-- Show validation error for title -->
        <?php if (isset($validation) && $validation->getError('username')): ?>
            <div class="text-danger"><?= $validation->getError('username') ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="text" class="form-control" name="email" id="email" value="<?= old('email', $user ? $user['email'] : '') ?>">
        <!-- Show validation error for title -->
        <?php if (isset($validation) && $validation->getError('email')): ?>
            <div class="text-danger"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" value="<?= old('password', $user ? $user['password'] : '') ?>">
        <!-- Show validation error for title -->
        <?php if (isset($validation) && $validation->getError('password')): ?>
            <div class="text-danger"><?= $validation->getError('password') ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status">
            <option value="1" <?= old('status', $user ? $user['status'] : '') == 1 ? 'selected' : '' ?>>active</option>
            <option value="0" <?= old('status', $user ? $user['status'] : '') == 0 ? 'selected' : '' ?>>Inactive</option>
        </select>
        <!-- Show validation error for status -->
        <?php if (isset($validation) && $validation->getError('status')): ?>
            <div class="text-danger"><?= $validation->getError('status') ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary"><?= $user ? 'Update' : 'Create' ?> User</button>
</form>
<?= $this->endSection() ?>