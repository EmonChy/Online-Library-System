
<?php
include './functions.php';
$message="";
if(isset($_POST['updt_id'])){
    $std_updt = $_POST['updt_id'];  
    
}

if(isset($_REQUEST['u_name'])){
    $std_updt = $_REQUEST['updt_id'];
     $s_name = $_REQUEST['u_name'];
     $s_id = $_REQUEST['u_id'];
     $s_email = $_REQUEST['u_email'];
     $s_mob = $_REQUEST['u_mob'];
     $s_pin = $_REQUEST['u_pin'];
     $s_amount = $_REQUEST['u_amount'];
     $s_dept = $_REQUEST['u_dept'];
     $_session = $_REQUEST['u_session'];
     $s_reg= edit($s_name,$s_id,$s_email,$s_mob,$std_updt);
    //$s_reg=student_registration($s_id,$s_name,$s_email,$s_mob,$s_pin,$s_amount,$s_dept,$_session);
    
    if($s_reg){
        $message= 'update Success' ;
    } else {
         $message= 'update Failed' ;
    }
}

   $std_update = get_student_info_by_id($std_updt); 
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>user registration form</title>
      <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/font-awesome.css"/>   
    </head>
    <body style="background-color: ">
        <form action="" method="post">
            <input type="hidden" value="<?php echo $std_update['id']; ?>" name="updt_id"/>
            <div class="container ">
                <div class="row">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-6  text-center ">
                        <div class="panel panel-default">
                            
                            <div class=" panel-heading">
                                <a href="student_list.php"> Back to</a>
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
                    <td><input class="form-control " type="text" name="u_name" value="<?php echo $std_update['u_name']; ?>" placeholder="enter your name" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;" >User ID </b></td>
                    <td><input class="form-control" type="text" name="u_id" value="<?php echo $std_update['u_id']; ?>" placeholder="enter your id" required=""></td>
                </tr>
                
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Email </b></td>
                    <td><input class="form-control" type="email" name="u_email" value="<?php echo $std_update['u_email']; ?>" placeholder="enter email" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Mobile </b></td>
                    <td><input class="form-control" type="text" name="u_mob"  maxlength="11" value="<?php echo $std_update['u_mob']; ?>" placeholder="enter your mob number" required=""/></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Pin code</b> </td>
                    <td><input class="form-control" type="password" name="u_pin" maxlength="4" value="<?php echo $std_update['u_pin']; ?>" placeholder="enter pin" required="" /></td>
                </tr>
               <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Amount </b></td>
                    <td><input class="form-control" type="text" name="u_amount" maxlength="5000"  value="<?php echo $std_update['u_amount']; ?>" placeholder="enter amount" required=""/></td>
                </tr> 
                
                 <tr>
                     <td class="text-right"><b style="color: blue;font-family: monospace;">select dept </b></td>
                    <td><b><select class="form-control" name="u_dept" required="">
                            <option value="">plz choose dept</option>
                            <?php
                            $all_depts = get_all_departments();
                            foreach($all_depts as $depts){ ?>
                            <option value= " <?php echo $depts['id']; ?>" <?php if($depts['id']==$std_update['u_dept']){echo 'selected';}?>> <?php echo $depts['d_code']."(".$depts['d_name'].")"; ?></option>
                            <?php } ?>
                            </select></b></td>
                </tr>
                <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select session </b> </td>
                    <td><b><select class="form-control" name="u_session" required="" >
                                <option value="">plz choose session</option>
                                   <?php
                                   $all_sessions = get_all_sessions();
                                   foreach ($all_sessions as $sessions){?>
                                <option value="<?php echo $sessions['id']; ?>" <?php if($sessions['id']==$std_update['u_session']){echo 'selected';}?>> <?php echo $sessions['ses_duration']."(".$sessions['t_name'].")";?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                  <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select semister </b> </td>
                    <td><b><select class="form-control" name="u_sem" required="" >
                                <option value="">plz choose semester</option>
                                   <?php
                                   $all_semister =  get_all_semister();

                                   foreach ($all_semister as $semester){?>
                                <option value="<?php echo $semester['id']; ?>"  <?php if($semester['id']==$std_update['u_sem']){echo 'selected';}?>> <?php echo $semester['sem_name'];?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                  <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select session </b> </td>
                    <td><b><select class="form-control" name="u_section" required="" >
                                <option value="">plz choose section</option>
                                   <?php
                                   $all_sections = get_all_sections();
                                   foreach ($all_sections as $sections){?>
                                <option value="<?php echo $sections['id']; ?>" <?php if($sections['id']==$std_update['u_section']){echo 'selected';}?>> <?php echo $sections['sec_name'];?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                                          
                
                <tr>
                    <td colspan="2" class="text-center">
                        <button class="btn btn-block btn-lg btn-primary"><b><i class="fa fa-registered" aria-hidden="true"></i>
 Update</b></button>
                
                        <input class="btn btn-block btn-lg btn-danger" type="reset" value="Reset"></td>
                </tr>
                
            </table>
                            </div>
                            <div class=" panel-footer">
                                <b style="color: blue"><i class="fa fa-sign-in" aria-hidden="true"></i>
Forget Password ??? <a href="">Click Here</a></b>
                            </div>
                        </div>
       
                   </div>
                   
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
                </form>
    </body>
</html>


