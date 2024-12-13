<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>

<div class="wrapper">
    <div class="title">
        Admin Register Form
    </div>
    <form action="/admin_register" method="post">
        <div class="field">
            <input type="text" id="name" name="name" class="form-control" required>
            <label>User Name</label>
        </div>
        <div class="field">
            <input type="email" id="email" name="email" class="form-control" required required>
            <label>Email Address</label>
        </div>
        <div class="field">
            <input type="password" id="password" name="password" class="form-control" required>
            <label>Password</label>
        </div>
        <div class="field">
            <input type="password" id="cpassword" name="cpassword" class="form-control" required>
            <label>Confirm Password</label>
        </div>
        <div class="content">
            <div class="pass-link">
                <a href="#">Forgot password?</a>
            </div>
        </div>
        <div class="field">
            <input type="submit" value="Register">
        </div>
        <div class="signup-link">
            Already Register? <a href="/admin_login">Admin Login</a>
        </div>
        <hr>
        <div>
            <a class="other-field" href="/login">User Login</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>