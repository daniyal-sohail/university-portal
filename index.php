<?php
require_once __DIR__ . '/includes/bootstrap.php';
$u = current_user();
redirect($u ? ($u['role'] === 'admin' ? 'admin.php' : 'dashboard.php') : 'signin.php');
