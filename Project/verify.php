<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include './includes/common.php';
include './includes/functions.php';

$message='';
date_default_timezone_set("Asia/Dhaka"); 
if(isset($_GET['vkey'])){
    $s_vkey = $_GET['vkey'];
    
    $result = mysql_query("SELECT * FROM libsys_students WHERE s_vkey='".$s_vkey."' AND s_status = 0 LIMIT 1");

    $count = mysql_num_rows($result);
    if($count>0){
        
            $update = mysql_query("UPDATE libsys_students SET s_status = 1 WHERE s_vkey  ='".$s_vkey."' LIMIT 1");
         if($update){
             
             $message =  'Your account has been verified,you may log in';
             //header('Location:login.php');
         }
         else{
            $message =  'not verified';
         }
    }
    else{
         
        $message =  'This account invalid or already verified';
    }
    
}
else{
    die('something went wrong');
}


?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $WebsiteSiteName.'-'.$pageName; ?></title>
    <link rel="shortcut icon" href="favicon.ico">
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
    <body class="bg-color-brown">
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br/>
                <h1><b><?php echo $WebsiteSiteName; ?></b></h1>
                <hr />
            </div>
        </div>
        
         <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                  <div class="panel panel-default">
                     
                      <div class="panel-body">
                      <?php 
                      if($message){
                      ?>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger">
                                  <b><i class="fa fa-exclamation-circle"></i> <?php echo $message; ?></b>
                              <button type="button" class="close" data-dismiss="alert">x</button>
                          </div>
                          </div>
                      </div>
                      <?php }?>
                            
                      </div>
                      <div class="panel-footer text-center">
                          <b class="text-info"><i class="fa fa-info-circle"></i>&nbsp;Go to login</b> <a href="user_login.php"><span class="badge"><b>Click Here</b></span></a>
                      </div>
                  </div>
              </div>     
        </div>
        <hr />
        <?php include './footer.php'; ?>
    </div>
     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>



       
            
    







