<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php'); 
?>
<?php 
     $user_id = Session::get("id");
    ?>

        <section class="content">
      <div class="row">
        <div class="col-md-8"> 
          <div class="box box-primary">
            <div class="box-body box-profile">
                <?php
                   $user = new User();
                  $deiviewdata = $user->getUserData($user_id);
                  if ($deiviewdata) {
                        foreach ($deiviewdata as $sdata) { 
              ?>

              <h3 class="profile-username text-center"><?php echo $sdata['name']; ?></h3>

              <ul class="list-group list-group-unbordered">

                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $sdata['email']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Roll No.</b> <a class="pull-right"><?php echo $sdata['roll']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Department</b> <a class="pull-right"><?php echo $sdata['depart']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Role Type</b> <a class="pull-right"><?php echo $sdata['role_type']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>User Type</b> <a class="pull-right"><?php echo $sdata['user_type']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Joining Date</b> <a class="pull-right"><?php echo $fm->formatDate($sdata['date']); ?></a>
                </li>
              </ul>
             <?php } } ?>
             <a href="updateprofile.php?upid=<?php echo $user_id; ?>" class="btn btn-primary "><b>Update</b></a>
              <a href="chgpassword.php?passid=<?php echo $user_id; ?>" class="btn btn-warning "><b>Change Password</b></a>
           
            </div>
          </div>
         
       </div>
      </div>
    </section>


<?php
include 'drfooter.php';
?>