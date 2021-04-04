<?php
$title = "Forms";
session_start();
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

<!-- Heading for forms page -->
<div class="jumbotron">
  <h1>Forms</h1>      
  <h4></h4>
</div>
<!-- End of heading for forms page -->
<?php if (sizeof($forms_available) >= 1):?>
<div class="row m-4">
  <div class="col-sm-10">Find the document you want to download, then click the download button.</div>
  <?php if (isset($_SESSION['is_admin']) and $_SESSION['is_admin']):?>
  <div class="col-sm-2"><a class="btn btn-light" href="manage.php">Manage Forms</a></div>
  <?php endif;?>
</div>
<ul class="list-group m-4">
<?php foreach ($forms_available as $formname => $formpath):?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span class='text-body'><?=$formname?></span>
    <a href='<?=$formpath?>' target="_blank">
      <span class="badge badge-primary">
        <i class="material-icons">
          &#xe2c4;
        </i>
      </span>
    </a>
  </li>
<?php endforeach;?>
</ul> 
<?php else:?>
  <span class="m-4">There are no forms available for download right now. Try back later!</span>
<?php endif;?>

<?php include('../views/footer.php');?>
