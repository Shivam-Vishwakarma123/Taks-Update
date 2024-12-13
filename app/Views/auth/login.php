<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>

<div class="wrapper">
    <div class="title">
        User Login Form
    </div>
    <form action="/login" method="post">
        <div class="field">
            <input type="email" id="email" name="email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" required>
            <label>Email Address</label>
        </div>
        <div class="field">
            <input type="password" id="password" name="password" value="<?= isset($_COOKIE['password']) ? $_COOKIE['password'] : '' ?>" required>
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
            Not a member? <a href="/register">User Register</a>
        </div>
        <hr>
        <div>
            <a class="other-field" href="/admin_login">Admin Login</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
