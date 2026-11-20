<?php
require_once __DIR__ . '/includes/bootstrap.php';
guest_only();

$errors = []; $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if (!csrf_ok()) $errors['form'] = 'Session expired. Please try again.';
    if ($email === '') $errors['email'] = 'Email is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Enter a valid email address.';
    if ($pass === '') $errors['password'] = 'Password is required.';

    if (!$errors) {
        $user = q('SELECT * FROM users WHERE email = ?', [$email])->fetch();
        if ($user && password_verify($pass, $user['password_hash'])) {
            if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
                q('UPDATE users SET password_hash = ? WHERE id = ?', [password_hash($pass, PASSWORD_DEFAULT), $user['id']]);
            }
            login_user($user);
            redirect($user['role'] === 'admin' ? 'admin.php' : 'dashboard.php');
        }
        $errors['form'] = 'Invalid email or password.';
    }
}

auth_start('Sign In');
?>
    <h1 class="text-center mb-2">Login to DevXcript Portal</h1>
    <p class="small text-secondary text-center mb-4">Sign in with your student account to access the dashboard</p>
    <?= flash_html() ?>
    <?php if (!empty($errors['form'])): ?><div class="alert alert-danger py-2 small"><?= e($errors['form']) ?></div><?php endif; ?>
    <form id="authForm" method="post" novalidate class="d-grid gap-3">
        <?= csrf_field() ?>
        <div>
            <label class="form-label small fw-medium">Email <span class="text-danger">*</span></label>
            <input name="email" type="email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" placeholder="info@gmail.com" value="<?= e($email) ?>">
            <div class="invalid-feedback"><?= e($errors['email'] ?? '') ?></div>
        </div>
        <div>
            <label class="form-label small fw-medium">Password <span class="text-danger">*</span></label>
            <div class="position-relative">
                <input id="password" name="password" type="password" class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>" placeholder="Enter your password">
                <button type="button" data-eye="#password" class="btn position-absolute top-0 end-0 text-secondary"><i class="bi bi-eye"></i></button>
            </div>
            <div class="text-danger small mt-1"><?= e($errors['password'] ?? '') ?></div>
        </div>
        <div class="d-flex justify-content-end small"><a href="<?= url('forgot-password.php') ?>" class="link-teal">Forgot password?</a></div>
        <button class="btn btn-theme py-2">Sign in</button>
    </form>
    <p class="small text-secondary text-center mt-4">New student? <a href="<?= url('register.php') ?>" class="link-teal">Create an account</a></p>
<?php auth_end();
