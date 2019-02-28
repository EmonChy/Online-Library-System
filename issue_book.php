<?php
include './functions.php';
$message="";
if(isset($_GET['book_id'])){
    $book_id = $_GET['book_id'];
    $std_id = $_GET['std_id'];
   // $std_book_info = check_std_id_book_code($book_id,$std_id);
    $book_code = check_book($book_id);
    $student_id = check_std($std_id);
    if(isset($book_code) && isset($student_id)){
          $issue = book_issue($book_code['id'],$student_id['id']);
    
    if($issue){
        $message="book issued";
    }
    else{
        $message = "not issued";
        }
    }
    else{
        echo 'login failed';
    }
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>user registration form</title>
      <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/font-awesome.css"/>   
    </head>
    <body style="background-color: wheat">
        <form action="" method="get">
            <div class="container ">
                <div class="row">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-6  text-center ">
                        <div class="panel panel-default">
                            <div class=" panel-heading">
                                
                               
                            </div>
                            <div class=" panel-body">
            <table class="table">
                <caption class="text-center text-primary"><h4><span style="font-family:verdana;font-weight: bold" >issue book</span></h4></caption>
                <tr>
                    <td class="text-right"> <b style="color: blue;font-family: monospace;" >Book code:</b></td>
                    <td><input class="form-control " type="text" name="book_id" placeholder="enter your book code" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;" >Student id: </b></td>
                    <td><input class="form-control" type="text" name="std_id" placeholder="enter your id" required=""></td>
                </tr>
              
                
                
                <tr>
                    <td colspan="2" class="text-center">
                        <button class="btn btn-block btn-lg btn-primary"><b><i class="fa fa-registered" aria-hidden="true"></i>
 issue</b></button>
                
                      
                </tr>
                
            </table>
                            </div>
                            <div class=" panel-footer">
                                <b style="color: blue"><i class="fa fa-sign-in" aria-hidden="true"></i>
Forget Password ??? <a href="">Click Here</a></b>
                            </div>
                        </div>
                          <center>
                        <?php
                        if($message){
                            echo '<b>'.$message.'</b>';
                        }
                        
                        ?> </center>
       
                   </div>
                     </form>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
    </body>
</html>

