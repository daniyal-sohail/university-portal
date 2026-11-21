<?php
require_once __DIR__ . '/includes/bootstrap.php';
$user = require_role('student');
$rows = q('SELECT * FROM invoices WHERE user_id = ? ORDER BY id', [$user['id']])->fetchAll();
page_start('Invoices', 'invoices', $user);
?>
<h1 class="h3 fw-bold mb-3">Your Invoices</h1>
<div class="box p-3 mb-3"><div class="row g-3">
    <div class="col-md"><div class="position-relative"><i class="bi bi-search position-absolute text-secondary" style="left:12px;top:10px"></i><input id="q" class="form-control ps-5" placeholder="Search by term, semester, or challan ID..."></div></div>
    <div class="col-md-auto"><select id="sel" class="form-select"><option value="all">All Status</option><option value="paid">Paid</option><option value="unpaid">Unpaid</option></select></div>
</div></div>
<div class="box overflow-hidden">
    <div class="table-responsive"><table class="table tbl table-hover mb-0">
        <thead class="thead-teal"><tr><th>Term</th><th class="text-center">Semester</th><th class="text-center">Challan ID</th><th class="text-center">Scholarship</th><th class="text-center">Fee</th><th class="text-center">Fine</th><th class="text-center">Status</th></tr></thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr data-s="<?= e(strtolower($r['term'] . ' ' . $r['semester'] . ' ' . $r['challan_id'])) ?>" data-c="<?= e($r['status']) ?>">
                <td class="fw-medium"><?= e($r['term']) ?></td>
                <td class="text-center fw-semibold" style="color:var(--teal-600)"><?= e($r['semester']) ?></td>
                <td class="text-center text-secondary"><?= e($r['challan_id']) ?></td>
                <td class="text-center fw-medium text-success"><?= (int) $r['scholarship'] ?>%</td>
                <td class="text-center fw-medium"><?= number_format($r['fee']) ?> PKR</td>
                <td class="text-center fw-medium text-danger"><?= number_format($r['fine']) ?> PKR</td>
                <td class="text-center"><span class="badge rounded-2 fs-6 fw-medium bg-<?= $r['status'] === 'paid' ? 'success' : 'danger' ?>"><?= ucfirst($r['status']) ?></span></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
    <div id="empty" class="<?= $rows ? 'd-none ' : '' ?>text-center py-5"><div class="text-secondary">No invoices found</div><div class="small-x">Try adjusting your search or filter criteria</div></div>
</div>
<?php page_end();
