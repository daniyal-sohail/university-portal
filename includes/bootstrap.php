<?php
require_once __DIR__ . '/../config/config.php';

// ---------- Session ----------
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

// ---------- Base URL (works in XAMPP sub-folder or php -S) ----------
$__root = str_replace('\\', '/', (string) realpath(__DIR__ . '/..'));
$__doc  = str_replace('\\', '/', (string) realpath($_SERVER['DOCUMENT_ROOT'] ?? ''));
define('BASE_URL', ($__doc !== '' && strpos($__root, $__doc) === 0) ? rtrim(substr($__root, strlen($__doc)), '/') : '');

// ---------- Database (PDO, prepared statements only) ----------
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            exit('Database connection failed. Check config/config.php and import database/schema.sql.');
        }
    }
    return $pdo;
}
function q(string $sql, array $params = []): PDOStatement {
    $st = db()->prepare($sql);
    $st->execute($params);
    return $st;
}

// ---------- Helpers ----------
function e($v): string { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }
function url(string $p = ''): string { return BASE_URL . '/' . ltrim($p, '/'); }
function redirect(string $p): never { header('Location: ' . url($p)); exit; }
function initials(string $name): string {
    $w = preg_split('/\s+/', trim($name));
    return strtoupper(substr($w[0] ?? '', 0, 1) . (count($w) > 1 ? substr(end($w), 0, 1) : ''));
}
function flash(?string $type = null, ?string $msg = null): ?array {
    if ($type !== null) { $_SESSION['flash'] = [$type, $msg]; return null; }
    $f = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $f;
}
function flash_html(): string {
    $f = flash();
    return $f ? '<div class="alert alert-' . e($f[0]) . ' py-2 small">' . e($f[1]) . '</div>' : '';
}
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function csrf_field(): string { return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">'; }
function csrf_ok(): bool { return isset($_POST['csrf']) && hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf']); }

// ---------- Auth ----------
function current_user(): ?array {
    static $u = false;
    if ($u === false) {
        $u = null;
        if (!empty($_SESSION['uid'])) {
            $u = q('SELECT id, name, email, role FROM users WHERE id = ?', [$_SESSION['uid']])->fetch() ?: null;
            if (!$u) { session_unset(); }
        }
    }
    return $u;
}
function require_login(): array {
    $u = current_user();
    if (!$u) { flash('warning', 'Please sign in to continue.'); redirect('signin.php'); }
    return $u;
}
function require_role(string $role): array {
    $u = require_login();
    if ($u['role'] !== $role) {
        // Wrong role -> send to the correct home page
        redirect($u['role'] === 'admin' ? 'admin.php' : 'dashboard.php');
    }
    return $u;
}
function guest_only(): void {
    if ($u = current_user()) redirect($u['role'] === 'admin' ? 'admin.php' : 'dashboard.php');
}
function login_user(array $u): void {
    session_regenerate_id(true);
    $_SESSION['uid'] = (int) $u['id'];
}
function logout_user(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

// ---------- Display helpers ----------
function att_color(float $p): array {   // [pill class, bootstrap color, label]
    if ($p >= 82) return ['green', 'success', '&#10003; Good Standing'];
    if ($p >= 70) return ['yellow', 'warning', '&#9888; Below Average'];
    return ['red', 'danger', '&#10007; Poor Attendance'];
}
function pct_grade(float $p): array {
    return $p >= 90 ? ['A', 'green'] : ($p >= 80 ? ['B', 'blue'] : ($p >= 70 ? ['C', 'yellow'] : ($p >= 60 ? ['D', 'orange'] : ['F', 'red'])));
}
function cgpa_letter(float $g): string {
    foreach ([[3.67, 'A'], [3.33, 'B+'], [3.0, 'B'], [2.67, 'B-'], [2.33, 'C+'], [2.0, 'C']] as [$min, $l]) if ($g >= $min) return $l;
    return 'D';
}

// ---------- Layout ----------
function auth_start(string $title): void { ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($title) ?> | <?= e(APP_NAME) ?></title>
    <link rel="icon" href="<?= url('img/logo.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
<div class="auth"><div class="inner">
    <div class="text-center mb-4"><img src="<?= url('img/logo.png') ?>" alt="logo" height="56"></div>
<?php }
function auth_end(): void { ?>
</div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= url('js/main.js') ?>"></script>
</body>
</html>
<?php }

function page_start(string $title, string $active, array $user): void {
    $nav = [
        ['dashboard', 'Dashboard', 'bi-grid'], ['courses', 'Courses', 'bi-book'],
        ['results', 'Results', 'bi-clipboard-check'], ['datesheet', 'Date Sheet', 'bi-calendar3'],
        ['invoices', 'Invoices', 'bi-file-earmark-text'], ['attendance', 'Attendance', 'bi-check2-square'],
    ];
    if ($user['role'] === 'admin') $nav = [['admin', 'Admin Panel', 'bi-shield-lock']];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($title) ?> | <?= e(APP_NAME) ?></title>
    <link rel="icon" href="<?= url('img/logo.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
<aside class="sidebar" id="sidebar">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="logo-box">DX</div>
            <div><div class="fw-bold fs-5 lh-1">DevXcript</div><small class="text-muted">Student Portal</small></div>
        </div>
        <button class="btn btn-sm d-xl-none" id="closeSide"><i class="bi bi-x-lg"></i></button>
    </div>
    <nav class="p-3 d-grid gap-1">
        <?php foreach ($nav as [$key, $label, $icon]): ?>
            <a href="<?= url($key . '.php') ?>" class="nav-x<?= $active === $key ? ' active' : '' ?>"><i class="bi <?= $icon ?> fs-5"></i><span><?= $label ?></span><i class="dot"></i></a>
        <?php endforeach; ?>
    </nav>
    <div class="side-foot">Developed By DevXcript</div>
</aside>
<div class="overlay" id="overlay"></div>
<div class="main">
    <header class="topbar px-3 px-md-4 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm d-xl-none" id="openSide"><i class="bi bi-list fs-4"></i></button>
            <h2 class="h5 fw-bold mb-0"><?= e($title) ?></h2>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="dropdown">
                <button class="btn position-relative" data-bs-toggle="dropdown"><i class="bi bi-bell"></i><span class="bell-dot"></span></button>
                <div class="dropdown-menu dropdown-menu-end p-3" style="width:260px">
                    <div class="d-flex justify-content-between mb-2"><b class="small">Notifications</b><span class="badge bg-light text-secondary">2</span></div>
                    <div class="p-2 rounded border mb-2" style="background:var(--teal-50);border-color:var(--teal-100)!important"><div class="small">Register for next semester</div><div class="small-x">2 min ago</div></div>
                    <div class="p-2 rounded bg-light"><div class="small">Fee challan available</div><div class="small-x">1 hour ago</div></div>
                </div>
            </div>
            <div class="dropdown">
                <div class="d-flex align-items-center gap-2 px-2 py-1" role="button" data-bs-toggle="dropdown">
                    <div class="avatar"><?= e(initials($user['name'])) ?></div>
                    <div class="d-none d-sm-block lh-sm">
                        <div class="small fw-medium"><?= e($user['name']) ?></div>
                        <div class="small-x text-truncate" style="max-width:120px"><?= e($user['email']) ?></div>
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item text-danger small" href="<?= url('logout.php') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="p-3 p-sm-4 p-lg-4"><div class="page-wrap">
<?php }

function page_end(): void { ?>
    </div></main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= url('js/main.js') ?>"></script>
</body>
</html>
<?php }
