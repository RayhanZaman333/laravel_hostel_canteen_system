 <?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php');
?>
<?php 
    if (!isset($_GET['passid']) || $_GET['passid'] == null) {
    echo "<script>window.location = 'home.php';</script>";
}else{
    $drir_id = $_GET['passid'];
}
    ?>

<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
     $updatepass = $user->updatepassword($drir_id, $_POST);  
  }
    ?>
       <section class="content">
      <div class="row">
        <div class="col-md-8">
       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">UPDATE PASSWORD</h3>
            </div>
            <?php
               if (isset($updatepass)) { 
               	echo $updatepass;
               } ?>
         <form class="form-horizontal" action="" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Old Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="old_pass" required="required" placeholder="Old Password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" required="required" placeholder="New Password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Confirm Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="new_password" required="required" placeholder="Confirm Password">
              </div>
            </div>
          </div>
          <div class="box-footer">
           <button type="submit" class="btn btn-info pull-right" name="update">Update</button>
          </div>
        </form>
          </div>



</div>
      </div>
    </section>




<?php
include 'drfooter.php';
?>