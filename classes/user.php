<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/Format.php');
class User{	
       private $db;
       private $fm;
      
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}



  public function AdduserData($data){
       $name = $data['name'];
       $email = $data['email'];
       $roll = $data['roll'];
       $depart = $data['depart'];
       $password = md5($data['password']);
       $role_type = $data['role_type'];     
       $user_type = $data['user_type'];

      if ($name == "" || $email == "" || $roll == "" || $depart == "" || $password == "" || $role_type == "" || $user_type == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
        }else{
   $query = "INSERT INTO  user(name, email, roll, depart, password, role_type, user_type) VALUES('$name','$email','$roll','$depart', '$password','$role_type', '$user_type')";
       $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
         header('location:home.php');
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>User Not insert</div>";
        return $msg;
        }
    }
  }

  public function userLogin($email, $password) {
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);
        $email     = mysqli_real_escape_string($this->db->link, $email);
        
        if ($email == "" || $password == "") {
        echo "empty";
        exit();  
       }else{
        $password = mysqli_real_escape_string($this->db->link, md5($password));
        if('USER' == $_POST['controlvalue']){
              $query = "SELECT * FROM user WHERE email ='$email' AND password ='$password'";
              $result = $this->db->select($query);
              if ($result != false) {
                $value = $result->fetch_assoc();
                if ($value['status'] == '1') {
                 echo "disable";
                   exit();
                }else{
                  Session::init();
                  Session::set("userLogin", true);
                  Session::set("name", $value['name']);
                  Session::set("id", $value['id']);
                  header("location:home.php");
                }
              }else{
                 echo "<div class='alert alert-danger'><strong>Error ! </strong>User Email & Password Not Matched !</div>";
               }
            }
         }
      }

  public function getUserData($user_id)
  {
    $query = "SELECT * FROM user WHERE id = '$user_id'";
    $result = $this->db->select($query);
    return $result;
  }
 

  private function checkPassword($drir_id, $old_pass)  {
       $password = md5($old_pass);
        $sql = "SELECT password FROM user WHERE id = '$drir_id' AND password = '$password'";
        $result = $this->db->select($sql);
            return $result;
  }

   public function updatepassword($drir_id, $data) {
         $old_pass = $data['old_pass'];
         $new_pass = $data['password'];
         $new_passConfirm = $data['new_password'];
         $chk_pass = $this->checkPassword($drir_id, $old_pass);
         if ($old_pass == "" OR $new_pass == "" OR $new_passConfirm == "") {
          $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry,Field Must not be Empty </div>";
          return $msg;
         }
      if ($chk_pass == false) {
          $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry,Old Password not Exist </div>";
         return $msg;
           }
    if (strlen($new_pass) <4) {
      $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry,Password too short </div>";
      return $msg;
      }else if($new_pass !== $new_passConfirm){
      $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry,Password does not match !.. </div>";
      return $msg;
      }else{
      $new_pass = md5($new_pass);      
      $sql = "UPDATE user set password = '$new_pass' WHERE id = '$drir_id'";
           $update_row = $this->db->update($sql);
          if ($update_row) {
         $msg = "<div class='alert alert-success'><strong>Success ! </strong>Thank you, Password update Successfully</div>";
          return $msg;
         }else{
          $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry,Password update not Successfully </div>";
        return $msg;
         }
       }
    }   
  public function getUsersData($drer_id)
  {
   $query = "SELECT * FROM user WHERE id = '$drer_id'";
    $result = $this->db->select($query);
    return $result;
  }
   

    public function updateprofile($drer_id, $data)  {
       $name = $data['name'];
       $email = $data['email'];
       $roll = $data['roll'];
       $depart = $data['depart'];
       $role_type = $data['role_type'];
       $user_type = $data['user_type'];

       if ($name == "" || $email == "" || $roll == "" || $depart == "" || $role_type == "" || $user_type == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
        }else{
   $query = "UPDATE user SET name = '$name', email = '$email', roll = '$roll', depart = '$depart', role_type = '$role_type', user_type = '$user_type' WHERE id = '$drer_id'";
      $update_row = $this->db->update($query);
    if ($update_row) {
     $msg = "<div class='alert alert-success'><strong>Success ! </strong>Profile Update Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Profile Not Update</div>";
        return $msg;
      }
    } 
  }
  public function menuorder($foodM)
  {
    $query = "SELECT m.*, c.cname FROM 
      menu as m, catagory as c
       WHERE m.cat_id = c.cat_id AND m.menu_id = '$foodM'";
    $result = $this->db->select($query);
    return $result;
  }
 public function AddTOBCart($queanty, $foodM)
  {
    $queanty = $this->fm->validation($queanty);
    $queanty = mysqli_real_escape_string($this->db->link, $queanty);
    $menuid = mysqli_real_escape_string($this->db->link, $foodM);
    $sid = session_id();

    $squery = "SELECT * FROM menu WHERE menu_id = '$menuid'";
    $result = $this->db->select($squery)->fetch_assoc();
     
     $day = $result['day'];
     $name = $result['name'];
     $price = $result['price'];
 
        $Chquery = "SELECT * FROM cart WHERE menu_id = '$menuid' AND sid = '$sid'";
         $getpro = $this->db->select($Chquery);
         if ($getpro) {
          $msg = "Already Added !";
          return $msg;
         }else{
      $query = "INSERT INTO cart(sid, menu_id, day, menu, rate, queanty) VALUES('$sid', '$menuid', '$day', '$name', '$price', '$queanty')";
        $cartinsert = $this->db->insert($query);
    if ($cartinsert) {
      header("location:cart.php");
    }else{
              header("location:404.php");
    }
     }
  } 

  public function Getcart()
  {
    $sid = session_id();
    $query = "SELECT * FROM cart WHERE sid = '$sid'";
    $result = $this->db->select($query);
    return $result;
  }
