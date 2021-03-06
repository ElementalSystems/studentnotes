<?php
require_once "../config.php";


use \Tsugi\Core\LTIX;

// Retrieve the launch data if present
$LTI = LTIX::requireData();
$p = $CFG->dbprefix;
$displayname = $USER->displayname;

$tab=0;
$editID=0;
$deleteID=0;
if (isset($_SESSION['lasttab'])) $tab=$_SESSION['lasttab'];
if (isset($_GET['tab'])) $tab=$_GET['tab'];
$_SESSION['lasttab']=$tab;
if (isset($_GET['modalEditID'])) $editID=$_GET['modalEditID'];
$_SESSION['editID']=$editID;
if (isset($_GET['deleteID'])) $deleteID=$_GET['deleteID'];
$_SESSION['deleteID']=$deleteID;



if ($editID) {
  require 'addnote_handler.php';
} else if ($deleteID) {
  require 'deletenote_handler.php';
} else {
  switch ($tab) {
    case 0:
       require 'addnote_handler.php';
       break;
    case 1:
      require 'studentlist_handler.php';
      break;
    case 2:
       require 'reportlist_handler.php';
       break;
  }
}

// Start of the output
$OUTPUT->header();
$OUTPUT->bodyStart();
?>
<ul class="nav nav-tabs">
  <li class=<?php echo ($tab==0)?'"active"':'"normal"';?>><a href=".?tab=0" onclick="return validateSwitch()">Add note</a></li>
  <li class=<?php echo ($tab==2)?'"active"':'"normal"';?>><a href=".?tab=2" onclick="return validateSwitch()">Generate list</a></li>
  <li class=<?php echo ($tab==1)?'"active"':'"normal"';?>><a href=".?tab=1" onclick="return validateSwitch()">Find student record</a></li>
</ul>
<br>
<?php
$OUTPUT->flashMessages();
?>

<?php
 if (!$USER->instructor) {
   require 'blockstudent.php';
 } else if ($editID) {
   require 'editnote.php';
 } else if ($deleteID) {
   require 'deletenote.php';
 } else {
    switch ($tab) {
      case 0:
         require 'addnote.php';
         break;
      case 1:
         require 'studentlist.php';
         break;
      case 2:
         require 'reportlist.php';
         break;
    }
  }
?>

  <br/>
  <br/>
  <br/>
  <br/>
  <div style="opacity: .8; font-size: 50%;">student notes module (v1.0) developed by elementalsystems for UCT</div>
<?php
$OUTPUT->footerStart();
?>
<script>
init();

</script>
<?php
$OUTPUT->footerEnd();
