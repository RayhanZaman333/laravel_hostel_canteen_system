<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
//Session::init();
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
class Process{	
       private $db; 
       private $fm; 

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	} 
   public function AddTripData($data) {
       $bus = $data['bus_number'];
       $toda = $data['tdate'];
       $Stim = $data['stime'];
       $Spla = $data['splace'];
       $ETim = $data['etime'];
       $EPla = $data['eplace'];     
       $Rat = $data['rate'];
       $Pass = $data['passenger'];
       $Amo = $Rat*$Pass;

        if ($bus == "" || $toda == "" || $Stim == "" || $Spla == "" || $ETim == "" || $EPla == "" || $Rat == "" || $Pass == "" || $Amo == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
    }elseif(!preg_match("/^[a-zA-Z ]*$/", $Spla)){
        $msg = "<div class='alert alert-danger'><strong>Error !Starting Place not Correct..!</strong> </div>";
        return $msg;
        }elseif(!preg_match("/^[a-zA-Z ]*$/", $EPla)){
        $msg = "<div class='alert alert-danger'><strong>Error !Ending Place not Correct..!</strong> </div>";
        return $msg;
      }elseif($Rat < 180){
      $msg = "<div class='alert alert-danger'><strong>Error !Sorry Ticket Rate is Rising </strong> </div>";
        return $msg;
      }elseif($Pass > 40){
      $msg = "<div class='alert alert-danger'><strong>Error !Passenger Sit Is Limited </strong> </div>";
        return $msg;
      }else{
      $query = "INSERT INTO  tbl_trip(bus_number, tdate, stime, splace, etime, eplace, rate, passenger, amount) VALUES('$bus','$toda','$Stim', '$Spla','$ETim', '$EPla', '$Rat', '$Pass', '$Amo')";
       $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
         $msg = "<div class='alert alert-success'><strong>Success ! </strong>Trips Data insert Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Trips Data Not insert</div>";
        return $msg;
        }
      }
    }

 public function getTripData() {
   $query = "SELECT tbl_trip.*, tbl_busi.name, tbl_busi.bus_number FROM tbl_trip INNER JOIN tbl_busi ON tbl_trip.bus_number = tbl_busi.bus_id ORDER By tbl_trip.trip_id DESC";  
      $result = $this->db->select($query);
      return $result;
 }

 public function getviewTrip($treditid) {
   $query = "SELECT * FROM tbl_trip WHERE trip_id = '$treditid'";
    $result = $this->db->select($query);
    return $result;
 }

 public function updateTripData($treditid, $data) {
       $bus = $data['bus_number'];
       $toda = $data['tdate'];
       $Stim = $data['stime'];
       $Spla = $data['splace'];
       $ETim = $data['etime'];
       $EPla = $data['eplace'];     
       $Rat = $data['rate'];
       $Pass = $data['passenger'];
       $Amo = $Rat*$Pass;
 if ($bus == "" || $toda == "" || $Stim == "" || $Spla == "" || $ETim == "" || $EPla == "" || $Rat == "" || $Pass == "" || $Amo == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
      }elseif(!preg_match("/^[a-zA-Z ]*$/", $Spla)){
        $msg = "<div class='alert alert-danger'><strong>Error !Starting Place not Correct..!</strong> </div>";
        return $msg;
        }elseif(!preg_match("/^[a-zA-Z ]*$/", $EPla)){
        $msg = "<div class='alert alert-danger'><strong>Error !Ending Place not Correct..!</strong> </div>";
        return $msg;
    }elseif($Rat < 180){
      $msg = "<div class='alert alert-danger'><strong>Error !Sorry Ticket Rate is 180 Rising </strong> </div>";
        return $msg;
      }elseif($Pass > 40){
      $msg = "<div class='alert alert-danger'><strong>Error !Passenger Sit Is Limited 40 </strong> </div>";
        return $msg;
      }else{
      $query = "UPDATE tbl_trip SET bus_number = '$bus', tdate = '$toda', stime = '$Stim', splace = '$Spla', etime = '$ETim', eplace = '$EPla', rate = '$Rat', passenger = '$Pass', amount = '$Amo' WHERE trip_id = '$treditid'";
      $update_row = $this->db->update($query);
    if ($update_row) {
     $msg = "<div class='alert alert-success'><strong>Success ! </strong>Trips Data Update Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Trips Data Not Update</div>";
        return $msg;
      }
    } 
  } 
 
 public function deleteTRIP($delid) {
    $query = "DELETE FROM tbl_trip WHERE trip_id = '$delid'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Trips Data Delete Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Trips Data Not Delete</div>";
        return $msg;
    }
 }

 public function AddSalaryData($data) {
       $sname = $data['name'];
       $smonth = $data['month'];
       $esalary = $data['salary'];
       $eno_leave = $data['no_leave'];
       $eleave_detection = $esalary/30*$eno_leave;
       $epf_detection = $esalary/30*$eno_leave*0.2;     
       $eesi_detection = $esalary/30*$eno_leave*0.3;
       $ebalance = $esalary-$eleave_detection-$epf_detection-$eesi_detection;
          
          if ($esalary <=0) {
            $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry! Salary can not do this. </div>";
        return $msg;
          }
       elseif ($eno_leave <=0 || $eno_leave > 7) {
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Apply Leave Day One To Seven !</div>";
        return $msg;
       }elseif ($sname == "" || $smonth == "" || $esalary == "" || $eno_leave == "" || $eleave_detection == "" || $epf_detection == "" || $eesi_detection == "" || $ebalance == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
      }else{
      $query = "INSERT INTO  tbl_salary(name, month, salary, no_leave, leave_detection, pf_detection, esi_detection, balance) VALUES('$sname','$smonth','$esalary', '$eno_leave','$eleave_detection', '$epf_detection', '$eesi_detection', '$ebalance')";
       $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
         $msg = "<div class='alert alert-success'><strong>Success ! </strong>Salary Data insert Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Salary Data Not insert</div>";
        return $msg;
        }
      }
    }

 public function getSalaryData() {
   $query = "SELECT * FROM tbl_salary ORDER BY sa_id DESC";
    $result = $this->db->select($query);
    return $result;
 }

 public function getviewSalary($Saleditid) {
   $query = "SELECT * FROM tbl_salary WHERE sa_id = '$Saleditid'";
    $result = $this->db->select($query);
    return $result;
 }
 
 public function updateSalaryData($Saleditid, $data) {
    $sname = $data['name'];
       $smonth = $data['month'];
       $esalary = $data['salary'];
       $eno_leave = $data['no_leave'];
       $eleave_detection = $esalary/30*$eno_leave;
       $epf_detection = $esalary/30*$eno_leave*0.2;     
       $eesi_detection = $esalary/30*$eno_leave*0.3;
       $ebalance = $esalary-$eleave_detection-$epf_detection-$eesi_detection;
          
          if ($esalary <=0) {
            $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry! Salary can not do this. </div>";
        return $msg;
          }
       elseif ($eno_leave <=0 || $eno_leave > 7) {
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Apply Leave Day One To Seven !</div>";
        return $msg;
       }elseif ($sname == "" || $smonth == "" || $esalary == "" || $eno_leave == "" || $eleave_detection == "" || $epf_detection == "" || $eesi_detection == "" || $ebalance == "") {
        $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be Empty </div>";
        return $msg;
      }else{
        $query = "UPDATE tbl_salary SET name = '$sname', month = '$smonth', salary = '$esalary', no_leave = '$eno_leave', leave_detection = '$eleave_detection', pf_detection = '$epf_detection', esi_detection = '$eesi_detection', balance = '$ebalance' WHERE sa_id = '$Saleditid'";
      $update_row = $this->db->update($query);
    if ($update_row) {
     $msg = "<div class='alert alert-success'><strong>Success ! </strong>Salary Data Update Successfully </div>";
        return $msg;
    }else{
           $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Salary Data Not Update</div>";
        return $msg;
      }
    } 
  } 

 public function deleteSalary($delid) {
   $query = "DELETE FROM tbl_salary WHERE sa_id = '$delid'";
  $deldata = $this->db->delete($query);
  if ($deldata) {
    $msg = "<div class='alert alert-success'><strong>Success ! </strong>Salary Data Delete Successfully </div>";
        return $msg;
      }else{
         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Salary Data Not Delete</div>";
        return $msg;
    }
 }


}
?>