<?php
require_once __DIR__ . '/includes/bootstrap.php';
$user = require_role('student');
$uid = $user['id'];

$st = q('SELECT * FROM students WHERE user_id = ?', [$uid])->fetch();
$last = q('SELECT cgpa, total_cr FROM results WHERE user_id = ? ORDER BY term_no DESC LIMIT 1', [$uid])->fetch();
$cgpa   = $last ? (float) $last['cgpa'] : 0.0;
$earned = $last ? (int) $last['total_cr'] : 0;
$total  = (int) ($st['total_credits'] ?? 133);
$courses = q('SELECT c.*, e.status, a.total_classes, a.present
              FROM enrollments e JOIN courses c ON c.id = e.course_id
              LEFT JOIN attendance a ON a.enrollment_id = e.id
              WHERE e.user_id = ? AND e.term = ? ORDER BY c.id', [$uid, CURRENT_TERM])->fetchAll();
$inProgress = array_sum(array_map(fn($c) => $c['status'] === 'active' ? $c['credits'] : 0, $courses));
$creditPct = $total ? round($earned / $total * 100) : 0;
$gpaPct    = round($cgpa / 4 * 100);
$circ = 471.2;

$today = q('SELECT t.*, c.title, c.code, c.instructor
            FROM timetable t JOIN courses c ON c.id = t.course_id
            JOIN enrollments e ON e.course_id = c.id AND e.user_id = ? AND e.term = ? AND e.status = "active"
            WHERE t.day_of_week = ? ORDER BY t.start_time', [$uid, CURRENT_TERM, (int) date('N')])->fetchAll();

page_start('Dashboard', 'dashboard', $user);
?>
<div class="box p-4 mb-3"><div class="row g-4 align-items-center">
    <div class="col-lg-6 d-flex gap-3">
        <div class="grad-sq"><i class="bi bi-person"></i></div>
        <div>
            <h1 class="h4 fw-bold mb-1"><?= e(strtoupper($user['name'])) ?></h1>
            <div class="small text-secondary mb-2"><?= e($st['roll_no'] ?? '-') ?></div>
            <div class="small mb-3"><?= e($st['faculty'] ?? '') ?></div>
            <span class="pill pill-teal"><i class="bi bi-mortarboard"></i> <?= e($st['program'] ?? '') ?></span>
        </div>
    </div>
    <div class="col-lg-6"><div class="row g-3">
        <div class="col-6 col-md-3"><div class="tile"><small>CGPA</small><b><?= number_format($cgpa, 2) ?></b></div></div>
        <div class="col-6 col-md-3"><div class="tile"><small>Earned Credits</small><b style="color:var(--teal-600)"><?= $earned ?></b></div></div>
        <div class="col-6 col-md-3"><div class="tile"><small>Total Credits</small><b><?= $total ?></b></div></div>
        <div class="col-6 col-md-3"><div class="tile"><small>In Progress</small><b style="color:#ea580c"><?= rtrim(rtrim(number_format($inProgress, 1), '0'), '.') ?></b></div></div>
    </div></div>
</div></div>

<div class="row g-3 mb-3">
    <div class="col-lg-6"><div class="box p-4 h-100">
        <div class="d-flex align-items-center gap-3 mb-3"><div class="icon-sq"><i class="bi bi-book"></i></div>
            <div><h3 class="fs-5 fw-semibold mb-0">Credit Hours</h3><div class="small-x">Academic Progress</div></div></div>
        <div class="text-center my-3"><svg width="200" height="200" viewBox="0 0 200 200">
            <circle cx="100" cy="100" r="75" fill="none" stroke="#f3f4f6" stroke-width="20"/>
            <circle cx="100" cy="100" r="75" fill="none" stroke="#14b8a6" stroke-width="20" stroke-dasharray="<?= round($creditPct / 100 * $circ, 1) ?> <?= $circ ?>" transform="rotate(-90 100 100)"/>
            <text x="100" y="92" text-anchor="middle" font-size="32" font-weight="700" fill="#1f2937"><?= $creditPct ?>%</text>
            <text x="100" y="112" text-anchor="middle" font-size="14" font-weight="500" fill="#4b5563"><?= $earned ?> | <?= $total ?></text>
            <text x="100" y="130" text-anchor="middle" font-size="12" fill="#6b7280">Credits</text></svg></div>
        <div class="d-flex justify-content-between mb-2"><span class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s" style="background:var(--teal)"></i>Completed</span><b class="small"><?= $earned ?> hrs</b></div>
        <div class="d-flex justify-content-between"><span class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s" style="background:#d1d5db"></i>Remaining</span><b class="small"><?= max(0, $total - $earned) ?> hrs</b></div>
    </div></div>
    <div class="col-lg-6"><div class="box p-4 h-100">
        <div class="d-flex align-items-center gap-3 mb-3"><div class="icon-sq"><i class="bi bi-graph-up-arrow"></i></div>
            <div><h3 class="fs-5 fw-semibold mb-0">GPA</h3><div class="small-x">Academic Performance</div></div></div>
        <div class="text-center my-3"><svg width="200" height="200" viewBox="0 0 200 200">
            <circle cx="100" cy="100" r="75" fill="none" stroke="#f3f4f6" stroke-width="20"/>
            <circle cx="100" cy="100" r="75" fill="none" stroke="#14b8a6" stroke-width="20" stroke-dasharray="<?= round($gpaPct / 100 * $circ, 1) ?> <?= $circ ?>" transform="rotate(-90 100 100)"/>
            <text x="100" y="92" text-anchor="middle" font-size="32" font-weight="700" fill="#1f2937"><?= $gpaPct ?>%</text>
            <text x="100" y="112" text-anchor="middle" font-size="14" font-weight="500" fill="#4b5563"><?= number_format($cgpa, 2) ?> | 4</text>
            <text x="100" y="130" text-anchor="middle" font-size="12" fill="#6b7280">GPA</text></svg></div>
        <div class="d-flex justify-content-between mb-2"><span class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s" style="background:var(--teal)"></i>Current GPA</span><b class="small"><?= number_format($cgpa, 2) ?></b></div>
        <div class="d-flex justify-content-between"><span class="d-flex align-items-center gap-2 small text-secondary"><i class="dot-s" style="background:#d1d5db"></i>Letter Grade</span><span class="pill pill-blue rounded-2"><?= $last ? cgpa_letter($cgpa) : '-' ?></span></div>
    </div></div>
</div>

<div class="box p-4 mb-3">
    <div class="d-flex align-items-center gap-3 mb-3"><div class="icon-sq"><i class="bi bi-calendar-event"></i></div>
        <div><h3 class="fs-5 fw-semibold mb-0">Today's Classes</h3><div class="small-x"><span id="today"><?= date('l, F j, Y') ?></span></div></div></div>
    <?php if (!$today): ?><div class="text-center text-secondary py-4">No classes scheduled today.</div><?php endif; ?>
    <?php foreach ($today as $t): ?>
    <div class="cls mb-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex gap-3"><div class="icon-sq" style="background:var(--teal-50)"><i class="bi <?= $t['class_type'] === 'Lab' ? 'bi-book' : 'bi-people' ?>"></i></div>
                <div><div class="small fw-semibold"><?= e($t['title']) ?></div><div class="small-x"><?= e($t['code']) ?></div></div></div>
            <span class="pill pill-blue h-100"><?= e($t['class_type']) ?></span>
        </div>
        <div class="d-grid gap-2 small-x" style="color:#4b5563">
            <div><i class="bi bi-people me-2"></i><?= e($t['instructor']) ?></div>
            <div><i class="bi bi-clock me-2"></i><?= date('h:i A', strtotime($t['start_time'])) ?> - <?= date('h:i A', strtotime($t['end_time'])) ?></div>
            <div><i class="bi bi-geo-alt me-2"></i><?= e($t['room']) ?></div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="d-flex justify-content-between border-top pt-3 small-x"><span><?= count($today) ?> classes scheduled</span><a href="<?= url('courses.php') ?>" class="link-teal">View Full Schedule</a></div>
</div>

<div class="box p-4">
    <div class="d-flex align-items-center gap-3 mb-3"><div class="icon-sq"><i class="bi bi-book"></i></div>
        <div><h3 class="fs-5 fw-semibold mb-0">Current Courses</h3><div class="small-x"><?= e(CURRENT_TERM) ?> &bull; <?= count($courses) ?> Enrolled Courses</div></div></div>
    <div class="row g-3">
        <?php foreach ($courses as $c): $p = $c['total_classes'] ? $c['present'] / $c['total_classes'] * 100 : null; ?>
        <div class="col-md-6 col-lg-4"><div class="c-card">
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
</div>
<?php page_end();
