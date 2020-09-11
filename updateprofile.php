<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php');
?>
<?php 
    if (!isset($_GET['upid']) || $_GET['upid'] == null) {
    echo "<script>window.location = 'home.php';</script>";
}else{
    $drer_id = $_GET['upid'];
}
    ?> 

<?php
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
     $updatepro = $user->updateprofile($drer_id, $_POST);  
  }
    ?>
    <section class="content">
      <div class="row">
        <div class="col-md-8">
<div class="box box-info">

           <?php
                   $user = new User();
                  $deiviewdata = $user->getUsersData($drer_id);
                  if ($deiviewdata) {
                        foreach ($deiviewdata as $sdata) { 
              ?>
            <div class="box-header with-border">
              <h3 class="box-title">UPDATE PROFILE</h3>
            </div>
            <?php
               if (isset($updatepro)) {
               	echo $updatepro;
               } ?>
         <form class="form-horizontal" action="" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label"> Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" required="required" value="<?php echo $sdata['name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"> Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" required="required" value="<?php echo $sdata['email']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"> Roll No.</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="roll" required="required" value="<?php echo $sdata['roll']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"> Department</label>
              <div class="col-sm-10">
               <input type="text" class="form-control" name="depart" required="required" value="<?php echo $sdata['depart']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"> Role Type</label>
              <div class="col-sm-10">
               <input type="text" class="form-control" name="role_type" required="required" value="<?php echo $sdata['role_type']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label"> USer Type</label>
              <div class="col-sm-10">
               <input type="text" class="form-control" name="user_type" required="required" value="<?php echo $sdata['user_type']; ?>">
              </div>
            </div>
            
          </div>
          <div class="box-footer">
           <button type="submit" class="btn btn-info pull-right" name="update">Update</button>
          </div>
        </form>
         <?php } } ?>
          </div>

   </div>
      </div>
    </section>

<?php
include 'drfooter.php';
?>