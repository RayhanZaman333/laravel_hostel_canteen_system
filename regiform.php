<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/inc/header.php');
    include_once ($filepath.'/classes/user.php');
     $user = new User();

?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $adduser = $user->AdduserData($_POST);
  }
?>
<div style="width: 100%; height: 15%; font-size: 18px; color: red; text-align: center; ">
    <h3>Baiust Canteen Management System</h3>
  </div>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ADD User</h3>
            </div>
            <?/*php if (isset($addTrip)) {
              echo $addTrip;
            }*/ ?>
        <form class="form-horizontal" action="" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">User Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" required="required" placeholder="User-Name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
               <input type="email" class="form-control" name="email" required="required" placeholder="User@gm.com">
              </div>
            </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Roll No.</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" name="roll" required="required" placeholder="Roll No.">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Section</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" name="depart" required="required" placeholder="Department">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Pass word</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" name="password" required="required">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Role Type</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" name="role_type" required="required" placeholder="Role type">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">User Type</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" name="user_type" required="required" placeholder="User Type">
              </div>
            </div>
           
          </div>
          <div class="box-footer">
           <button type="submit" class="btn btn-info pull-right" name="submit">Submit</button>
          </div>
        </form>
          </div>
         </div>
       </div>
     </section>


<?php include 'inc/footer.php' ;?>