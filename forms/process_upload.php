<?php


$target_dir = "uploaded_files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$success = true;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($fileType != 'pdf') {
    // Send error back to upload.php that the upload wasn't completed.
    $success = false;
    $error = 'File type must be a PDF.';
}
if (file_exists($target_file)) {
    // Send error back to upload.php that a file with that name already exists.
    // Also probably tell them to delete it first before trying again.
    $success = false;
    $error = 'A file with that name already exists. Please delete that file before trying again.';
}
if ($_FILES['fileToUpload']['size'] > 1_000_000) {
    // If the file size is large.
    // 1 million bytes is 1 MB. "Beginning C++ Game Programming - Second Edition.pdf" is 6 MB.
    // So we will probably not have issues with these small forms.
    // Send an error back saying the file is too large.
    $success = false;
    $error = 'That file is too large (maximum size = 1 MB)';
}

if (!$success) {
    // Redirect the user back to the upload page with the error.
    // Likely include $success and $error in it.
} else {
    // Try to move the file into the uploaded files.
    if (move_uploaded_file($_FILES['fileToUpload']['name'], $target_file)) {
        // Returns true on success.
        // Redirect back to the upload page and let the user know it was a success.
    }
    else {
        // Internal error.
        $error = 'Internal error. Try again.';
        // Redirect back to upload page.
    }
}

?>
