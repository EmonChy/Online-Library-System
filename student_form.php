<?php
include './functions.php';
/*$message="";
if(isset( $_POST['u_name'])){
     $s_name = $_POST['u_name'];
     $s_id =  $_POST['u_id'];
     $s_email =  $_POST['u_email'];
     $s_mob =  $_POST['u_mob'];
     $s_pin =  $_POST['u_pin'];
     $s_amount =  $_POST['u_amount'];
     $s_dept =  $_POST['u_dept'];
     $_session =  $_POST['u_session'];
     
     $s_semister =  $_POST['u_sem'];
     $s_section =  $_POST['u_section'];
     
    $s_reg=student_registration($s_id,$s_name,$s_email,$s_mob,$s_pin,$s_amount,$s_dept,$_session,$s_semister,$s_section);
    
    if($s_reg){
        $message= 'Insert Success' ;
    } else {
         $message= 'Insert Failed' ;
    }
} */
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>user registration form</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
        
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
           <script>
            function getDeptStd(val){
                    $.ajax({
                    type: "POST",
                    url: "new_function.php",
                    data:'dept_id='+val,
                    success: function(data){
                            $("#std-list").html(data);
                    }
                    });
            }
        </script>
               
    </head>
    <body style="background-color: lightgrey" class="" onload="mytest()">
       
            <div class="container ">
                    <div class="row">
                    <div class="col-md-3">
                        
                    </div>
                    <form action="" method="post" id="frm-sub">
                    <div class="col-md-6  text-center ">
                        <div class="panel panel-default">
                            <div class=" panel-heading">
                                <h2> <b class="text-success text-center"><i class="fa fa-book"></i>USER FORM</b></h2>
                                <?php 
                                //if($message){
                                   // echo '<h1>'.$message.'</h1>';
                                //}
                                ?>
                                 <div id="okk2" style="color: blue;font-family:sans-serif; font-size: 30px;font-weight:bold" ></div> 
                               
                            </div>
                            <div class=" panel-body">
            <table class="table">
                <caption class="text-center text-primary"><h4><span style="font-family:verdana;font-weight: bold" >Student Registration</span></h4></caption>
                <tr>
                    <td class="text-right"> <b style="color: blue;font-family: monospace;" >User Name</b></td>
                    <td><input class="form-control " type="text" name="u_name" id="uname" placeholder="enter your name" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;" >User ID </b></td>
                    <td><input class="form-control" type="text" name="u_id" id="uid" placeholder="enter your id" required=""></td>
                </tr>
                
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Email </b></td>
                    <td><input class="form-control" type="email" name="u_email" id="uemail" placeholder="enter email" required=""></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Mobile </b></td>
                    <td><input class="form-control" type="text" name="u_mob" id="umob"  maxlength="11" placeholder="enter your mob number" required=""/></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Pin code</b> </td>
                    <td><input class="form-control" type="password" name="u_pin" id="upin" maxlength="4" placeholder="enter pin" required="" /></td>
                </tr>
                <tr>
                    <td class="text-right"><b style="color: blue;font-family: monospace;">Amount </b></td>
                    <td><input class="form-control" type="number" name="u_amount" id="uamnt" min="0" max="50000" placeholder="enter amount" required=""></td>
                </tr>
                
                 <tr>
                     <td class="text-right"><b style="color: blue;font-family: monospace;">select dept </b></td>
                     <td><b><select class="form-control" name="u_dept" id="udep" required="" onChange="getDeptStd(this.value);">
                            <option value="">plz choose dept</option>
                            <?php
                            $all_depts = get_all_departments();
                            foreach($all_depts as $depts){ ?>
                            <option value= " <?php echo $depts['id']; ?>"> <?php echo $depts['d_code']."(".$depts['d_name'].")"; ?></option>
                            <?php } ?>
                            </select></b></td>
                </tr>
                <tr>
                   <td class="text-right"><b style="color: blue;font-family: monospace;">Student LIst </b> </td>
                                <td colspan="">
                                    <select name="std" id="std-list" class="form-control" >
                                        <option value="">Select Your Option</option>
                                    </select>
                                </td>
                            </tr> 
             
                <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select session </b> </td>
                    <td><b><select class="form-control" name="u_session" id="usess" required=""  >
                                <option value="">plz choose session</option>
                                   <?php
                                   $all_sessions = get_all_sessions();
                                   foreach ($all_sessions as $sessions){?>
                                <option value="<?php echo $sessions['id']; ?>"> <?php echo $sessions['ses_duration']."(".$sessions['t_name'].")";?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                  <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select semister </b> </td>
                      <td><b><select class="form-control" name="u_sem" id="usem" required="" >
                                <option value="">plz choose semester</option>
                                   <?php
                                   $all_semister =  get_all_semister();

                                   foreach ($all_semister as $semester){?>
                                <option value="<?php echo $semester['id']; ?>"> <?php echo $semester['sem_name'];?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                  <tr><td class="text-right"><b style="color: blue;font-family: monospace;">select session </b> </td>
                      <td><b><select class="form-control" name="u_section" id="usec" required="" >
                                <option value="">plz choose section</option>
                                   <?php
                                   $all_sections = get_all_sections();
                                   foreach ($all_sections as $sections){?>
                                <option value="<?php echo $sections['id']; ?>"> <?php echo $sections['sec_name'];?></option>
                                   <?php }?>
                            </select></b>
                                   </td>
                </tr>
                
                <tr>
                    <td colspan="2" class="text-center">
                        <b>
                            <input type="hidden" name="submit"/>
                            <input class="btn btn-block btn-lg btn-primary" type="submit" name="submit"  value="Reg"/></b>
                
                        <input class="btn btn-block btn-lg btn-danger" type="reset" value="Reset"/></td>
                </tr>
                
            </table>
                            </div>
                            <div class=" panel-footer">
                                <b style="color: blue"><i class="fa fa-sign-in" aria-hidden="true"></i>
Forget Password ??? <a href="">Click Here</a></b>
                            </div>
                        </div>
       
                   </div>
                     </form>
                     <div class="col-md-3">
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <div id="okk" style="font-family:sans-serif"></div>
                      <div id="oka" style="font-family:sans-serif"></div>
                      
                     <!--  data gula reg.php thk delete  koraisi   --> 
                    <script type="text/javascript">
                        
                        function deleteData(id){
                            console.log(id);
                            // var del_data = $(".del").attr("id");
                             
                             $.ajax({
                               type:'post',
                               url:'reg.php',
                               //dataType:'html',
                             
                               data:{'del_id':id},
                               
                               success:function(response){
                                    document.getElementById("okk").innerHTML = response;
                               }
                            
                               
                                
                            });
                             
                            
                        }
                        </script>
                        
                        
                        
                        
                   <!--  data gula insert krsi id use kore   --> 
                   
                    <script type="text/javascript">
                        $("#frm-sub").on('submit',function(e){
                            e.preventDefault();
                            //console.log("success");
                           
                            $.ajax({
                                
                               type:'post',
                               url:'reg.php',
                               data:{
                                   //var u_name = $("#uname").val(); 
                                    u_name : $("#uname").val(),
                                    u_id : $("#uid").val(),
                                    u_email : $("#uemail").val(),
                                    u_mob : $("#umob").val(),
                                    u_pin : $("#upin").val(),
                                    u_amount : $("#uamnt").val(),
                                    u_dept : $("#udep").val(),
                                    u_session : $("#usess").val(),
                                    u_sem : $("#usem").val(),
                                    u_section : $("#usec").val()
                               },
                               
                               success:function(response){
                                   document.getElementById("okk2").innerHTML = "success";
                                   document.getElementById("okk").innerHTML = response;
                               }
                            
                               
                                
                            });
                            
                        });
                        </script>
                        <br>
                        
                <!--  data gula reg.php theke ei php page a show koraisi   -->
                

<script type="text/javascript">
                       
                           function mytest(){
                            $.ajax({
                               
                               type:'get',
                               url:'reg.php',
                               dataType:'html',
                               
                               success:function(response){
                                   document.getElementById("okk").innerHTML = response;
                               }
                            
                               
                                
                            });
                        }   
                        
                        </script>
                
                                        </div>
                </div>
                </div>
                
           
            
    </body>
</html>
