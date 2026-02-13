<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require __DIR__ . '/vendor/autoload.php';
?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

$showModal = false;
$modalTitle = '';
$modalMessage = '';
$modalType = 'success';
$redirectUrl = null;
$autoClose = false;

require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $email = trim($_POST['email']);

    // ❌ INVALID EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $showModal = true;
        $modalType = 'error';
        $modalTitle = 'Invalid Email';
        $modalMessage = 'Please enter a valid email address to continue.';
        $redirectUrl = null;
        $autoClose = true;

    } else {

        $otp = rand(1000, 9999);
        $uin = "C8L" . rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        // ❌ EMAIL EXISTS
        if ($check->num_rows > 0) {
            $showModal = true;
            $modalType = 'error';
            $modalTitle = 'Email Already Registered';
            $modalMessage = 'This email is already registered. Please login instead.';
            $redirectUrl = null;
            $autoClose = true;
        } 
        // ✅ SUCCESS
        else {
            $insert = $conn->prepare(
                "INSERT INTO users (email, otp_code, uin, otp_expiry) VALUES (?, ?, ?, ?)"
            );
            $insert->bind_param("siss", $email, $otp, $uin, $otp_expiry);
            $insert->execute();

            $showModal = true;
            $modalType = 'success';
            $modalTitle = 'OTP Sent!';
            $modalMessage = 'An OTP has been sent to your email address.';
            $redirectUrl = 'verify-otp.php?email=' . urlencode($email);
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
	<meta name="description" content="Verify your email to complete your registration on Crea8link. Enter the OTP sent to your email and start connecting with creatives worldwide."/>
	<meta property="og:title" content="Verify Your Email – Crea8link" />
	<meta property="og:description" content="Complete your Crea8link registration by verifying your email. Enter the OTP sent to your inbox and start connecting with creatives worldwide." />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    
    <!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    
    <!-- Title -->
	<title>Verify Your Email – Crea8link</title>
    
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
						<h1 class="title">Verify Email</h1>
						<p>Please verify your email address to continue. We'll send an OTP the email provided.</p>
					</div>
                    <form method="post">
                        <div class="mb-3 input-group input-group-icon">
                            <span class="input-group-text">
                                <div class="input-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 6L12 13L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>		
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block mb-3">VERIFY EMAIL</button>
                    </form>
					<div class="d-flex align-items-center justify-content-center">
						<a href="javascript:void(0);" class="text-light text-center d-block">Already have an account?</a>
						<a href="login.php" class="btn-link d-block ms-3 text-underline">Sign in</a>
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
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/dz.carousel.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>

<?php if ($showModal): ?>
<div class="modal fade" id="statusModal" tabindex="-1" data-bs-backdrop="<?= $modalType === 'error' ? 'true' : 'static' ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">

                <!-- ICON -->
                <?php if ($modalType === 'success'): ?>
                    <svg viewBox="0 0 24 24" width="26" height="26"
                         stroke="currentColor" class="text-success mb-2"
                         stroke-width="2" fill="none">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                <?php else: ?>
                    <svg viewBox="0 0 24 24" width="26" height="26"
                         stroke="currentColor" class="text-danger mb-2"
                         stroke-width="2" fill="none">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                <?php endif; ?>

                <h6 class="mt-2"><?= htmlspecialchars($modalTitle) ?></h6>
                <p><?= htmlspecialchars($modalMessage) ?></p>

                <!-- CLOSE BUTTON -->
                <?php if ($modalType === 'error'): ?>
                    <button type="button"
                            class="btn btn-outline-secondary btn-sm mt-2"
                            data-bs-dismiss="modal">
                        Close
                    </button>
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

    <?php if ($autoClose): ?>
    setTimeout(() => {
        modal.hide();
        <?php if ($redirectUrl): ?>
            window.location.href = "<?= $redirectUrl ?>";
        <?php endif; ?>
    }, 2500);
    <?php endif; ?>

    <?php if (!$autoClose && $redirectUrl): ?>
    setTimeout(() => {
        window.location.href = "<?= $redirectUrl ?>";
    }, 2000);
    <?php endif; ?>
});
</script>
<?php endif; ?>


</body>

</html>