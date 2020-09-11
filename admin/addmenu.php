<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $addmenu = $ad->AddMenuData($_POST);
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
              <h3 class="box-title">ADD MENU</h3>
            </div>
            <?php
               if (isset($addmenu)) {
               	echo $addmenu;
               } ?>
        <form class="form-horizontal" action="" method="POST">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-2 control-label">Category</label>
              <div class="col-sm-10">
                <select id="select" class="form-control" name="cat_id">
                <option>Select Category</option>
                 <?php
                  $query = "select * from catagory";
                  $stuque =$db->select($query);
                  if ($stuque) {
                     while ($result = $stuque->fetch_assoc()) {
                  ?>
                <option value="<?php echo $result['cat_id']; ?>"><?php echo $result['cname']; ?></option>
                <?php } } ?>
              </select>
              </div>
            </div>

          	<div class="form-group">
              <label class="col-sm-2 control-label"> Day</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="day" required="required" placeholder=" Day">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="name" required="required" placeholder=" Name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Price</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="price" required="required" placeholder=" Price">
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