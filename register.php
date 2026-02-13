<?php
include("db_conn.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$showModal = false;
$modalType = '';
$modalTitle = '';
$modalMessage = '';
$redirectUrl = '';
$user = null;

// Fetch user data if email is set
if (isset($_REQUEST["email"])) {
    $email = trim($_REQUEST["email"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $showModal = true;
        $modalType = 'error';
        $modalTitle = 'Error';
        $modalMessage = 'User not found. Please register first.';
        $redirectUrl = 'index.php';
    }
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && $user) {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($fullname) || empty($username) || empty($password)) {
        $showModal = true;
        $modalType = 'error';
        $modalTitle = 'Error';
        $modalMessage = 'All fields are required.';
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $showModal = true;
            $modalType = 'error';
            $modalTitle = 'Username Taken';
            $modalMessage = 'This username is already in use. Please choose another.';
        } else {
            // Hash password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Update the existing user with fullname, username, password
            $update = $conn->prepare("UPDATE users SET fullname = ?, username = ?, password = ? WHERE email = ?");
            $update->bind_param("ssss", $fullname, $username, $passwordHash, $email);

            if ($update->execute()) {
                $showModal = true;
                $modalType = 'success';
                $modalTitle = 'Registration Complete';
                $modalMessage = 'Your account has been created successfully!';
                $redirectUrl = 'login.php';
            } else {
                $showModal = true;
                $modalType = 'error';
                $modalTitle = 'Error';
                $modalMessage = 'Failed to complete registration. Please try again.';
            }
        }
    }
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
	<meta name="description" content="Enter your details to finish setting up your Crea8link account and start connecting with creatives worldwide."/>
	<meta property="og:title" content="Finish Setting Up Your Account – Crea8link" />
	<meta property="og:description" content="Complete your Crea8link profile to start connecting with creatives, access exclusive tools, and unlock new opportunities." />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    
    <!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    
    <!-- Title -->
	<title>Finish Your Profile – Crea8link</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

</head>   
<body class="gradiant-bg">
<div class="page-wraper">
    
    <!-- Preloader -->
	<div id="preloader">
		<div class="spinner"></div>
	</div>
    <!-- Preloader end-->

    <!-- Welcome Start -->
	<div class="content-body">
		<div class="container vh-100">
			<div class="welcome-area">
				<div class="bg-image bg-image-overlay" style="background-image: url(assets/images/login/pic3.jpg);"></div>
				<div class="join-area">
					<div class="started">
						<h1 class="title">Create an Account</h1>
						<p>Complete your profile and begin your journey with the Crea8link community.</p>
					</div>
					<form method="post">
						<div class="mb-3 input-group input-group-icon">
							<span class="input-group-text">
								<div class="input-icon">
									<svg width="19" height="19" viewBox="0 0 19 19" fill="none">
										<path d="M15.587 16.3479V14.8261C15.587 14.019 15.2663 13.2448 14.6956 12.6741C14.1248 12.1033 13.3507 11.7827 12.5435 11.7827H6.45655C5.64937 11.7827 4.87525 12.1033 4.30448 12.6741C3.73372 13.2448 3.41307 14.019 3.41307 14.8261V16.3479" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										<path d="M9.50002 8.73918C11.1809 8.73918 12.5435 7.37657 12.5435 5.6957C12.5435 4.01483 11.1809 2.65222 9.50002 2.65222C7.81915 2.65222 6.45654 4.01483 6.45654 5.6957C6.45654 7.37657 7.81915 8.73918 9.50002 8.73918Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
								</div>
							</span>
							<input type="text" name="fullname" class="form-control" placeholder="Fullname" required>
						</div>
						<div class="mb-3 input-group input-group-icon">
							<span class="input-group-text">
								<div class="input-icon">
									<svg width="24" height="24" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve">
                                        <path d="M437.02,74.981C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.981C26.629,123.333,0,187.62,0,256    s26.629,132.667,74.98,181.019C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.981    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.981z M256,482c-66.869,0-127.037-29.202-168.452-75.511    C113.223,338.422,178.948,290,256,290c-49.706,0-90-40.294-90-90s40.294-90,90-90s90,40.294,90,90s-40.294,90-90,90    c77.052,0,142.777,48.422,168.452,116.489C383.037,452.798,322.869,482,256,482z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="white" data-original="white">
                                        </path>
                                    </svg>
								</div>		
							</span>
							<input type="text" name="username" class="form-control" placeholder="Username" required>
						</div>
						<div class="mb-3 input-group input-group-icon">
							<span class="input-group-text">
								<div class="input-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M5 12C4.44772 12 4 12.4477 4 13V20C4 20.5523 4.44772 21 5 21H19C19.5523 21 20 20.5523 20 20V13C20 12.4477 19.5523 12 19 12H5ZM2 13C2 11.3431 3.34315 10 5 10H19C20.6569 10 22 11.3431 22 13V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V13Z" fill="white"></path>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7V11C8 11.5523 7.55228 12 7 12C6.44772 12 6 11.5523 6 11V7C6 5.4087 6.63214 3.88258 7.75736 2.75736C8.88258 1.63214 10.4087 1 12 1C13.5913 1 15.1174 1.63214 16.2426 2.75736C17.3679 3.88258 18 5.4087 18 7V11C18 11.5523 17.5523 12 17 12C16.4477 12 16 11.5523 16 11V7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3Z" fill="white"></path>
									</svg>
								</div>
							</span>
							<input type="password" name="password" class="form-control dz-password" placeholder="Password" required>
							<span class="input-group-text show-pass"> 
								<i class="fa fa-eye-slash text-primary"></i>
								<i class="fa fa-eye text-primary"></i>
							</span>
						</div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">REGISTER</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    <!-- Welcome End -->
	
    
</div>
<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>

<?php if ($showModal): ?>
<div class="modal fade" id="registerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <?php if($modalType === 'success'): ?>
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="green" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                <?php else: ?>
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="red" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                <?php endif; ?>
                <h5><?= $modalTitle ?></h5>
                <p><?= $modalMessage ?></p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = new bootstrap.Modal(document.getElementById('registerModal'));
    modal.show();

    // Auto close after 1.5 seconds if redirect is set
    <?php if($redirectUrl): ?>
    setTimeout(function() {
        window.location.href = '<?= $redirectUrl ?>';
    }, 1500);
    <?php endif; ?>
});
</script>
<?php endif; ?>

</body>

</html>