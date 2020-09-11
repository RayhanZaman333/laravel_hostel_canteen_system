<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/inc/header.php');
    include_once ($filepath.'/classes/Admin.php');
     $ad = new Admin();
    include_once ($filepath.'/../classes/user.php');
     $user = new User();
?>

<div class="login-box">
  <div style="width: 100%; height: 15%; font-size: 18px; color: red; text-align: center; ">
    <h3>Baiust Canteen Management System</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to your Account</p>
 <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminData = $ad->getAdminData($_POST);
  }
?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email    = $_POST['email'];
      $password = $_POST['password'];
    
     $userData = $user->userLogin($email, $password);  
  }
?>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <select id="select" class="form-control" name="controlvalue" required="required">
          <option value="USER">User</option>
          <option value="ADMIN">Admin</option>
        </select>
        
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	 
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="Login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
        <a href="regiform.php">Registration Here...</a>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php include 'inc/footer.php' ;?>
