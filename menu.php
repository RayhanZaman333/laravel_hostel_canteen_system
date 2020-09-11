<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php'); 
?>


    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Food list</h3>
            </div>              
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
                      <a class="btn-success" href="#">Active</a><?php }elseif($result['status']==1){?>
                        <a class="btn-warning" href="#">Inactive</a><?php } ?>
                    </td>

                  <td><a class="btn-info" href="fooddetails.php?meuid=<?php echo $result['menu_id']; ?>">Order Now</a>
            </td>       
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