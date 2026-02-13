<?php
include "session_check.php";
include('db_conn.php');

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT fullname, profile_photo FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

// Fallbacks
$userName = $user['fullname'] ?? 'User';

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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

</head>   
<body class="bg-white">
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
							<i class="fa-solid fa-arrow-left"></i>
						</a>
						<h4 class="title mb-0">Create Post</h4>
					</div>
					<div class="mid-content">
					</div>
					<div class="right-content">
						<button type="submit" name="submit" form="postForm" class="post-btn">POST</button>
					</div>
				</div>
			</div>
		</header>
		<!-- Header End -->
		<div class="page-content">
			<div class="container">
				<div class="post-profile">
					<div class="left-content">
						<div class="media media-50 rounded-circle">
							<img src="<?= htmlspecialchars($profileImage) ?>" alt="Profile Picture" onerror="this.src='assets/images/default-avatar.png';">
						</div>
						<div class="ms-3">
							<h6><?= htmlspecialchars($userName) ?></h6>
							<ul class="meta-list">
								<li class="me-2">
									<a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd1" aria-controls="offcanvasEnd1">
										<svg class="me-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M14.2124 7.76241C14.2124 10.4062 12.0489 12.5248 9.34933 12.5248C6.6507 12.5248 4.48631 10.4062 4.48631 7.76241C4.48631 5.11865 6.6507 3 9.34933 3C12.0489 3 14.2124 5.11865 14.2124 7.76241ZM2 17.9174C2 15.47 5.38553 14.8577 9.34933 14.8577C13.3347 14.8577 16.6987 15.4911 16.6987 17.9404C16.6987 20.3877 13.3131 21 9.34933 21C5.364 21 2 20.3666 2 17.9174ZM16.1734 7.84875C16.1734 9.19506 15.7605 10.4513 15.0364 11.4948C14.9611 11.6021 15.0276 11.7468 15.1587 11.7698C15.3407 11.7995 15.5276 11.8177 15.7184 11.8216C17.6167 11.8704 19.3202 10.6736 19.7908 8.87118C20.4885 6.19676 18.4415 3.79543 15.8339 3.79543C15.5511 3.79543 15.2801 3.82418 15.0159 3.87688C14.9797 3.88454 14.9405 3.90179 14.921 3.93246C14.8955 3.97174 14.9141 4.02253 14.9396 4.05607C15.7233 5.13216 16.1734 6.44206 16.1734 7.84875ZM19.3173 13.7023C20.5932 13.9466 21.4317 14.444 21.7791 15.1694C22.0736 15.7635 22.0736 16.4534 21.7791 17.0475C21.2478 18.1705 19.5335 18.5318 18.8672 18.6247C18.7292 18.6439 18.6186 18.5289 18.6333 18.3928C18.9738 15.2805 16.2664 13.8048 15.5658 13.4656C15.5364 13.4493 15.5296 13.4263 15.5325 13.411C15.5345 13.4014 15.5472 13.3861 15.5697 13.3832C17.0854 13.3545 18.7155 13.5586 19.3173 13.7023Z" fill="#130F26"/>
										</svg>
										Friends
										<i class="fa-solid fa-angle-down ms-2"></i>
									</a>
								</li>
								<!-- <li class="me-2">
									<a href="javascript:void(0);">
										<i class="fa-solid fa-plus me-1"></i>
										Album
										<i class="fa-solid fa-angle-down ms-2"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0);">
										<i class="fa-brands fa-instagram me-1"></i>
										Off
										<i class="fa-solid fa-angle-down ms-2"></i>
									</a>
								</li> -->
							</ul>
						</div>
					</div>	
				</div>
				<div class="post-content-area">
					<textarea class="form-control" placeholder="What's on your mind?"></textarea>
				</div>
				<!-- Hidden file input -->
				<input type="file" id="mediaInput" name="media[]" accept="image/*,video/*" multiple hidden>

				<!-- Preview area -->
				<div id="mediaPreview" class="mt-3 d-grid gap-2" style="display:none;"></div>
			</div>
		</div>
		<!-- Footer -->
		<footer class="footer border-0 fixed">
			<div class="container">
				<ul class="element-list">
					<li>
						<a href="javascript:void(0);" onclick="openMediaPicker()">
							<i class="fa-solid fa-file-image"></i>Photo/Video
						</a>
					</li>
					<li>
						<a href="new-post.php">
							<i class="fa-solid fa-video"></i>Live Video
						</a>
					</li>
					<li>
						<a href="new-post.php">
							<i class="fa-solid fa-camera"></i>Camera
						</a>
					</li>
				</ul>  
			</div>
		</footer>
		<!-- Footer End -->	
	</form>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/dz.carousel.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>

<script>
const MAX_FILES = 4;

function openMediaPicker() {
    document.getElementById('mediaInput').click();
}

document.getElementById('mediaInput').addEventListener('change', function () {
    const files = Array.from(this.files);
    const preview = document.getElementById('mediaPreview');

    preview.innerHTML = '';
    preview.style.display = 'block';

    if (files.length > MAX_FILES) {
        alert('You can upload a maximum of 4 photos or videos.');
        this.value = '';
        preview.style.display = 'none';
        return;
    }

    files.forEach(file => {
        const fileType = file.type;
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';

        if (fileType.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.width = '100%';
            img.style.borderRadius = '12px';
            img.onload = () => URL.revokeObjectURL(img.src);
            wrapper.appendChild(img);

        } else if (fileType.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            video.style.width = '100%';
            video.style.borderRadius = '12px';
            wrapper.appendChild(video);
        }

        preview.appendChild(wrapper);
    });
});
</script>


</body>

</html>