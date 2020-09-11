<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $addmenu = $ad->AddcategoryData($_POST);
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
              <h3 class="box-title">ADD CATEGORY</h3>
            </div>
            <?php
               if (isset($addmenu)) {
               	echo $addmenu;
               } ?>
        <form class="form-horizontal" action="" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="cname" required="required" placeholder="Name">
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