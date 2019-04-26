<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    session_start();
    if(isset($_SESSION['employee'])){
    header("Location: cpanel.php");
}else{
    include './includes/common.php';
    include './includes/functions.php';
    $pageName = 'Forgot Password';
    $messages = "";




if(isset($_POST['email'])){
//    mysql_connect("localhost","root","");
//    mysql_select_db("reg");

    $email=$_REQUEST["email"]; 
    $query=mysql_query("select * from atw_employee where a_email='$email'");
    $count = mysql_num_rows($query);
    //echo $count;
    $row=mysql_fetch_array($query);
    
    $value = $row['a_email'];
        
    //addVal ($value);

    
          if($count>0)
          {

           require 'PHPMailer-master/src/Exception.php';
           require 'PHPMailer-master/src/PHPMailer.php';
           require 'PHPMailer-master/src/SMTP.php';
           
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'emonchy35@gmail.com';                 // SMTP username
                $mail->Password = 'Emon@@@3Chy';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('emonchy35@gmail.com', 'Emon');
                //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                $mail->addAddress($row['a_email']);                      // Name is optional
                $mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = "This is just testing";
                $mail->Body = "<i>this is your password:</i>".$row["a_password"];
                $mail->AltBody = "This is the plain text version of the email content";
                $mail->send();
                
                $messages= 'Your password has been sent to your email ID';
                //header('Location:forgot_password.php');
                //exit();

            } catch (Exception $e) {
                $messages = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
            }
                }
                else{
                    $messages= 'Email not found';
                    //echo "<script>swal('Email not found');</script>";
                   // echo "<script>alert('Email not found');</script>";
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
    
    <link href=" https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>

    <script src="assets/js/pace.js"></script>
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style type="text/css">
.pace {
  width: 140px;
  height: 300px;
  position: fixed;
  top: -90px;
  right: -20px;
  z-index: 2000;
  -webkit-transform: scale(0);
  -moz-transform: scale(0);
  -ms-transform: scale(0);
  -o-transform: scale(0);
  transform: scale(0);
  opacity: 0;
  -webkit-transition: all 2s linear 0s;
  -moz-transition: all 2s linear 0s;
  transition: all 2s linear 0s;
}

.pace.pace-active {
  -webkit-transform: scale(.25);
  -moz-transform: scale(.25);
  -ms-transform: scale(.25);
  -o-transform: scale(.25);
  transform: scale(.25);
  opacity: 1;
}

.pace .pace-activity {
  width: 140px;
  height: 140px;
  border-radius: 70px;
  background: whitesmoke;
  position: absolute;
  top: 0;
  z-index: 1911;
  -webkit-animation: pace-bounce 1s infinite;
  -moz-animation: pace-bounce 1s infinite;
  -o-animation: pace-bounce 1s infinite;
  -ms-animation: pace-bounce 1s infinite;
  animation: pace-bounce 1s infinite;
}

.pace .pace-progress {
  position: absolute;
  display: block;
  left: 50%;
  bottom: 0;
  z-index: 1910;
  margin-left: -30px;
  width: 60px;
  height: 75px;
  background: rgba(20, 20, 20, .1);
  box-shadow: 0 0 20px 35px rgba(20, 20, 20, .1);
  border-radius: 30px / 40px;
  -webkit-transform: scaleY(.3) !important;
  -moz-transform: scaleY(.3) !important;
  -ms-transform: scaleY(.3) !important;
  -o-transform: scaleY(.3) !important;
  transform: scaleY(.3) !important;
  -webkit-animation: pace-compress .5s infinite alternate;
  -moz-animation: pace-compress .5s infinite alternate;
  -o-animation: pace-compress .5s infinite alternate;
  -ms-animation: pace-compress .5s infinite alternate;
  animation: pace-compress .5s infinite alternate;
}

@-webkit-keyframes pace-bounce {
  0% {
    top: 0;
    -webkit-animation-timing-function: ease-in;
  }
  40% {}
  50% {
    top: 140px;
    height: 140px;
    -webkit-animation-timing-function: ease-out;
  }
  55% {
    top: 160px;
    height: 120px;
    border-radius: 70px / 60px;
    -webkit-animation-timing-function: ease-in;
  }
  65% {
    top: 120px;
    height: 140px;
    border-radius: 70px;
    -webkit-animation-timing-function: ease-out;
  }
  95% {
    top: 0;
    -webkit-animation-timing-function: ease-in;
  }
  100% {
    top: 0;
    -webkit-animation-timing-function: ease-in;
  }
}

@-moz-keyframes pace-bounce {
  0% {
    top: 0;
    -moz-animation-timing-function: ease-in;
  }
  40% {}
  50% {
    top: 140px;
    height: 140px;
    -moz-animation-timing-function: ease-out;
  }
  55% {
    top: 160px;
    height: 120px;
    border-radius: 70px / 60px;
    -moz-animation-timing-function: ease-in;
  }
  65% {
    top: 120px;
    height: 140px;
    border-radius: 70px;
    -moz-animation-timing-function: ease-out;}
  95% {
    top: 0;
    -moz-animation-timing-function: ease-in;
  }
  100% {top: 0;
    -moz-animation-timing-function: ease-in;
  }
}

@keyframes pace-bounce {
  0% {
    top: 0;
    animation-timing-function: ease-in;
  }
  50% {
    top: 140px;
    height: 140px;
    animation-timing-function: ease-out;
  }
  55% {
    top: 160px;
    height: 120px;
    border-radius: 70px / 60px;
    animation-timing-function: ease-in;
  }
  65% {
    top: 120px;
    height: 140px;
    border-radius: 70px;
    animation-timing-function: ease-out;
  }
  95% {
    top: 0;
    animation-timing-function: ease-in;
  }
  100% {
    top: 0;
    animation-timing-function: ease-in;
  }
}

@-webkit-keyframes pace-compress {
  0% {
    bottom: 0;
    margin-left: -30px;
    width: 60px;
    height: 75px;
    background: rgba(20, 20, 20, .1);
    box-shadow: 0 0 20px 35px rgba(20, 20, 20, .1);
    border-radius: 30px / 40px;
    -webkit-animation-timing-function: ease-in;
  }
  100% {
    bottom: 30px;
    margin-left: -10px;
    width: 20px;
    height: 5px;
    background: whitesmoke;
    box-shadow: 0 0 20px 35px rgba(20, 20, 20, .3);
    border-radius: 20px / 20px;
    -webkit-animation-timing-function: ease-out;
  }
}

@-moz-keyframes pace-compress {
  0% {
    bottom: 0;
    margin-left: -30px;
    width: 60px;
    height: 75px;
    background: rgba(20, 20, 20, .1);
    box-shadow: 0 0 20px 35px rgba(20, 20, 20, .1);
    border-radius: 30px / 40px;
    -moz-animation-timing-function: ease-in;
  }
  100% {
    bottom: 30px;
    margin-left: -10px;
    width: 20px;
    height: 5px;
    background: rgba(20, 20, 20, .3);
    box-shadow: 0 0 20px 35px rgba(20, 20, 20, .3);
    border-radius: 20px / 20px;
    -moz-animation-timing-function: ease-out;
  }
}

@keyframes pace-compress {
  0% {
    bottom: 0;
    margin-left: -30px;
    width: 60px;
    height: 75px;
    background: rgba(20, 20, 20, .1);
    box-shadow: 0 0 20px 35px rgba(20, 20, 20, .1);
    border-radius: 30px / 40px;
    animation-timing-function: ease-in;
  }
  100% {
    bottom: 30px;
    margin-left: -10px;
    width: 20px;
    height: 5px;
    background: rgba(20, 20, 20, .3);
    box-shadow: 0 0 20px 35px rgba(20, 20, 20, .3);
    border-radius: 20px / 20px;
    animation-timing-function: ease-out;
  }
}


   </style>

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
                        <h2><b>Forgot Password</b></h2>
                        
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
                      </div>
                      <div class="panel-body">
                      
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                              <b class="text-primary">Enter Your Email</b>
                               <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                  <b><input type="text" name="email" id="uemail" value="" class="form-control" placeholder="Your Email" required=""/></b>
                              </div>
                              <div id="val"></div>
                             
                              <div class="form-group">
                                      
                                      <span class="pull-right">
                                          <a href="login.php" ><b>Back</b></a> 
                                      </span>
                                  </div>
                              <button type="submit" name="submit" onclick="//validation();" class="btn btn-primary btn-block"><i class="fa fa-key"></i> <b>Submit</b></button>
                            </form>
                      </div>
                  </div>
              </div>     
        </div>
        <hr />
        <?php include './footer.php'; ?>
    </div>
        
<script type="text/javascript">
            
//        
//        function validation(){
//
//            
//              var email = $value;  
//              var uemail = document.getElementById('uemail').value;
//              
//                if(email=== uemail){
//               swal("Done!", "Your password has been sent to your email ID", "success");
//           }
//            
//           //swal("Your password has been sent to your email ID");   
//           else{
//               swal("not found");
//           }    
//         
//     }
//         
    
        </script>
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
