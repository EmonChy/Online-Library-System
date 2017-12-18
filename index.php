<?php
include './functions.php';
$message="";
if(isset($_REQUEST['u_name'])){
     $s_name = $_REQUEST['u_name'];
     $s_id = $_REQUEST['u_id'];
     $s_email = $_REQUEST['u_email'];
     $s_mob = $_REQUEST['u_mob'];
     $s_pin = $_REQUEST['u_pin'];
     $s_amount = $_REQUEST['u_amount'];
     $s_dept = $_REQUEST['u_dept'];
     $_session = $_REQUEST['u_session'];
     
    $s_reg=student_registration($s_id,$s_name,$s_email,$s_mob,$s_pin,$s_amount,$s_dept,$_session);
    
    if($s_reg){
        $message= 'Insert Success' ;
    } else {
         $message= 'Insert Failed' ;
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>user registration form</title>
        <link rel="stylesheet" href="css/bootstrap.css"/>
      
        
    </head>
    <body style="background-color: brown">
        <form action="" method="post">
            <div class="container ">
                <div class="row">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-6  text-center ">
                        <div class="panel panel-default">
                            <div class=" panel-heading">
                                <h2> <b class="text-success text-center">USER FORM</b></h2>
                                <?php 
                                if($message){
                                    echo '<h1>'.$message.'</h1>';
                                }
                                ?>
                            </div>
                            <div class=" panel-body">
            <table class="table">
                <caption class="text-center text-primary"><h4><span style="font-family:verdana;font-weight: bold" >Student Registration</span></h4></caption>
                <tr>
                    <td class="text-right"> <b style="color: blue;font-family: monospace;" >User Name</b></td>
                    <td><input class="form-control focus" type="text" name="u_name" placeholder="enter your name" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;" >User ID </b></td>
                    <td><input class="form-control" type="text" name="u_id" placeholder="enter your id" required=""></td>
                </tr>
                
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Email </b></td>
                    <td><input class="form-control" type="email" name="u_email" placeholder="enter email" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Mobile </b></td>
                    <td><input class="form-control" type="text" name="u_mob"  maxlength="11" placeholder="enter your mob number" required=""/></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Pin code</b> </td>
                    <td><input class="form-control" type="password" name="u_pin" maxlength="4" placeholder="enter pin" required="" /></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Amount </b></td>
                    <td><input class="form-control" type="number" name="u_amount" min="0" max="50000" placeholder="enter amount" required=""></td>
                </tr>
                <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select session </b> </td>
                    <td><b><select class="form-control" name="u_session" required="" >
                                <option value="">plz choose session</option>
                                   <?php
                                   $all_sessions = get_all_sessions();
                                   foreach ($all_sessions as $sessions){?>
                                <option value="<?php echo $sessions['id']; ?>"> <?php echo $sessions['ses_duration']."(".$sessions['t_name'].")";?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                 <tr>
                     <td class="text-right"><b style="color: blue;font-family: monospace;">select dept </b></td>
                    <td><b><select class="form-control" name="u_dept" required="">
                            <option value="">plz choose dept</option>
                            <?php
                            $all_depts = get_all_departments();
                            foreach($all_depts as $depts){ ?>
                            <option value= " <?php echo $depts['id']; ?>"> <?php echo $depts['d_code']. "(" .$depts['d_name']. ")"; ?></option>
                            <?php } ?>
                            </select></b></td>
                </tr>
                
                
                <tr>
                    <td colspan="2" class="text-center">
                        <button class="btn btn-block btn-lg btn-primary"><b><i class="glyphicon glyphicon-barcode"></i> Registration</b></button>
                
                        <input class="btn btn-block btn-lg btn-danger" type="reset" value="Reset"></td>
                </tr>
                
            </table>
                            </div>
                            <div class=" panel-footer">
                                <b style="color: blue"><i class=" glyphicon glyphicon-log-in"></i> Forget Password ??? <a href="">Click Here</a></b>
                            </div>
                        </div>
        </form>
                   </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
    </body>
</html>
