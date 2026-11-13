<?php
require_once __DIR__ . '/includes/bootstrap.php';
$admin = require_role('admin');   // students are redirected away

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_ok()) { flash('danger', 'Session expired. Please try again.'); redirect('admin.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'delete_user') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id === (int) $admin['id']) flash('danger', 'You cannot delete your own account.');
        else {
            $n = q('DELETE FROM users WHERE id = ? AND role = "student"', [$id])->rowCount();
            flash($n ? 'success' : 'danger', $n ? 'Student deleted.' : 'Student not found.');
        }
    } elseif ($action === 'toggle_invoice') {
        $id = (int) ($_POST['id'] ?? 0);
        $n = q('UPDATE invoices SET status = IF(status = "paid", "unpaid", "paid") WHERE id = ?', [$id])->rowCount();
        flash($n ? 'success' : 'danger', $n ? 'Invoice status updated.' : 'Invoice not found.');
    } elseif ($action === 'add_exam') {
        $subject = trim($_POST['subject'] ?? ''); $inst = trim($_POST['instructor'] ?? '');
        $date = $_POST['exam_date'] ?? ''; $s = $_POST['start_time'] ?? ''; $en = $_POST['end_time'] ?? ''; $venue = trim($_POST['venue'] ?? '');
        $d = DateTime::createFromFormat('Y-m-d', $date);
        $err = '';
        if ($subject === '' || strlen($subject) > 100 || $inst === '' || strlen($inst) > 100 || $venue === '' || strlen($venue) > 30) $err = 'Subject, instructor and venue are required (check lengths).';
        elseif (!$d || $d->format('Y-m-d') !== $date) $err = 'Enter a valid exam date.';
        elseif (!preg_match('/^\d{2}:\d{2}$/', $s) || !preg_match('/^\d{2}:\d{2}$/', $en) || $en <= $s) $err = 'End time must be after start time.';
        if ($err) flash('danger', $err);
        else {
            q('INSERT INTO datesheet (term, subject, instructor, exam_date, start_time, end_time, venue) VALUES (?,?,?,?,?,?,?)',
              [CURRENT_TERM, $subject, $inst, $date, $s, $en, $venue]);
            flash('success', 'Exam added to date sheet.');
        }
    }
    redirect('admin.php');
}

$stats = [
    'Students' => q('SELECT COUNT(*) FROM users WHERE role = "student"')->fetchColumn(),
    'Courses'  => q('SELECT COUNT(*) FROM courses')->fetchColumn(),
    'Unpaid invoices' => q('SELECT COUNT(*) FROM invoices WHERE status = "unpaid"')->fetchColumn(),
    'Exams' => q('SELECT COUNT(*) FROM datesheet')->fetchColumn(),
];
$students = q('SELECT u.id, u.name, u.email, u.created_at, s.roll_no FROM users u LEFT JOIN students s ON s.user_id = u.id WHERE u.role = "student" ORDER BY u.id')->fetchAll();
$invoices = q('SELECT i.*, u.name FROM invoices i JOIN users u ON u.id = i.user_id ORDER BY i.id DESC LIMIT 20')->fetchAll();

page_start('Admin Panel', 'admin', $admin);
?>
<h1 class="h3 fw-bold mb-3">Admin Panel</h1>
<?= flash_html() ?>
<div class="row g-3 mb-3">
<?php foreach ($stats as $label => $v): ?>
    <div class="col-6 col-md-3"><div class="tile"><small><?= e($label) ?></small><b><?= (int) $v ?></b></div></div>
<?php endforeach; ?>
</div>

<div class="box p-4 mb-3">
    <h2 class="fs-5 fw-semibold mb-3">Registered Students</h2>
    <div class="table-responsive"><table class="table tbl mb-0">
        <thead class="thead-teal"><tr><th>Name</th><th>Roll No</th><th>Email</th><th>Joined</th><th class="text-center">Action</th></tr></thead>
        <tbody>
        <?php foreach ($students as $s): ?>
            <tr><td class="fw-medium"><?= e($s['name']) ?></td><td><?= e($s['roll_no'] ?? '-') ?></td><td><?= e($s['email']) ?></td><td><?= e(substr($s['created_at'], 0, 10)) ?></td>
                <td class="text-center"><form method="post" onsubmit="return confirm('Delete this student and all their records?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete_user"><input type="hidden" name="id" value="<?= (int) $s['id'] ?>"><button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
</div>

<div class="box p-4 mb-3">
    <h2 class="fs-5 fw-semibold mb-3">Invoices</h2>
    <div class="table-responsive"><table class="table tbl mb-0">
        <thead class="thead-teal"><tr><th>Student</th><th>Challan</th><th>Term</th><th class="text-center">Fee</th><th class="text-center">Status</th><th class="text-center">Action</th></tr></thead>
        <tbody>
        <?php foreach ($invoices as $i): ?>
            <tr><td class="fw-medium"><?= e($i['name']) ?></td><td><?= e($i['challan_id']) ?></td><td><?= e($i['term']) ?></td><td class="text-center"><?= number_format($i['fee']) ?> PKR</td>
                <td class="text-center"><span class="badge bg-<?= $i['status'] === 'paid' ? 'success' : 'danger' ?>"><?= ucfirst($i['status']) ?></span></td>
                <td class="text-center"><form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="toggle_invoice"><input type="hidden" name="id" value="<?= (int) $i['id'] ?>"><button class="btn btn-sm btn-outline-secondary">Mark <?= $i['status'] === 'paid' ? 'unpaid' : 'paid' ?></button></form></td></tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
</div>

<div class="box p-4">
    <h2 class="fs-5 fw-semibold mb-3">Add Exam to Date Sheet (<?= e(CURRENT_TERM) ?>)</h2>
    <form method="post" class="row g-3"><?= csrf_field() ?><input type="hidden" name="action" value="add_exam">
        <div class="col-md-4"><input name="subject" class="form-control" placeholder="Subject" required maxlength="100"></div>
        <div class="col-md-4"><input name="instructor" class="form-control" placeholder="Instructor" required maxlength="100"></div>
        <div class="col-md-4"><input name="venue" class="form-control" placeholder="Venue" required maxlength="30"></div>
        <div class="col-md-4"><input name="exam_date" type="date" class="form-control" required></div>
        <div class="col-md-4"><input name="start_time" type="time" class="form-control" required></div>
        <div class="col-md-4"><input name="end_time" type="time" class="form-control" required></div>
        <div class="col-12"><button class="btn btn-theme">Add Exam</button></div>
    </form>
</div>
<?php page_end();