public function UpdateCart($cartid, $queanty)
{
  $cartid  = mysqli_real_escape_string($this->db->link, $cartid);
  $queanty = mysqli_real_escape_string($this->db->link, $queanty);

  $query = "UPDATE cart SET queanty = '$queanty' WHERE id = '$cartid'";
        $CartUpdate = $this->db->update($query);
    if ($CartUpdate) {
      header("location:cart.php");
    }else{
              $msg = "<span class='error'>Quantity Not Update</span>";
        return $msg;
    }
}
 public function delcaRTPro($delid) {
    $query = "DELETE FROM cart WHERE id = '$delid'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    echo "<script>window.location = 'cart.php';</script>";
      }else{
              echo "<script>window.location = '404.php';</script>";
    }
  }

public function deluserprocart() {
  $sid = session_id();
  $query = "DELETE FROM cart WHERE sid = '$sid'";
   $this->db->delete($query);
 }

public function orderproduct($useid)
{
  $sid = session_id();
    $query = "SELECT * FROM cart WHERE sid = '$sid'";
    $getpro = $this->db->select($query);
     if ($getpro) {
       while ($result = $getpro->fetch_assoc()) {
           $menuid = $result['menu_id'];
            $day = $result['day'];
             $menu = $result['menu'];
             $quanty = $result['queanty'];             
             $price = $result['rate'] * $quanty;

               $query = "INSERT INTO tbl_order(us_id, menu_id, day, name, queanty, price) VALUES('$useid', '$menuid', '$day', '$menu', '$quanty', '$price')";
        $insertor = $this->db->insert($query);
        
       }

     }
}

public function GetOrderProduct($useid)
{
  $query = "SELECT * FROM tbl_order WHERE us_id = '$useid' ORDER BY date DESC";
    $result = $this->db->select($query);
    return $result;
}
public function productconfirmShift($idshift, $date)
{
   $idshift  = mysqli_real_escape_string($this->db->link, $idshift);
   $date  = mysqli_real_escape_string($this->db->link, $date);
    $query = "UPDATE tbl_order SET status = '1' WHERE us_id = '$idshift' AND date='$date'";
        $shipUpdate = $this->db->update($query);
    if ($shipUpdate) {
      $msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Not Update</div>";
        return $msg;
      }
}

public function GetViewProduct()
{
  $query = "SELECT * FROM tbl_order ORDER BY date DESC";
    $result = $this->db->select($query);
    return $result;
}

 public function productShifted($idshift, $date) {
   $idshift  = mysqli_real_escape_string($this->db->link, $idshift);
   $date  = mysqli_real_escape_string($this->db->link, $date);
    $query = "UPDATE tbl_order SET status = '1' WHERE us_id = '$idshift' AND date='$date'";
        $shipUpdate = $this->db->update($query);
    if ($shipUpdate) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Update Not Successfully</div>";
        return $msg;
      }
 }

 public function productDelShifted($idshift, $date) {
    $idshift  = mysqli_real_escape_string($this->db->link, $idshift);
   $date  = mysqli_real_escape_string($this->db->link, $date);
   $query = "DELETE FROM tbl_order WHERE us_id = '$idshift' AND date='$date'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Delete Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Not Delete</div>";
        return $msg;
      }
  }
 
 




 }  
?>