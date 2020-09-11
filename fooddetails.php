<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php'); 
?>
<?php 
if (isset($_GET['meuid'])) {
      $foodM = $_GET['meuid'];
}
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $queanty = $_POST['queanty'];
  
    $Addcart = $user->AddTOBCart($queanty, $foodM);
}
?>


    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Orderlist</h3>
            </div>              
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>category</th>
                  <th>Day</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <?php 
                     $menudata = $user->menuorder($foodM);
		               if ($menudata) {
		                $i = 0;
		                    while ($result = $menudata->fetch_assoc()) {
		                        $i++;
                ?>
                <tbody>
                <tr>
                  <td><?php echo $result['cname']; ?></td>
                  <td><?php echo $result['day']; ?></td>
                  <td><?php echo $result['name']; ?></td>
                  <td><?php echo $result['price']; ?></td>
                  

                  <td><form action="" method="post">
            <input type="hidden" class="buyfield" name="queanty" value="1"/>
            <input type="submit" class="btn-info" name="submit" value="Ok"/>
          </form></td>       
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