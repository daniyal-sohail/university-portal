<?php
require_once __DIR__ . '/includes/bootstrap.php';
$user = require_role('student');

$slug = $_GET['id'] ?? '';
// Only the logged-in student's own enrollment can be viewed
$c = q('SELECT c.*, e.id AS enr_id FROM enrollments e JOIN courses c ON c.id = e.course_id
        WHERE e.user_id = ? AND c.slug = ? ORDER BY e.id DESC LIMIT 1', [$user['id'], $slug])->fetch();
$asm = $c ? q('SELECT * FROM assessments WHERE enrollment_id = ? ORDER BY id', [$c['enr_id']])->fetchAll() : [];

page_start('Course Progress', 'courses', $user);
?>
<a href="<?= url('courses.php') ?>" class="text-decoration-none text-secondary d-inline-flex align-items-center gap-2 mb-3"><i class="bi bi-arrow-left"></i> Back to Courses</a>
<?php if (!$c): ?>
    <div class="text-center py-5"><h2 class="fw-bold">Course Not Found</h2><p class="text-secondary">The requested course could not be found.</p><a href="<?= url('courses.php') ?>" class="btn btn-theme">Back to Courses</a></div>
<?php else:
    $o = array_sum(array_column($asm, 'obtained')); $t = array_sum(array_column($asm, 'total'));
    $p = $t ? $o / $t * 100 : 0; $g = pct_grade($p); $n = fn($x) => rtrim(rtrim(number_format($x, 2), '0'), '.'); ?>
<div class="box p-4 mb-3"><div class="row g-4 align-items-center">
    <div class="col-lg-6"><h1 class="h3 fw-bold mb-2"><?= e($c['title']) ?></h1><div class="fs-5 text-secondary mb-3"><?= e($c['code']) ?></div>
        <div class="d-flex gap-4 small text-secondary"><span><i class="bi bi-person me-2"></i><?= e($c['instructor']) ?></span><span><i class="bi bi-credit-card me-2"></i><?= number_format($c['credits'], 1) ?> Credits</span></div></div>
    <div class="col-lg-6"><div class="row g-3">
        <div class="col-4"><div class="tile"><small>Total Score</small><b class="fs-4"><?= $n($o) ?>/<?= $n($t) ?></b></div></div>
        <div class="col-4"><div class="tile"><small>Percentage</small><b class="fs-4" style="color:var(--teal-600)"><?= number_format($p, 2) ?>%</b></div></div>
        <div class="col-4"><div class="tile"><small>Grade</small><span class="pill pill-<?= $g[1] ?> fs-4 fw-bold rounded-3"><?= $g[0] ?></span></div></div>
    </div></div>
</div></div>
<div class="box overflow-hidden"><div class="table-responsive">
<table class="table tbl mb-0">
    <thead class="thead-teal"><tr><th>Assessment Type</th><th class="text-center">Obtained Marks</th><th class="text-center">Total Marks</th><th class="text-center">Percentage</th></tr></thead>
    <tbody>
    <?php foreach ($asm as $a): $x = $a['obtained'] / $a['total'] * 100; ?>
        <tr><td class="fw-medium"><?= e($a['type']) ?></td><td class="text-center fw-semibold" style="color:var(--teal-600)"><?= $n($a['obtained']) ?></td><td class="text-center text-secondary"><?= $n($a['total']) ?></td><td class="text-center fw-medium <?= $x >= 50 ? 'text-success' : 'text-danger' ?>"><?= number_format($x, 1) ?>%</td></tr>
    <?php endforeach; ?>
    <?php if (!$asm): ?><tr><td colspan="4" class="text-center text-secondary py-4">No marks uploaded yet.</td></tr><?php endif; ?>
    </tbody>
    <tfoot class="table-light fw-bold"><tr><td>Total</td><td class="text-center" style="color:var(--teal-600)"><?= $n($o) ?></td><td class="text-center"><?= $n($t) ?></td><td class="text-center" style="color:var(--teal-600)"><?= number_format($p, 2) ?>%</td></tr></tfoot>
</table></div></div>
<?php endif; page_end();
