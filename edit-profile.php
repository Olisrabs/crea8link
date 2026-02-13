<?php
include "session_check.php";
include('db_conn.php');

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

// Fallbacks
$userName = $user['fullname'] ?? 'User';
$bio = $user['bio'] ?? '';

// Default profile image
$defaultImage = "assets/images/default-avatar.png";

// If profile image exists and is not empty
if (!empty($user['profile_photo'])) {
    $profileImage = "uploads/profile_photos/" . $user['profile_photo'];
} else {
    $profileImage = $defaultImage;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#2196f3">
	<meta name="author" content="DexignZone" /> 
    <meta name="keywords" content="" /> 
    <meta name="robots" content="" /> 
	<meta name="description" content="Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )"/>
	<meta property="og:title" content="Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )" />
	<meta property="og:description" content="Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )" />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
	
	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    
    <!-- Title -->
	<title>Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )</title>
	
    <!-- Stylesheets -->
	<!-- Stylesheets -->
    <link href="assets/vendor/lightgallery/dist/css/lightgallery.css" rel="stylesheet">
    <link href="assets/vendor/lightgallery/dist/css/lg-thumbnail.css" rel="stylesheet">
    <link href="assets/vendor/lightgallery/dist/css/lg-zoom.css" rel="stylesheet">	
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

</head>    
</head>   
<body>
<div class="page-wraper header-fixed">
    
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader end-->
    
	<form action="" method="post">
        <!-- Header -->
        <header class="header bg-white">
            <div class="container">
                <div class="main-bar">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </a>
                        <h4 class="title mb-0">Edit profile</h4>
                    </div>
                    <div class="mid-content">
                    </div>
                    <div class="right-content">
                        <button type="submit" style="border: none; background: transparent" name="submit" class="text-dark font-20">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->
        
        <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="edit-profile">
                    <div class="profile-image">
                        <div class="media media-100 rounded-circle">
                            <img src="<?= htmlspecialchars($profileImage) ?>" alt="/">	
                        </div>
                        <a href="javascript:void(0);">Change profile photo</a>
                    </div>
                    <form>
                        <div class="mb-3 input-group input-mini">
                            <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($userName) ?>">
                        </div>
                        <div class="mb-3 input-group input-mini">
                            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                        </div>
                        <div class="mb-3 input-group input-mini">
                            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
                        </div>
                        <div class="mb-3 input-group input-mini">
                            <input type="text" class="form-control" placeholder="Enter your bio" value="<?= htmlspecialchars($bio) ?>">
                        </div>
                    </form>
                </div>
                <ul class="link-list">
                    <li>
                        <a href="javascript:void(0);">Add Link</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Switch to professional account</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Create avatar</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Personal information settings</a>
                    </li>
                </ul>	
            </div>
        </div>
        <!-- Page Content End-->
    </form>
</div> 
<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/lightgallery/dist/lightgallery.umd.js"></script>
<script src="assets/vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.umd.js"></script>
<script src="assets/vendor/lightgallery/dist/plugins/zoom/lg-zoom.umd.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>

</html>