<?php 
   include_once ("../lib/Session.php");
    Session::checkAdminSession();
    include_once ("../lib/database.php");
    include_once ("../helpers/Format.php");
    
    spl_autoload_register(function($class){
    include_once "../classes/".$class.".php";
 });
        $db  = new Database();
        $fm  = new Format();
        $ad = new Admin();
        $user = new user();
        $Pd = new Process();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Baiust canteen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
   <?php
       if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
        header("Location:../index.php");
        exit();
       }
       ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo"> Admin</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"></span>
      </a>
       </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-bus"></i>
            <span>Add Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addcat.php"><i class="fa fa-circle-o"></i> Add Category </a></li>
            <li><a href="catlist.php"><i class="fa fa-circle-o"></i> Category List </a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-bus"></i>
            <span>Menu List</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addmenu.php"><i class="fa fa-circle-o"></i> Add menu </a></li>
            <li><a href="menulist.php"><i class="fa fa-circle-o"></i> menu List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Bazer Cost</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addcost.php"><i class="fa fa-circle-o"></i> Add Cost</a></li>
            <li><a href="costlist.php"><i class="fa fa-circle-o"></i> Cost List</a></li>
          </ul>
        </li>
         <li><a href="inbox.php"><i class="fa fa-user"></i> <span>Order Details</span></a></li>
        <li><a href="user.php"><i class="fa fa-user"></i> <span>User</span></a></li>

         
       
       <li><a href="?action=logout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
      </ul>
    </section>
     </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">