<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
class Admin{	
       private $db;
       private $fm;  

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
  public function getAdminData($data)
  {
  	 $adminemail = $this->fm->validation($data['email']);
  	 $adminPass = $this->fm->validation($data['password']);
  	 $adminemail = mysqli_real_escape_string($this->db->link, $adminemail);
     $adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));

      if('ADMIN' == $_POST['controlvalue']){
     $query = "SELECT * FROM admin WHERE email = '$adminemail' AND password = '$adminPass'";
     $result = $this->db->select($query);
       if ($result != false) {
       	$value = $result->fetch_assoc();
        if ($value['status'] == '1') {
                 echo "disable";
                   exit();
                }else{
       	Session::init();
       	Session::set("adminLogin", true);
        Session::set("name", $value['name']);
       	Session::set("email", $value['email']);
       	Session::set("id", $value['id']);
       	header("location:admin/index.php");
       }
       }else{
       	echo "<div class='alert alert-danger'><strong>Error ! </strong>Admin Email & Password Not Matched !</div>";
       }
   }
 }
 
 public function AddcategoryData($data)
 {
       $cname = $data['cname'];
    if ($cname == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
        }else{
   $query = "INSERT INTO  catagory(cname) VALUES('$cname')";
       $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
       $msg = "<div class='alert alert-success'><strong>Success ! </strong> Insert Data Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Data Not Insert</div>";
        return $msg;
        }
    }
  }
 
 public function getcateData()
 {
   $query = "SELECT * FROM catagory ";
    $result = $this->db->select($query);
    return $result;
 }

 public function deleteMenu($delid)
 {
    $query = "DELETE FROM catagory WHERE cat_id = '$delid'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong> Data Delete Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Data Not Delete</div>";
        return $msg;
    }
 }

 public function AddMenuData($data)
 {
       $cat_id = $data['cat_id'];
       $day = $data['day'];
       $name = $data['name'];
       $price = $data['price'];
    if ($cat_id == "" || $day == "" || $name == "" || $price == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
        }else{
   $query = "INSERT INTO  menu(cat_id, day, name, price) VALUES('$cat_id','$day','$name','$price')";
       $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
       $msg = "<div class='alert alert-success'><strong>Success ! </strong> Insert Data Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Data Not Insert</div>";
        return $msg;
        }
    }
  }
 
 public function getMenuData()
 {
   $query = "SELECT menu.*, catagory.cname FROM menu INNER JOIN catagory ON menu.cat_id = catagory.cat_id ORDER BY menu.menu_id DESC";
    $result = $this->db->select($query);
    return $result;
 }

 public function deleteMMenu($delid)
 {
    $query = "DELETE FROM menu WHERE menu_id = '$delid'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong> Data Delete Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Data Not Delete</div>";
        return $msg;
    }
 }

  public function ActiveMMenu($active)
 {
   $query = "UPDATE menu SET status = '1' WHERE menu_id = '$active'";
    $update_row = $this->db->update($query);
    if ($update_row) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Inactive Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Not Inactive</div>";
        return $msg;
    }
 }

 public function UNActiveMMenu($unactive)
 {
   $query = "UPDATE menu SET status = '0' WHERE menu_id = '$unactive'";
    $update_row = $this->db->update($query);
    if ($update_row) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong> Active Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Not Active</div>";
        return $msg;
    }
 }
 
 public function AddCostData($data)
{
       $daily = $data['daily'];
       $details = $data['details'];
      
    if ($daily == "" || $details == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
        }else{
   $query = "INSERT INTO  bazer_cost(daily,details) VALUES('$daily','$details')";
       $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
       $msg = "<div class='alert alert-success'><strong>Success ! </strong>Cost Data Insert Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Cost Data Not Insert</div>";
        return $msg;
        }
    }
  }
  public function getCostData()
  {
   $query = "SELECT * FROM bazer_cost ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
  }
  public function getviewCost($costeditid)
  {
   $query = "SELECT * FROM bazer_cost WHERE id = '$costeditid'";
    $result = $this->db->select($query);
    return $result;
  }
  public function updateCostData($costeditid, $data)
  {
     $daily = $data['daily'];
       $details = $data['details'];
       if ($daily == "" || $details == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
        }else{
           $query = "UPDATE bazer_cost SET daily = '$daily', details = '$details' WHERE id = '$costeditid'";
      $update_row = $this->db->update($query);
    if ($update_row) {
     $msg = "<div class='alert alert-success'><strong>Success ! </strong>Cost Data Update Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Cost Data Not Update</div>";
        return $msg;
      }
    } 
  }
 public function getuserData()
 {
    $query = "SELECT * FROM user ORDER BY id DESC";
    $result = $this->db->select($query);
    return $result;
 }
public function deleteUser($delid)
{
  $query = "DELETE FROM user WHERE id = '$delid'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>User Delete Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>User Not Delete</div>";
        return $msg;
    }
 }

  public function ActiveUser($active)
 {
   $query = "UPDATE user SET status = '1' WHERE id = '$active'";
    $update_row = $this->db->update($query);
    if ($update_row) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Inactive Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Not Inactive</div>";
        return $msg;
    }
 }

 public function UNActiveUser($unactive)
 {
   $query = "UPDATE user SET status = '0' WHERE id = '$unactive'";
    $update_row = $this->db->update($query);
    if ($update_row) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong> Active Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Not Active</div>";
        return $msg;
    }
 }

}
?>