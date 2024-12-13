<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>

<div class="wrapper">
    <div class="title">
        Admin Login Form
    </div>
    <form action="/admin_login" method="post">
        <div class="field">
            <input type="email" id="email" name="email" value="<?= isset($_COOKIE['admin_email']) ? $_COOKIE['admin_email'] : '' ?>" required>
            <label>Email Address</label>
        </div>
        <div class="field">
            <input type="password" id="password" name="password" value="<?= isset($_COOKIE['admin_password']) ? $_COOKIE['admin_password'] : '' ?>" required>
            <label>Password</label>
        </div>
        <div class="content">
            <div class="checkbox">
                <input type="checkbox" id="remember-me" name="remember-me" <?= isset($_COOKIE['email']) ? 'checked' : '' ?>>
                <label for="remember-me">Remember me</label>
            </div>
            <div class="pass-link">
                <a href="#">Forgot password?</a>
            </div>
        </div>
        <div class="field">
            <input type="submit" value="Login">
        </div>
        <div class="signup-link">
            Not a member? <a href="/admin_register">Admin Register</a>
        </div>
        <hr>
        <div>
            <a class="other-field" href="/login">User Login</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>