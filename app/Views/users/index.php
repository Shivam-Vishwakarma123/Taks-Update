<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">User List</h1>

<a href="/users/create" class="btn btn-primary mb-3">Create New User</a>

<!-- Users Table -->
<table class="table table-striped" id="usersTable">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= esc($user['username']) ?></td>
        <td><?= esc($user['email']) ?></td>
        <td id="status-<?= $user['id']; ?>">
          <a href="/users/status/<?= $user['id'] ?>" class="btn btn-sm <?= $user['status'] == 1 ? 'btn-success' : 'btn-danger'; ?>"
            onclick="toggleStatus(<?= $user['id']; ?>)">
            <?= $user['status'] == 1 ? 'Active' : 'Inactive'; ?>
          </a>
        </td>
        <td>
          <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?= $this->endSection() ?>