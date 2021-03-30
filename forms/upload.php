<?php
$title = 'Upload Form';
session_start();
$success = null;

// TODO: AND THIS IS IMPORATANT
// Make sure that an admin is logged in to allow access.


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'menu';
    }
}

if ($action == 'upload') {

    $target_dir = "all_forms/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $success = true;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if ($fileType != 'pdf') {
       // Send error that the upload wasn't completed.
       $success = false;
       $error = 'File type must be a PDF.';
    }
    if (file_exists($target_file)) {
        // Send error that a file with that name already exists.
        // Also probably tell them to delete it first before trying again.
        $success = false;
        $error = 'A file with that name already exists. Please delete that file before trying again.';
    }
    if ($_FILES['fileToUpload']['size'] > 1_000_000) {
        // If the file size is large.
        // 1 million bytes is 1 MB. This textbook I have is 6 MB.
        // So we will probably not have issues with these small forms.
        // Send an error saying the file is too large.
        $success = false;
        $error = 'That file is too large (maximum size = 1 MB)';
    }
    // Gone through the main problems, now on to the actual work.
    if ($success) {
        // Try to move the file into the uploaded files.
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            // Returns true on success.
            // Redirect back to the upload page and let the user know it was a success.
            // ALSO: do database stuff. Make sure the file owner is added, too.
        }
        else {
            // Internal error.
            $error = 'Internal error. Try again.';
        }
    }
} else {
    // Nothing else really to do.
}

include('../views/header.php');
?>
<!-- Heading for forms page -->
<div class="jumbotron">
  <h1>Upload Form</h1>      
</div>
<!-- End of heading for forms page -->
<?php if ($success !== null):?>
  <?php if ($success === true) :?>
    <div class="m-4 alert alert-success">
      <strong>Success!</strong> Your file was successully uploaded.
    </div>
  <?php elseif ($success === false) :?>
    <div class="m-4 alert alert-danger">
        <strong>Error!</strong> <?=$error?>
    </div>
  <?php endif;?>
<?php endif?>
  <div class="m-4 p-3 container-fluid bg-light text-body">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <!-- <label for="name">Form name:</label><br/>
      <input type="text" name="name" id="name"><br/><br/> -->
      <input type="hidden" name="action" value="upload">
      <label for="fileToUpload">Form to upload: (Must be a pdf)</label><br/>
      <input type="file" name="fileToUpload" id="fileToUpload"><br/><br/>
      <input type="submit" value="Submit">
    </form>
  </div>

<?php include('../views/footer.php');?>
