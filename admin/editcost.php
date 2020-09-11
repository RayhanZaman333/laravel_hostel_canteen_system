<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>
<?php
if (!isset($_GET['tcostid']) || $_GET['tcostid'] == null) {
    echo "<script>window.location = 'costlist.php';</script>";
}else{
    $costeditid = $_GET['tcostid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
       $updatecost = $ad->updateCostData($costeditid, $_POST);
   }
?>

 <section class="content-header">
      <h1>
        Administrator
        <small>Control panel</small>
      </h1>
     </section>
<?php
          $updateBacost = $ad->getviewCost($costeditid);
          if ($updateBacost) {   
          foreach ($updateBacost as $stdata) {          
        ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">UPDATE COST</h3>
            </div>
            <?php
               if (isset($updatecost)) {
               	echo $updatecost;
              } ?>
        <form class="form-horizontal" action="" method="POST">
          <div class="box-body">
          	<div class="form-group">
              <label class="col-sm-2 control-label">Daily Cost TK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="daily" value="<?php echo $stdata['daily'];?>" required="required">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Cost Details</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="details" value="<?php echo $stdata['details'];?>" required="required">
              </div>
            </div>
            
            
          </div>
          <div class="box-footer">
           <button type="submit" class="btn btn-info pull-right" name="update">Update</button>
          </div>
          <!-- /.box-footer -->
        </form>
          </div>
         </div>
       </div>
     </section>
     <?php } } ?>
<?php
include 'inc/footer.php';
?>