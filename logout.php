<?php
require_once __DIR__ . '/includes/bootstrap.php';
logout_user();
session_start();               // fresh session just to carry the flash message
flash('success', 'You have been logged out.');
redirect('signin.php');
