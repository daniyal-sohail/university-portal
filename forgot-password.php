<?php
require_once __DIR__ . '/includes/bootstrap.php';
guest_only();

$error = ''; $sent = false; $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (!csrf_ok()) $error = 'Session expired. Please try again.';
    elseif ($email === '') $error = 'Email is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Enter a valid email address.';
    else {
        // Same response whether or not the account exists (prevents account enumeration).
        // Real mail sending needs an SMTP server; out of scope for this assignment.
        $sent = true;
    }
}
auth_start('Forgot Password');
?>
    <h1 class="text-center mb-2">Forgot Password</h1>
    <p class="small text-secondary text-center mb-4">Enter your email to receive password reset instructions.</p>
    <form id="authForm" method="post" novalidate class="d-grid gap-3">
        <?= csrf_field() ?>
        <div>
            <label class="form-label small fw-medium">Email <span class="text-danger">*</span></label>
            <input name="email" type="email" class="form-control<?= $error ? ' is-invalid' : '' ?>" placeholder="info@gmail.com" value="<?= e($email) ?>">
            <div class="invalid-feedback"><?= e($error) ?></div>
        </div>
        <button class="btn btn-theme py-2">Reset Password</button>
    </form>
    <?php if ($sent): ?><p class="text-center small mt-3" style="color:var(--teal-600)">If this email is registered, a password reset link has been sent.</p><?php endif; ?>
    <p class="small text-secondary text-center mt-4">Remembered your password? <a href="<?= url('signin.php') ?>" class="link-teal">Sign In</a></p>
<?php auth_end();
