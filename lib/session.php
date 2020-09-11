<?php
class Session{
	 public static function init(){
	 	session_start();
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }
      
       public static function checkAdminSession(){
	 	self::init();
	 	if (self::get("adminLogin") == false) {
	 		self::destroy();
	 		header("location:../index.php");
	 	}
	 }

	  public static function checkAdminLogin(){
	 	self::init();
	 	if (self::get("adminLogin") == true) {
	 		header("Location:index.php");
	 	}
	 }

	 public static function checkUserSession(){
	 	self::init();
	 	if (self::get("userLogin") == false) {
	 		self::destroy();
	 		header("location:index.php");
	 	}
	 }

	 public static function checkdriverLogin(){
	 	if (self::get("userLogin") == true) {
	 		header("Location:home.php");
	 	}
	 }

	 public static function destroy(){
	 	session_destroy();
	 	session_unset();
	 }
}

?>