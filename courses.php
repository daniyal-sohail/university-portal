<?php
require_once __DIR__ . '/includes/bootstrap.php';
$user = require_role('student');
$uid = $user['id'];
$st = q('SELECT program FROM students WHERE user_id = ?', [$uid])->fetch();

$rows = q('SELECT c.*, e.status, e.term, a.total_classes, a.present
           FROM enrollments e JOIN courses c ON c.id = e.course_id
           LEFT JOIN attendance a ON a.enrollment_id = e.id
           WHERE e.user_id = ? ORDER BY c.id', [$uid])->fetchAll();
$active   = count(array_filter($rows, fn($r) => $r['status'] === 'active'));
$withdraw = count($rows) - $active;
$credits  = array_sum(array_map(fn($r) => $r['status'] === 'active' ? $r['credits'] : 0, $rows));
$fmt = fn($n) => rtrim(rtrim(number_format($n, 1), '0'), '.');

page_start('Courses', 'courses', $user);
?>
<div class="box p-4 mb-3"><div class="row g-4 align-items-center">
    <div class="col-lg-5 d-flex gap-3"><div class="grad-sq"><i class="bi bi-book"></i></div>
        <div><h1 class="h4 fw-bold mb-2">All Courses</h1>
            <span class="pill pill-teal"><i class="bi bi-mortarboard"></i> <?= e($st['program'] ?? '') ?></span>
            <span class="pill pill-blue"><i class="bi bi-calendar-event"></i> <?= e(CURRENT_TERM) ?></span></div></div>
    <div class="col-lg-7"><div class="row g-3">
        <div class="col-6 col-md"><div class="tile"><small>Total</small><b><?= count($rows) ?></b></div></div>
        <div class="col-6 col-md"><div class="tile"><small>Active</small><b style="color:var(--teal-600)"><?= $active ?></b></div></div>
        <div class="col-6 col-md"><div class="tile"><small>Withdraw</small><b class="text-danger"><?= $withdraw ?></b></div></div>
        <div class="col-6 col-md"><div class="tile"><small>Current Cr.</small><b class="text-primary"><?= $fmt($credits) ?></b></div></div>
        <div class="col-6 col-md"><div class="tile"><small>Total Cr.</small><b style="color:#9333ea"><?= $fmt(array_sum(array_column($rows, 'credits'))) ?></b></div></div>
    </div></div>
</div></div>

<div class="box p-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mb-4">
        <h2 class="fs-5 fw-semibold mb-0">Course List</h2>
        <div class="d-flex gap-2 overflow-auto"><button class="chip-f active" data-f="all">All Courses</button><button class="chip-f" data-f="active">Active Only</button><button class="chip-f" data-f="withdraw">Withdraw</button></div>
    </div>
    <div class="row g-3" id="grid">
        <?php foreach ($rows as $c): $p = $c['total_classes'] ? $c['present'] / $c['total_classes'] * 100 : null; ?>
        <div class="col-md-6 col-lg-4" data-status="<?= e($c['status']) ?>"><div class="c-card">
            <div class="c-head"><h4 class="fs-6 fw-semibold mb-2" style="min-height:2rem"><?= e($c['title']) ?></h4>
                <div class="d-flex justify-content-between align-items-center"><span class="small-x" style="color:inherit"><?= e($c['code']) ?></span><span class="pill pill-<?= $c['status'] === 'active' ? 'green' : 'red' ?>"><?= ucfirst($c['status']) ?></span></div></div>
            <div class="p-3 d-grid gap-3">
                <div class="d-flex gap-2 small"><i class="bi bi-person text-secondary"></i><?= e($c['instructor']) ?></div>
                <div class="d-flex gap-2 small"><i class="bi bi-credit-card text-secondary"></i><span class="text-secondary">Credits:</span><b style="color:var(--teal-600)"><?= number_format($c['credits'], 1) ?></b></div>
                <div class="d-flex gap-2 small"><i class="bi bi-bar-chart text-secondary"></i><span class="text-secondary">Grade:</span><a class="link-teal" href="<?= url('course-detail.php?id=' . urlencode($c['slug'])) ?>">view progress</a></div>
                <div class="d-flex gap-2 small align-items-center"><i class="bi bi-calendar-event text-secondary"></i><span class="text-secondary">Attendance:</span>
                    <?php if ($p === null): ?><span class="text-secondary">N/A</span><?php else: ?><span class="pill pill-<?= att_color($p)[0] ?>"><?= number_format($p, 1) ?>%</span><?php endif; ?></div>
            </div>
        </div></div>
        <?php endforeach; ?>
    </div>
    <div id="empty" class="<?= $rows ? 'd-none ' : '' ?>text-center text-secondary py-5">No courses found</div>
    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 border-top mt-4 pt-4 small text-secondary">
        <div class="d-flex gap-4"><span><i class="dot-s me-2" style="background:var(--teal)"></i>Active Classes (<?= $active ?>)</span><span><i class="dot-s me-2" style="background:#ef4444"></i>Withdraw (<?= $withdraw ?>)</span></div>
        <div>Showing <span id="shown"><?= count($rows) ?></span> of <?= count($rows) ?> courses</div>
    </div>
</div>
<?php page_end();
