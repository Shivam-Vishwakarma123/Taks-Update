<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>

<div class="wrapper">
    <div class="title">
        User Register Form
    </div>
    <form action="/register" method="post">
        <div class="field">
            <input type="text" id="username" name="username" required>
            <label>User Name</label>
        </div>
        <div class="field">
            <input type="email" id="email" name="email" required>
            <label>Email Address</label>
        </div>
        <div class="field">
            <input type="password" id="password" name="password" required>
            <label>Password</label>
        </div>
        <div class="field">
            <input type="password" id="cpassword" name="cpassword" required>
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
            Already Register? <a href="/login">User Login</a>
        </div>
        <hr>
        <div>
            <a class="other-field" href="/admin_login">Admin Login</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>