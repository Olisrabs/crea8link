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

// Fetch user data if email is set
if (isset($_REQUEST["email"])) {
    $email = trim($_REQUEST["email"]);

    // Use prepared statement for safety
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        // User not found
        $showModal = true;
        $modalType = 'error';
        $modalTitle = 'Error';
        $modalMessage = 'User not found. Please register first.';
        $redirectUrl = 'index.php';
    } else {
        $dbotp = $user['otp_code'];
        $uin = $user['uin'];
        $otp_expiry = $user['otp_expiry']; // If you added expiry column
    }
}

// Handle OTP submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $entered_otp = trim($_POST['digit-2'] . $_POST['digit-3'] . $_POST['digit-4'] . $_POST['digit-5']);

    // Check OTP expiry (optional)
    if (isset($otp_expiry) && strtotime($otp_expiry) < time()) {
        $showModal = true;
        $modalType = 'error';
        $modalTitle = 'OTP Expired';
        $modalMessage = 'Your OTP has expired. Please request a new one.';
        $redirectUrl = 'index.php';
    }
    // Invalid OTP
    elseif ($entered_otp != $dbotp) {
        $showModal = true;
        $modalType = 'error';
        $modalTitle = 'Invalid OTP';
        $modalMessage = 'The OTP you entered is incorrect. Try again.';
        $redirectUrl = null; // stay on page
    }
    // Successful OTP
    else {
        // Optionally mark user as verified
        $update = $conn->prepare("UPDATE users SET is_verified=1 WHERE email=?");
        $update->bind_param("s", $email);
        $update->execute();

        $showModal = true;
        $modalType = 'success';
        $modalTitle = 'Verified!';
        $modalMessage = 'Your email has been successfully verified.';
        $redirectUrl = 'register.php?email=' . urlencode($email);
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
	<meta name="description" content="Enter the OTP sent to your email to verify your account on Crea8link. Complete your registration and start connecting with creatives worldwide."/>
	<meta property="og:title" content="Verify OTP – Crea8link" />
	<meta property="og:description" content="Verify your account on Crea8link by entering the OTP sent to your email. Complete your registration and start connecting with creatives worldwide." />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    
    <!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    
    <!-- Title -->
	<title>Verify OTP – Crea8link</title>
    
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
				<div class="bg-image bg-image-overlay" style="background-image: url(assets/images/login/pic5.jpg);"></div>
				<div class="join-area">
					<div class="started">
						<h1 class="title">Enter Code</h1>
						<p>Enter the OTP sent to your email to verify your account and complete registration.</p>
					</div>
					<form method="post">
                        <div method="get" id="otp" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                            <input class="form-control" type="text" id="digit-2" name="digit-2" placeholder="-" data-next="digit-3" data-previous="digit-1" required />
                            <input class="form-control" type="text" id="digit-3" name="digit-3" placeholder="-" data-next="digit-4" data-previous="digit-2" required />
                            <input class="form-control" type="text" id="digit-4" name="digit-4" placeholder="-" data-next="digit-5" data-previous="digit-3" required />
                            <input class="form-control" type="text" id="digit-5" name="digit-5" placeholder="-" data-next="digit-6" data-previous="digit-4" required />
                        </div>    
						
						<div class="seprate-box mb-3">
							<a href="javascript:void(0);" class="back-btn" onclick="history.back();">
								<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M4.40366 8L9.91646 2.58333L7.83313 0.499999L0.333132 8L7.83313 15.5L9.91644 13.4167L4.40366 8Z" fill="white"/>
								</svg>
							</a>
							<button type="submit" name="submit" class="btn btn-primary btn-block">NEXT</button>
						</div>
                    </form>
					<div class="d-flex align-items-center justify-content-center">
						<a href="javascript:void(0);" class="text-light text-center d-block">Don’t you recevied any code?</a>
						<a href="javascript:void(0);" class="btn-link d-block ms-2 text-underline">Resend</a>
					</div>
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
<div class="modal fade" id="statusModal" tabindex="-1" data-bs-backdrop="<?= $modalType === 'error' ? 'true' : 'static' ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">

                <!-- ICON -->
                <?php if ($modalType === 'success'): ?>
                    <svg viewBox="0 0 24 24" width="26" height="26" stroke="currentColor" class="text-success mb-2" stroke-width="2" fill="none">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                <?php else: ?>
                    <svg viewBox="0 0 24 24" width="26" height="26" stroke="currentColor" class="text-danger mb-2" stroke-width="2" fill="none">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                <?php endif; ?>

                <h6 class="mt-2"><?= htmlspecialchars($modalTitle) ?></h6>
                <p><?= htmlspecialchars($modalMessage) ?></p>

                <!-- CLOSE BUTTON FOR ERRORS -->
                <?php if ($modalType === 'error'): ?>
                    <button type="button" class="btn btn-outline-secondary btn-sm mt-2" data-bs-dismiss="modal">Close</button>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const modalEl = document.getElementById('statusModal');
		const modal = new bootstrap.Modal(modalEl);
		modal.show();

		<?php if ($modalType === 'error'): ?>
		setTimeout(() => modal.hide(), 1500);
		<?php endif; ?>

		<?php if ($redirectUrl): ?>
		setTimeout(() => {
			window.location.href = "<?= $redirectUrl ?>";
		}, 2000);
		<?php endif; ?>
	});
</script>
<?php endif; ?>

</body>

</html>