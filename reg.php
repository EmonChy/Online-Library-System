<?php
include './functions.php';
$message="";
if(isset($_POST['u_name'])){
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
}


    $msg="";
    $all_students = get_all_students();
    if(isset($_POST['del_id'])){
     $std_delete = $_POST['del_id']  ; 
    $std_del =  get_std_by_id_delete($std_delete);
    if($std_del){
            $msg= 'delete done' ;
        } 
        else {
             $msg= 'delete failed' ;
        }


    }
    
    $message2="";


if(isset($_POST['id'])){
	
	$name = $_POST['std_name'];
        $std_id = $_POST['std_id'];
	$email = $_POST['std_email'];	
	$contact = $_POST['std_contact'];	
	
	$id = $_POST['id'];
        $result  = mysql_query("UPDATE students_new SET  u_id='$std_id',u_name='$name',u_email='$email' ,u_mob='$contact'  WHERE id='$id'");
	 if($result){
        $message2= "Student Updated";
    }
 else {
    $message2="Damage";    
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
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        
    </head>
    <body>
                          
    
            <?php 
                 if($msg){
                     echo '<h3>'.$msg.'</h3>';
                 } ?>
        <h1 class="text-center">Students List</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                <td class="">Serial no</td>
                <td class="">name</td>
                <td class="">id</td>
                <td class="">email</td>
                <td class="">mob</td>
                <!--
                <td class="">pin</td>
                <td class="">amount</td>
                <td class="">reg</td>
                
                -->
                <td class="">dept</td>
                <td class="">session</td>
                <td class="">semister</td>
                <td class="">section</td>
                <td class="">image</td>
                <td colspan="2" class="">Edit</td>
                <td>Action</td>
                <td class="">Delete</td>
            </tr>
            </thead>
            <tbody>
            <?php
            if(count($all_students)>0){
                $i = 1;
            foreach ($all_students as $std){
                $dept_info = get_dept_info_by_id($std['u_dept']);
                $ses_info = get_ses_info_by_id($std['u_session']);
                $sem_info  = get_sem_info_by_id($std['u_sem']);
                $sec_info  = get_sec_info_by_id($std['u_section']);
            ?>
                <tr class="text-center" id="<?php echo $std['id'];?>">
                <td><b><?php echo $i ; ?>.</b></td>  
                <td data-target="std_name"><b><?php echo $std['u_name']; ?></b></td>
                <td data-target="std_id"><b><a href="student_info.php?s_id=<?php echo $std['id']; ?>"><?php echo $std['u_id']; ?></a></b></td>
               
                <td data-target="std_email"><b><?php echo $std['u_email']; ?></b></td>
                <td data-target="std_contact"><b><?php echo $std['u_mob']; ?></b></td>
                <!--
                <td><b><?php echo $std['u_pin']; ?></b></td>
                <td><b><?php echo $std['u_amount']; ?></b></td>
                <td><b><?php echo $std['u_reg']; ?></b></td>
                    -->
                <td><b><a href="dept_information.php?count_id=<?php echo $dept_info['id']; ?>"><?php echo $dept_info['d_code']; ?></a></b></td>
                <td><b><?php echo $ses_info['ses_duration']; ?></b></td>
                <td><b><?php echo $sem_info['sem_name']; ?></b></td>
                <td><b><?php echo $sec_info['sec_name']; ?><b></td>
                <td><b><?php echo "<img src = 'image/".$std['image']."' height=80px width=80px />"; ?></b></td>
                <td><b><a href="student_edit.php?updt_id=<?php echo $std['id']; ?>">Get Edit</a></b> </td>          
                          <td><b>
                <form action="student_post_edit.php" method="post">
                    <input type="hidden" value="<?php echo $std['id']; ?>" name="updt_id"/>
                    <input type="submit" value="post edit"/>
                    
                    
                </form>
                              </b>
                            </td>
                            <td><a href="#" data-role="update" data-id="<?php echo $std['id'];?>" class=" btn btn-md btn-info"> <i class="fa fa-edit"></i> Update</a>
                            </td>
                            <td><b>
                                    
                                    <a class="btn btn-danger" onclick="deleteData(<?php echo $std['id'];?>)">delete</a></b>
                            </td>  
            
            </tr>
           
            <?php  $i++; } } else{ ?>
            <tr>
                <td class="text-center" colspan="14"><b>Data Not Found</b></td>
            </tr>
            
            <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center" colspan="14"> 
                            <a href="std_count.php?std_c_id=<?php echo $std['id']; ?>">student count</a>
                    </td>
                </tr>
            </tfoot>
        </table>
        
        
           
    <script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            //var std_name  = $(this).data('u_name');
            var std_name  = $('#'+id).children('td[data-target=std_name]').text();
            var std_id  = $('#'+id).children('td[data-target=std_id]').text();
            var std_email  = $('#'+id).children('td[data-target=std_email]').text();
            var std_contact  = $('#'+id).children('td[data-target=std_contact]').text();
           
          
           
            
            $('#std_name').val(std_name);
            $('#std_id').val(std_id);
            $('#std_email').val(std_email);
            $('#std_contact').val(std_contact);
           
            $('#s_id').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 
      
       $('#save').click(function(){
          var id  = $('#s_id').val(); 
        
         var std_name =  $('#std_name').val();
          var std_id =  $('#std_id').val();
         var std_email =  $('#std_email').val();
         var std_contact =  $('#std_contact').val();
       $.ajax({
              url      : 'reg.php',
              method   : 'post', 
              data     : {std_name : std_name ,std_id : std_id ,std_email : std_email ,std_contact : std_contact ,id: id},
              success  : function(response){
                            // now update user record in table 
                                                      
                             $('#'+id).children('td[data-target=std_name]').text(std_name); 
                             $('#'+id).children('td[data-target=std_id]').text(std_id);
                             $('#'+id).children('td[data-target=std_email]').text(std_email);                          
                             $('#'+id).children('td[data-target=std_contact]').text(std_contact);                           
                             $('#myModal').modal('toggle');
                           

                         }
          });
       });

  });
</script>
        
        
        
        
         <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">STUDENTS DETAILS</h4>
          </div>
          <div class="modal-body">           
              <div class="form-group">
                <label>STUDENT Name</label>
                <input type="text" id="std_name" class="form-control">
              </div>   
              <div class="form-group">
                <label>STUDENT Id</label>
                <input type="text" id="std_id" class="form-control">
              </div>   
              <div class="form-group">
                <label>STUDENT Email</label>
                <input type="text" id="std_email" class="form-control">
              </div>   
              <div class="form-group">
                <label>STUDENT Mob</label>
                <input type="text" id="std_contact" class="form-control">
              </div>   
              
                
                
              
              <input type="text" id="s_id" class="form-control">
          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    
    
                
    </body>
</html>
