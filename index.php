<?php
session_start();
include './functions.php';
$msg = "";
if(!isset($_SESSION['student'])){
if(isset($_POST['sid'])){
    $sid = $_POST['sid'];
    $spass = $_POST['spass'];
    $std_info = check_function($sid,$spass);
    if($std_info){
        $_SESSION['student'] = $std_info;
        header('Location:student_info.php');
       
        
    } 
    else{
        $msg= 'login failed';
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>user registration form</title>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
         <style>
             body{
                 margin-top: 170px;
             }
         </style>
    </head>
    <body>
        
        <form action="" method="post">
            <div class="container ">
                <div class="row">
                   
                    <div class="col-md-4 col-md-offset-4  " >
                        <div class="panel panel-info text-center">
                            <div class=" panel-heading">
                                <h2> <b class="text-success">Student Login</b></h2>
                                
                            </div>
                            <div class=" panel-body">
            <table class="table table-striped">
                                <tr>
                    <td class="text-right"> <b style="color: red;font-family: cursive;" >User id:</b></td>
                    <td><input class="form-control focus" type="text" name="sid" placeholder="enter your id" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: red;font-family: cursive;" >User password: </b></td>
                    <td><input class="form-control" type="password" name="spass" placeholder="enter your pass" required=""></td>
                </tr>
                
               
                
                <tr>
                    <td colspan="2" class="text-center">
                        <button class="btn btn-block btn-lg btn-primary"><b><i class="fa fa-sign-in" aria-hidden="true"></i>
 LOG IN</b></button>
                
                      </td>
                </tr>
                
            </table>
                            </div>
                          
                        </div>
                        <center>
                        <?php
                        if($msg){
                            echo '<b>'.$msg.'</b>';
                        }
                        
                        ?> </center>
       
                   </div>   
                </div>
            </div>
           
        </form>
 
    </body>
    
</html>
<?php
}
else{
           header('Location:student_info.php');
 
}
?>