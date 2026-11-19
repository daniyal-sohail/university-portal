<?php
require_once __DIR__ . '/includes/bootstrap.php';
guest_only();

$errors = []; $old = ['name' => '', 'email' => '', 'roll_no' => ''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['name']    = trim($_POST['name'] ?? '');
    $old['email']   = trim($_POST['email'] ?? '');
    $old['roll_no'] = strtoupper(trim($_POST['roll_no'] ?? ''));
    $pass = $_POST['password'] ?? '';
    $conf = $_POST['confirm'] ?? '';

    if (!csrf_ok()) $errors['form'] = 'Session expired. Please try again.';

    if ($old['name'] === '') $errors['name'] = 'Full name is required.';
    elseif (strlen($old['name']) < 3 || strlen($old['name']) > 100) $errors['name'] = 'Name must be 3-100 characters.';
    elseif (!preg_match("/^[\p{L} .'-]+$/u", $old['name'])) $errors['name'] = 'Name contains invalid characters.';

    if ($old['email'] === '') $errors['email'] = 'Email is required.';
    elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || strlen($old['email']) > 150) $errors['email'] = 'Enter a valid email address.';
    elseif (q('SELECT 1 FROM users WHERE email = ?', [$old['email']])->fetch()) $errors['email'] = 'This email is already registered.';

    if ($old['roll_no'] === '') $errors['roll_no'] = 'Roll number is required.';
    elseif (!preg_match('/^[A-Z0-9-]{4,30}$/', $old['roll_no'])) $errors['roll_no'] = 'Roll number: 4-30 letters/digits.';
    elseif (q('SELECT 1 FROM students WHERE roll_no = ?', [$old['roll_no']])->fetch()) $errors['roll_no'] = 'This roll number is already registered.';

    if (strlen($pass) < 8) $errors['password'] = 'Password must be at least 8 characters.';
    elseif (!preg_match('/[A-Za-z]/', $pass) || !preg_match('/\d/', $pass)) $errors['password'] = 'Password needs letters and numbers.';
    if ($conf !== $pass) $errors['confirm'] = 'Passwords do not match.';

    if (!$errors) {
        $pdo = db();
        try {
            $pdo->beginTransaction();
            q('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, "student")',
              [$old['name'], $old['email'], password_hash($pass, PASSWORD_DEFAULT)]);
            q('INSERT INTO students (user_id, roll_no) VALUES (?, ?)', [$pdo->lastInsertId(), $old['roll_no']]);
            $pdo->commit();
            flash('success', 'Account created. You can sign in now.');
            redirect('signin.php');
        } catch (PDOException $ex) {
            $pdo->rollBack();
            $errors['form'] = 'Could not create account. Email or roll number may already exist.';
        }
    }
}

function field(string $key, string $label, string $type, array $errors, array $old, string $ph = ''): void { ?>
    <div>
        <label class="form-label small fw-medium"><?= e($label) ?> <span class="text-danger">*</span></label>
        <input name="<?= e($key) ?>" type="<?= e($type) ?>" class="form-control<?= isset($errors[$key]) ? ' is-invalid' : '' ?>" placeholder="<?= e($ph) ?>" value="<?= $type === 'password' ? '' : e($old[$key] ?? '') ?>">
        <div class="invalid-feedback"><?= e($errors[$key] ?? '') ?></div>
    </div>
<?php }

auth_start('Register');
?>
    <h1 class="text-center mb-2">Create Student Account</h1>
    <p class="small text-secondary text-center mb-4">Register to access the DevXcript portal</p>
    <?php if (!empty($errors['form'])): ?><div class="alert alert-danger py-2 small"><?= e($errors['form']) ?></div><?php endif; ?>
    <form id="authForm" method="post" novalidate class="d-grid gap-3">
        <?= csrf_field() ?>
        <?php field('name', 'Full Name', 'text', $errors, $old, 'Babar Azam');
              field('email', 'Email', 'email', $errors, $old, 'info@gmail.com');
              field('roll_no', 'Roll Number', 'text', $errors, $old, 'L1PCBCS56');
              field('password', 'Password', 'password', $errors, $old, 'Min 8 chars, letters + numbers');
              field('confirm', 'Confirm Password', 'password', $errors, $old, 'Repeat password'); ?>
        <button class="btn btn-theme py-2">Create account</button>
    </form>
    <p class="small text-secondary text-center mt-4">Already registered? <a href="<?= url('signin.php') ?>" class="link-teal">Sign In</a></p>
<?php auth_end();
