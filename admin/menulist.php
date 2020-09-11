<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>

<?php
if (isset($_GET['delmenu'])) {
  $delid = $_GET['delmenu'];
    $delmenu = $ad->deleteMMenu($delid);
} ?>
<?php
if (isset($_GET['activeid'])) {
  $active = $_GET['activeid'];
    $activeid = $ad->ActiveMMenu($active);
} ?>
<?php
if (isset($_GET['unactiveid'])) {
  $unactive = $_GET['unactiveid'];
    $unactiveid = $ad->UNActiveMMenu($unactive);
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
              <h3 class="box-title">MENU LIST</h3>
            </div>
           <?php
               if (isset($delmenu)) {
                echo $delmenu;
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
                  <th>Category</th>
                  <th>Day</th>
                  <th>Name</th>
                  <th>Price</th>  
                  <th>Status</th>  
                  <th>Action</th>
                </tr>
                </thead>
                <?php 
                     $menudata = $ad->getMenuData();
		               if ($menudata) {
		                $i = 0;
		                    while ($result = $menudata->fetch_assoc()) {
		                        $i++;
                ?>
                <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['cname']; ?></td>
                  <td><?php echo $result['day']; ?></td>
                  <td><?php echo $result['name']; ?></td>
                  <td><?php echo $result['price']; ?></td>
                  <td>
                    <?php if ($result['status']==0) {?>
                      <a class="btn btn-success" href="?activeid=<?php echo $result['menu_id']; ?>">Active</a><?php }elseif($result['status']==1){?>
                        <a class="btn btn-warning" href="?unactiveid=<?php echo $result['menu_id']; ?>">Inactive</a><?php } ?>
                    </td>
                    <td> <a onclick="return confirm('Are you Sure to Delete !')" class="btn btn-danger" href="?delmenu=<?php echo $result['menu_id']; ?>">Delete</a></td>
            
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