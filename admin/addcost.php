<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $addcost = $ad->AddCostData($_POST);
  }
?>

 <section class="content-header">
      <h1>
        Administrator
        <small>Control panel</small>
      </h1>
     </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">ADD BAZER</h3>
            </div>
            <?php
               if (isset($addcost)) {
               	echo $addcost;
               } ?>
        <form class="form-horizontal" action="" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Daily Cost TK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="daily" required="required" placeholder="Daily Cost">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Cost Details</label>
              <div class="col-sm-10">
              <textarea rows="5" cols="100%" name="details" required="required"></textarea>
             </div>
            </div>
            
          </div>
          <div class="box-footer">
           <button type="submit" class="btn btn-info pull-right" name="submit">Submit</button>
          </div>
          <!-- /.box-footer -->
        </form>
          </div>
         </div>
       </div>
     </section>
<?php
include 'inc/footer.php';
?>