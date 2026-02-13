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
    <link href="assets/vendor/imageuplodify/imageuploadify.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

</head>   
<body>
<div class="page-wraper header-fixed">
    
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader end-->
    
    <!-- Header -->
	<header class="header">
		<div class="container">
			<div class="main-bar">
				<div class="left-content">
					<a href="javascript:void(0);" class="back-btn">
						<i class="fa-solid fa-arrow-left"></i>
					</a>
					<h4 class="title mb-0">Create Event</h4>
				</div>
				<div class="mid-content">
				</div>
				<div class="right-content">
				</div>
			</div>
		</div>
	</header>
    <!-- Header End -->
    
    
    <div class="page-content">
        <div class="container fb">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
							<form method="POST" enctype="multipart/form-data" id="eventForm" action="create-event-action.php">
								<!-- First Slide -->
								<div class="slide" id="slide1">
									<!-- Event Title -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa fa-bookmark"></i></span>
										<input type="text" class="form-control" name="event-title" placeholder="Event Title" required>
									</div>
									<!-- Event Category -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa fa-tags"></i></span>
										<input type="text" class="form-control" name="event-category" placeholder="e.g. Trade Show, Seminar" required>
									</div>
									<!-- Event Type -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa fa-music"></i></span>
										<input type="text" class="form-control dz-password" name="event-type" placeholder="e.g. Music, Tech" required>
									</div>
									<!-- Event Start Date -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
										<input type="date" class="form-control" name="start-date" id="startDate" required>
									</div>
									<!-- Event Start Time -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
										<input type="time" class="form-control" name="start-time" required>
									</div>
									<!-- Event End Date -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
										<input type="date" class="form-control" name="end-date" required>
									</div>
									<!-- Event End Time -->
									<div class="input-group mb-3">
										<span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
										<input type="time" class="form-control" name="end-time" required>
									</div>
									<!-- Next Button -->
									<button type="button" id="nextBtn" class="btn btn-secondary mt-3 btn-block">NEXT</button>
								</div>

								<!-- Second Slide -->
								<div class="slide d-none" id="slide2">
									<!-- Event Location -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
										<input type="text" class="form-control" name="event-location" placeholder="Event Location" required>
									</div>
									<!-- Estimated Visitors -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa fa-users"></i></span>
										<input type="text" class="form-control" name="estimated-visitors" placeholder="Estimated Visitors" required>
									</div>
									<!-- Estimated Exhibitors -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa fa-ticket"></i></span>
										<input type="text" class="form-control" name="estimated-exhibitors" placeholder="Estimated Exhibitors" required>
									</div>
									<!-- Add Guests -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
										<input type="text" class="form-control" name="add-guests" id="guestInput" placeholder="Add Guests">
										<div id="guestSuggestions" class="list-group"></div>
									</div>
									<!-- Is the event free -->
									<div class="mb-3 input-group">
										<span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
										<select class="form-control" name="is_free" id="isFree" required>
											<option value="">Is this event free?</option>
											<option value="yes">Yes</option>
											<option value="no">No</option>
										</select>
									</div>
									<!-- Price -->
									<div class="mb-3 input-group d-none" id="priceBox">
										<span class="input-group-text">₦</span>
										<input type="number" class="form-control" name="event-price" placeholder="Event Price">
									</div>
									<!-- Description -->
									<div class="input-group mb-3">
										<textarea class="form-control" name="event-description" placeholder="Event Description" rows="4" required></textarea>
									</div>
									<div class="input-group mb-3">
										<input type="file" class="imageuplodify" id="imageUpload" name="images[]" accept="image/*" multiple required>
										<small class="text-muted">Max 2 images</small>
									</div>
									<div id="previewBox" class="d-flex gap-2"></div>
									<div class="seprate-box mb-3">
										<button type="button" id="backBtn" class="btn light btn-dark m-2">
											<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M4.40366 8L9.91646 2.58333L7.83313 0.499999L0.333132 8L7.83313 15.5L9.91644 13.4167L4.40366 8Z" fill="white"/>
											</svg>
										</button>
										<button type="submit" name="submit" class="btn btn-secondary btn-block">CREATE EVENT</button>
									</div>
								</div>
							</form>
						</div>
                    </div>
                </div>
            </div>    
        </div>   
    </div>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="assets/vendor/imageuplodify/imageuploadify.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>
<script>
	$(document).ready(function() {
		$('input[type="file"]').imageuploadify();
	})
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ===============================
       SLIDE NAVIGATION
    =============================== */
    const slide1 = document.getElementById('slide1');
    const slide2 = document.getElementById('slide2');
    const nextBtn = document.getElementById('nextBtn');
    const backBtn = document.getElementById('backBtn');

    nextBtn.addEventListener('click', function () {
        slide1.classList.add('d-none');
        slide2.classList.remove('d-none');
    });

    backBtn.addEventListener('click', function () {
        slide1.classList.remove('d-none');
        slide2.classList.add('d-none');
    });

    /* ===============================
       DISABLE PAST START DATES
    =============================== */
    const startDate = document.getElementById('startDate');
    const today = new Date().toISOString().split('T')[0];
    startDate.setAttribute('min', today);

    /* ===============================
       IS FREE → SHOW PRICE
    =============================== */
    const isFree = document.getElementById('isFree');
    const priceBox = document.getElementById('priceBox');

    isFree.addEventListener('change', function () {
        priceBox.classList.toggle('d-none', this.value !== 'no');
    });

    /* ===============================
       ADD GUEST AUTOCOMPLETE
    =============================== */
    const guestInput = document.getElementById('guestInput');
    const suggestionBox = document.getElementById('guestSuggestions');

    guestInput.addEventListener('keyup', function () {
        const query = this.value.trim();

        if (query.length < 2) {
            suggestionBox.innerHTML = '';
            return;
        }

        fetch('search-users.php?q=' + encodeURIComponent(query))
            .then(response => response.text())
            .then(data => suggestionBox.innerHTML = data)
            .catch(() => suggestionBox.innerHTML = '');
    });

    // Expose globally for inline onclick
    window.selectGuest = function (username) {
        guestInput.value = username;
        suggestionBox.innerHTML = '';
    };

    /* ===============================
       IMAGE UPLOAD (MAX 2 + PREVIEW + REMOVE)
    =============================== */
    const imageInput = document.getElementById('imageUpload');
    const previewBox = document.getElementById('previewBox');

    imageInput.addEventListener('change', function () {
        previewBox.innerHTML = '';
        const files = Array.from(this.files);

        if (files.length > 2) {
            alert('You can upload a maximum of 2 images.');
            this.value = '';
            return;
        }

        files.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.style.position = 'relative';

                wrapper.innerHTML = `
                    <img src="${e.target.result}" width="100" class="rounded">
                    <button type="button"
                        style="position:absolute;top:-5px;right:-5px;"
                        class="btn btn-sm btn-danger"
                        data-index="${index}">×</button>
                `;

                previewBox.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });

    previewBox.addEventListener('click', function (e) {
        if (e.target.tagName === 'BUTTON') {
            imageInput.value = '';
            previewBox.innerHTML = '';
        }
    });

});
</script>

</body>

</html>