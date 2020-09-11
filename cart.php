<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/drheader.php'); 
?>
<?php
if (isset($_GET['delpro'])) {
  $delid = $_GET['delpro'];
    $delprodu = $user->delcaRTPro($delid);
} ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartid = $_POST['id'];
    $queanty = $_POST['queanty'];
    $updatecart = $user->UpdateCart($cartid, $queanty);
    if ($queanty<=0) {
       $delprodu = $user->delcaRTPro($cartid);
    }
}
?>
<?php
  if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live' />";
  }

?>


    <section class="content">
      <div class="row">

        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Your Order</h3>
            </div>  
            <?php 
                     if (isset($updatecart )) {
                      echo $updatecart;
                     }
            ?>            
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total Price</th>                  
                  <th>Action</th>
                  </tr>
                </thead>
                <?php 
                     $getmenu = $user->Getcart();
		               if ($getmenu) {
		                $i = 0;
                    $sum = 0;
                    $qty = 0;
		                    while ($result = $getmenu->fetch_assoc()) {
		                        $i++;
                ?>
                <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['menu']; ?></td>
                  <td><?php echo $result['rate']; ?></td>
                  <td><form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $result['id']; ?>"/>
                    <input type="number" name="queanty" value="<?php echo $result['queanty']; ?>"/>
                    <input type="submit" name="submit" value="Update"/>
                  </form></td>
                  <td>tk <?php 
                $total = $result['rate'] * $result['queanty'];
                echo $total;
                 ?></td>
                  

                  <td><a onclick="return confirm('Are you Sure to Delete !')" href="?delpro=<?php echo $result['id']; ?>">X</a></td>
              </tr><?php
                                     $sum =  $sum + $total;
                                     $qty =  $qty + $result['queanty'];
                                    
              ?> 
            </tbody>
        <?php } } ?>
        </table>
        <table style="float:right;text-align:left;" width="40%">
              <tr>
                <th>Sub Total : </th>
                <td>tk <?php echo $sum; ?></td>
              </tr>
              <tr>
                <th>VAT : </th>
                <td>05%</td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>tk <?php
                                    $vat = $sum * 0.05;
                                    $gtotal = $sum + $vat;
                                    echo $gtotal;
                                    ?></td>
              </tr>
             </table>

            
    </div>
    <center>
              <a href="payment.php" class="btn btn-info">Check Out</a>
            </center>
   </div>
</div>
   
  


  </div>
</section>







<?php
include 'drfooter.php';
?>