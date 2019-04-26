<?php
    session_start();
    if(isset($_SESSION['user'])){
    header("Location: user_panel.php");
}else{
    include './includes/common.php';
    include './includes/functions.php';
    $pageName = 'User Login';
    $messages = "";
if(isset($_POST['log_in'])){
    
        $password = $_POST['password'];
        $e_email = $_POST['email'];
        $e_password = md5($password);
        $user_info=check_user_info($e_email);
        
    if($user_info){
        
        if($user_info['s_status']==0){
            
            $messages = "Your account has been disabled.Please verify your email address.";
        }else{
            
        if(is_user($e_email,$e_password)){
            
            $user = is_user($e_email,$e_password);
            
            if(!empty($_POST['remember'])){
                
            setcookie("email",$e_email, time()+1 * 365 * 24 * 60 * 60); 
            setcookie("password",$password, time()+1 * 365 * 24 * 60 * 60);
            
            //setcookie("email","", time()-60); 
            //setcookie("password","", time()-60);
            
           
            }
            else{
                
                if(isset($_COOKIE['email'])){
                    setcookie('email','');
                      
               }
                 if(isset($_COOKIE['password'])){
                    setcookie('password','');
                    
                }
                
            }
         
            $_SESSION['user'] = $user;
            header("Location: user_panel.php");
            //echo "<meta http-equiv='refresh' content='.5;url=myaccount.php'>";
         
        }
        else{
            $messages = "No Match For Password.";
        }
    }
    }else{
        $messages = "No Match For User ID.";
    }
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
    
    <script src="assets/js/pace.js"></script>
    <link href="assets/css/animate_pace.css" rel="stylesheet" />

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
                      <div class="panel-heading text-center">
                        <h2><b>User Login</b></h2>
                      </div>
                      <div class="panel-body">
                      <?php 
                      if($messages){
                      ?>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger">
                                  <b><i class="fa fa-exclamation-circle"></i> <?php echo $messages; ?></b>
                              <button type="button" class="close" data-dismiss="alert">x</button>
                          </div>
                          </div>
                      </div>
                      <?php }?>
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                              <b class="text-primary">User ID</b>
                               <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                  <b><input type="text" name="email" value="<?php if(isset($_COOKIE["email"])){echo $_COOKIE["email"]; } ?>" class="form-control" placeholder="Your Employee ID Or Email" required=""/></b>
                              </div>
                              <b class="text-primary">Password</b>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                  <b><input type="password" name="password" value="<?php if(isset($_COOKIE["password"])){echo $_COOKIE["password"]; } ?>" class="form-control"  placeholder="Your Login Password" required=""/></b>
                              </div>
                              <div class="form-group">
                                      <label class="checkbox-inline">
                                          <input type="checkbox" name="remember" <?php if(isset($_COOKIE["email"])){?>
                                          checked <?php }  ?>/> <b class="text-primary">Remember me</b>
                                      </label>
<!--                                      <span class="pull-right">
                                          <a href="change_password.php" ><b>Forget password ?</b></a> 
                                      </span>-->
                                  </div>
                               <button type="submit" name="log_in" class="btn btn-primary btn-block"><i class="fa fa-key"></i> <b>Login Now</b></button>
                            </form>
                      </div>
                      <div class="panel-footer text-center">
                          <b class="text-info"><i class="fa fa-info-circle"></i> Not Register ?</b> <a href="user_registration.php"><span class="badge"><b>Click Here</b></span></a>
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
<?php } ?>
