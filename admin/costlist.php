<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
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
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">BAZER COST</h3>
            </div>
              
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Daily Cost</th>
                  <th>Details</th>  
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <?php 
                     $costdata = $ad->getCostData();
		               if ($costdata) {
		                $i = 0;
		                    while ($result = $costdata->fetch_assoc()) {
		                        $i++;
                ?>
                <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['daily']; ?> tk</td>
                  <td><?php echo $result['details']; ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td>
                  <td><a class="btn btn-primary" href="editcost.php?tcostid=<?php echo $result['id']; ?>">Edit</a></td>
                    
            
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