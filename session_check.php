<?php
session_start();
require_once 'db_conn.php';

// 🔐 Session timeout (60 minutes)
$timeout = 3600;

// Capture current page URL
$current_url = $_SERVER['REQUEST_URI'];

// ⏰ Logout if inactive
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {
    session_unset();
    session_destroy();
    header("Location: index.php?expired=1");
    exit();
}

// Refresh activity time
$_SESSION['LAST_ACTIVITY'] = time();

// 🚫 Must be logged in
if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['email']) ||
    !isset($_SESSION['logged_in'])
) {
    $_SESSION['redirect_after_login'] = $current_url;
    header("Location: index.php");
    exit();
}

// ✅ Validate session against DB
$query = "SELECT *
          FROM users
          WHERE email = ? AND status = 'Active'
          LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    session_unset();
    session_destroy();
    header("Location: index.php?unauthorized=1");
    exit();
}

// ✅ User verified
$user = $result->fetch_assoc();

// Optional globals for page use
$session_user_id  = $user['id'];
$session_fullname = $user['fullname'];
$session_email    = $user['email'];
$session_username = $user['username'];
$session_phone    = $user['phone'];
$session_status   = $user['status'];
$session_photo    = $user['profile_photo'];

?>
