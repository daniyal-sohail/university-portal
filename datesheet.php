<?php
require_once __DIR__ . '/includes/bootstrap.php';
$user = require_role('student');
$rows = q('SELECT * FROM datesheet WHERE term = ? ORDER BY exam_date, start_time', [CURRENT_TERM])->fetchAll();
page_start('Date Sheet', 'datesheet', $user);
?>
<h1 class="h2 fw-bold mb-1">DateSheet</h1>
<p class="text-secondary mb-4">Datesheet for upcoming <?= e(CURRENT_TERM) ?> exams</p>
<?php if (!$rows): ?>
    <div class="text-center text-secondary py-5">
        No exams scheduled yet.
    </div>
<?php endif; ?>
<div class="row g-4">
<?php foreach ($rows as $i => $r): ?>
    <div class="col-md-6 col-lg-4"><div class="ds-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3"><span class="pill pill-teal border-0 fs-6"><?= e($r['subject']) ?></span><span class="fs-2 fw-bold" style="color:#d1d5db">#<?= $i + 1 ?></span></div>
        <div class="d-flex align-items-center mb-3"><i class="bi bi-person fs-5 me-3" style="color:#0d9488"></i><div><div class="small text-secondary">Instructor</div><div class="fw-semibold"><?= e($r['instructor']) ?></div></div></div>
        <div class="d-flex align-items-center mb-3"><i class="bi bi-calendar-event fs-5 me-3" style="color:#2563eb"></i><div><div class="small text-secondary">Date</div><div class="fw-semibold"><?= e($r['exam_date']) ?></div></div></div>
        <div class="d-flex align-items-center mb-3"><i class="bi bi-clock fs-5 me-3" style="color:#9333ea"></i><div><div class="small text-secondary">Time</div><div class="fw-semibold"><?= e(substr($r['start_time'], 0, 5)) ?> - <?= e(substr($r['end_time'], 0, 5)) ?></div></div></div>
        <div class="d-flex align-items-center"><i class="bi bi-geo-alt fs-5 me-3" style="color:#16a34a"></i><div><div class="small text-secondary">Venue</div><div class="fw-semibold"><?= e($r['venue']) ?></div></div></div>
    </div></div>
<?php endforeach; ?>
</div>
<?php page_end();
