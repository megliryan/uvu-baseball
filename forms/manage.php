<?php
$title = "Manage Forms";
session_start();

// If the user is not logged in/an admin, send to admin login.
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ||
   !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("location: /admin-login.php");
    exit;
}

// I'd also like for the buttons to use POST, but hey, one thing at a time.

$success = null;
$action = filter_input(INPUT_GET, 'action');
# Not checking POST because no posts should lead here.
if ($action == NULL) {
    $action = "manage";
}

# Deletion logic
if ($action == "delete") {
    $target = filter_input(INPUT_GET, 'target');
    if ($target == null) {
        $success = false;
        $error = "No file specified.";
    } else {
        try {
            unlink($target); // Deletes the file.
            $success = true;
        } catch (Exception $err){
            $success = false;
            $error = "Could not delete the file:" . $err->getMessage();
        }
    }
}

# Gets all pdf files in the all_forms directory.

$forms_paths = glob('all_forms/*.pdf');
$forms_friendly = array();
foreach ($forms_paths as $formpath) {
  $formpath_steps = explode('/', $formpath);
  $formname = end($formpath_steps);
  array_push($forms_friendly, $formname);
}
$forms_available = array_combine($forms_friendly, $forms_paths);
# forms_available is now an array of (file friendly name => relative file path)

include('../views/header.php');
?>

<div class="jumbotron">
  <h1>Manage Forms</h1>      
</div>
<?php if ($success !== null):?>
  <?php if($success == true):?>
    <div class="m-4 alert alert-success"><strong>Success!</strong> File deleted successfully.</div>
  <?php else:?>
    <div class="m-4 alert alert-danger"><strong>Error!</strong> <?=$error?></div>
  <?php endif;?>
<?php endif;?>
<a class="m-4 btn btn-block btn-outline-success" href="upload.php">Upload New Form</a>
<table class="table table-hover table-light table-bordered m-4">
    <thead>
        <tr>
        <td>File Name</td>
        <td>Delete</td>
        </tr>
    </thead>
    <?php foreach ($forms_available as $formname => $formpath):?>
    <tr>
        <td><a href="<?=$formpath?>"><?=$formname?></a></td>
        <td><a href="manage.php?action=delete&target=<?=$formpath?>" class="btn btn-danger">
        <i class="material-icons">&#xe92b;</i> <?php # Delete forever icon ?>
        </a></td>
    </tr>
    <?php endforeach;?>
</table>

<?php include('../views/footer.php');?>