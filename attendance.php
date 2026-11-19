<?php
require_once __DIR__ . '/includes/bootstrap.php';
$user = require_role('student');
$rows = q('SELECT c.title, a.total_classes, a.present
           FROM attendance a JOIN enrollments e ON e.id = a.enrollment_id JOIN courses c ON c.id = e.course_id
           WHERE e.user_id = ? ORDER BY c.id', [$user['id']])->fetchAll();
page_start('Attendance', 'attendance', $user);
?>
<h1 class="h2 fw-bold mb-1">Attendance Overview</h1>
<p class="text-secondary mb-4">Your attendance record across all courses</p>
<?php if (!$rows): ?><div class="text-center text-secondary py-5">No attendance records yet.</div><?php endif; ?>
<div class="row g-4">
<?php foreach ($rows as $r):
    $p = $r['total_classes'] ? $r['present'] / $r['total_classes'] * 100 : 0; [$pill, $bs, $label] = att_color($p); ?>
    <div class="col-md-6 col-lg-4"><div class="ds-card p-4">
        <div class="d-flex justify-content-between align-items-start gap-2 mb-3"><h3 class="fs-5 fw-bold mb-0"><?= e($r['title']) ?></h3><span class="pill pill-<?= $pill ?> border-0 fw-bold"><?= number_format($p, 1) ?>%</span></div>
        <div class="row text-center mb-3">
            <div class="col"><div class="fs-5 fw-bold"><?= (int) $r['total_classes'] ?></div><div class="small-x">Total</div></div>
            <div class="col"><div class="fs-5 fw-bold text-success"><?= (int) $r['present'] ?></div><div class="small-x">Present</div></div>
            <div class="col"><div class="fs-5 fw-bold text-danger"><?= (int) ($r['total_classes'] - $r['present']) ?></div><div class="small-x">Absent</div></div>
        </div>
        <div class="progress" style="height:8px"><div class="progress-bar bg-<?= $bs ?>" style="width:<?= round($p, 1) ?>%"></div></div>
        <div class="text-center mt-3 small fw-medium text-<?= $bs ?>"><?= $label ?></div>
    </div></div>
<?php endforeach; ?>
</div>
<?php page_end();
