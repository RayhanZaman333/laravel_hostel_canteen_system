<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>
<?php
if (isset($_GET['deluser'])) {
  $delid = $_GET['deluser'];
    $deluser = $ad->deleteUser($delid);
} ?>
<?php
if (isset($_GET['activeid'])) {
  $active = $_GET['activeid'];
    $activeid = $ad->ActiveUser($active);
} ?>
<?php
if (isset($_GET['unactiveid'])) {
  $unactive = $_GET['unactiveid'];
    $unactiveid = $ad->UNActiveUser($unactive);
} ?>


<section class="content-header">
      <h1> 
        Administrator
        <small>Control panel</small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">USER</h3>
            </div>
               <?php
               if (isset($deluser)) {
                echo $deluser;
               } ?>
               <?php
               if (isset($activeid)) {
                echo $activeid;
               } ?>
               <?php
               if (isset($unactiveid)) {
                echo $unactiveid;
               } ?>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roll No.</th>  
                  <th>Department</th>
                  <th>Role Type</th>
                  <th>User Type</th>  
                  <th>Join Date</th> 
                  <th>status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <?php 
                     $usedata = $ad->getuserData();
		               if ($usedata) {
		                $i = 0;
		                    while ($result = $usedata->fetch_assoc()) {
		                        $i++;
                ?>
                <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['name']; ?></td>
                  <td><?php echo $result['email']; ?></td>
                  <td><?php echo $result['roll']; ?></td>
                  <td><?php echo $result['depart']; ?></td>
                  <td><?php echo $result['role_type']; ?></td>
                  <td><?php echo $result['user_type']; ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td>
                   <td>
                    <?php if ($result['status']==0) {?>
                      <a class="btn btn-success" href="?activeid=<?php echo $result['id']; ?>">Active</a><?php }elseif($result['status']==1){?>
                        <a class="btn btn-warning" href="?unactiveid=<?php echo $result['id']; ?>">Inactive</a><?php } ?>
                    </td>
                    <td> <a onclick="return confirm('Are you Sure to Delete !')" class="btn btn-danger" href="?deluser=<?php echo $result['id']; ?>">Delete</a></td>
                    
            
                </tr>
            </tbody>
        <?php } } ?>
        </table>
    </div>
   </div>
  </div>
  </div>
</section>

<?php
include 'inc/footer.php';
?>