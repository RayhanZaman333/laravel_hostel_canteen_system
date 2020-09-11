<?php 
    $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/inc/header.php');
?>

<?php
  if (isset($_GET['shiftid'])) {
  	 $idshift = $_GET['shiftid'];  	 
  	 $date = $_GET['date'];  	 
  	 $shift = $user->productShifted($idshift, $date);
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
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">USER</h3>
            </div>
              <?php
                 if (isset($shift)) {
                 	echo $shift;
                 }
                ?>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL.NO</th>
                  <th>Order Time</th>
                  <th>Day</th>
                  <th>Name</th>  
                  <th>Quantity</th>
                  <th>Price</th>  
                  <th>User ID</th> 
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <?php 
                      $getview = $user->GetViewProduct();
                       if ($getview) {
                       	while ($result = $getview->fetch_assoc()) {
                       	?>
                <tbody>
                <tr>
                  <td><?php echo $result['id']; ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td>
                  <td><?php echo $result['day']; ?></td>
                  <td><?php echo $result['name']; ?></td>
                  <td><?php echo $result['queanty']; ?></td>
                  <td><?php echo $result['price']; ?></td>
                  <td><?php echo $result['us_id']; ?></td>
                 <td><a href="orderuser.php?usedid=<?php echo $result['us_id']; ?>">View Details</a></td>
                   <?php
                                if ($result['status'] == '0') {	?>
                                	<td><a href="?shiftid=<?php echo $result['us_id']; ?> & date=<?php echo $result['date']; ?>">Shifted</a></td>
                                <?php } elseif($result['status'] == '1') { ?>
                                   <td>ok</td>
                               	<?php } ?>
                    
            
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