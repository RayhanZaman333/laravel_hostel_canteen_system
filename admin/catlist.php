<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>

<?php
if (isset($_GET['delmenu'])) {
  $delid = $_GET['delmenu'];
    $delmenu = $ad->deleteMenu($delid);
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
              <h3 class="box-title">Category MENU</h3>
            </div>
           <?php
               if (isset($delmenu)) {
                echo $delmenu;
               } ?>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Name</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <?php 
                     $menudata = $ad->getcateData();
		               if ($menudata) {
		                $i = 0;
		                    while ($result = $menudata->fetch_assoc()) {
		                        $i++;
                ?>
                <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['cname']; ?></td>
                    <td> <a onclick="return confirm('Are you Sure to Delete !')" class="btn btn-danger" href="?delmenu=<?php echo $result['cat_id']; ?>">Delete</a></td>
            
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