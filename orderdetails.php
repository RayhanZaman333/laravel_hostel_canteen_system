<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php'); 
?>
 <?php
  if (isset($_GET['usid'])) {
     $idshift = $_GET['usid'];    
     $date = $_GET['date'];    
     $confirm = $user->productconfirmShift($idshift, $date);
  }
  ?>


    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order Details</h3>
            </div>              
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Day</th>
                  <th>Name</th>                  
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                  </tr>
                </thead>
                 <?php
               $useid = Session::get("id");
             $getOrder = $user->GetOrderProduct($useid);
             if ($getOrder) {
              $i = 0;
              while ($result = $getOrder->fetch_assoc()) {
                $i++;
          ?>
                <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['day']; ?></td>
                  <td><?php echo $result['name']; ?></td>
                  <td><?php echo $result['queanty']; ?></td>
                 <td>tk <?php $total = $result['price'] * $result['queanty'];
                echo $total;
                 ?></td>
                  <td><?php echo $fm->formatDate($result['date']); ?></td> 
                  <td><?php 
                       if ($result['status'] == '0') {
                           echo "Pending";
                       }elseif($result['status'] == '1'){ 
                           echo "Shifted";
                         }else{
                          echo "ok";
                         }
                        ?></td>  
                         <?php 
                      if ($result['status'] == '1') { ?>
                         <td><a href="?usid=<?php echo $useid; ?> & date=<?php echo $result['date']; ?>">OK</a></td>
                      <?php }elseif($result['status'] == '0'){ ?>
                        <td>N/A</td>
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
include 'drfooter.php';
?>