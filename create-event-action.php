<?php
include "db_conn.php";
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    $uid = "CR8L-" . uniqid();
    
    // Retrieve POST data
    $eventTitle = $_POST['event-title'];
    $eventCategory = $_POST['event-category'];
    $eventType = $_POST['event-type'];
    $startDate = $_POST['start-date'];
    $startTime = $_POST['start-time'];
    $endDate = $_POST['end-date'];
    $endTime = $_POST['end-time'];
    $eventLocation = $_POST['event-location'];
    $estimatedVisitors = $_POST['estimated-visitors'];
    $estimatedExhibitors = $_POST['estimated-exhibitors'];
    $addGuest = $_POST['add-guest'];
    $isFree = $_POST['is-free'];
    $eventPrice = $_POST['event-price'];
    $eventDescription = $_POST['event-description'];

    // Image upload handling
    $images = $uid . basename($_FILES['images']['name']); // Added basename for security
    $targetDir = "event-images/";
    $targetFile = $targetDir . $images;

    // Validate file upload
    if (!isset($_FILES['images']) || $_FILES['images']['error'] !== UPLOAD_ERR_OK) {
        echo "Error: No file uploaded or upload error occurred.";
        exit;
    }

    // Optional: Validate file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = mime_content_type($_FILES['images']['tmp_name']);
    
    if (!in_array($fileType, $allowedTypes)) {
        echo "Error: Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.";
        exit;
    }

    // Optional: Validate file size (e.g., 5MB max)
    $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
    if ($_FILES['images']['size'] > $maxFileSize) {
        echo "Error: File size exceeds 5MB limit.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFile)) {
        
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO events (uid, title, category, type, start_date, start_time, end_date, end_time, location, estimated_visitors, estimated_exhibitors, add_guest, is_free, price, description, image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            // Bind parameters (s = string, i = integer, d = double)
            mysqli_stmt_bind_param($stmt, "sssssssssiissdss", 
                $uid, 
                $eventTitle, 
                $eventCategory, 
                $eventType, 
                $startDate, 
                $startTime, 
                $endDate, 
                $endTime, 
                $eventLocation, 
                $estimatedVisitors, 
                $estimatedExhibitors, 
                $addGuest, 
                $isFree, 
                $eventPrice, 
                $eventDescription, 
                $images
            );
            
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Event created successfully.";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
        // Optional: Add more detailed error for debugging
        // echo "Upload error code: " . $_FILES['images']['error'];
    }
}
?>