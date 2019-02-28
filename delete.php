<?php
include './functions.php';
$all_students = get_all_students();
if(isset($_GET['std_del'])){
 $std_delete = $_GET['std_del']  ; 
$std_del =  get_std_by_id_delete($std_delete);

    
    
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>user registration form</title>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        
    </head>
    <body>
        
    <center>
        <h1>Students List</h1>
        <table class="table">
           
            <tr>
                <th>Serial no</th>
                <th>name</th>
                <th>id</th>
                <th>email</th>
                <th>mob</th>
                <th>pin</th>
                <th>amount</th>
                <th>reg</th>
                <th>dept</th>
                <th>session</th>
                <th>semister</th>
                <th>section</th>
                <th>image</th>
                <th colspan="2">Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if(count($all_students)>0){
                $i = 1;
            foreach ($all_students as $std){
                $dept_info = get_dept_info_by_id($std['u_dept']);
                $ses_info = get_ses_info_by_id($std['u_session']);
                $sem_info  = get_sem_info_by_id($std['u_sem']);
                $sec_info  = get_sec_info_by_id($std['u_section']);
            ?>
            <tr>
                <td><?php echo $i ; ?>.</td>  
             <td><?php echo $std['u_name']; ?> </td>
             <td><a href="student_info.php?s_id=<?php echo $std['id']; ?>"><?php echo $std['u_id']; ?></a></td>
               
                <td><?php echo $std['u_email']; ?></td>
                <td><?php echo $std['u_mob']; ?></td>
                <td><?php echo $std['u_pin']; ?></td>
                <td><?php echo $std['u_amount']; ?></td>
                <td><?php echo $std['u_reg']; ?></td>
                <td><a href="dept_information.php?count_id=<?php echo $dept_info['id']; ?>"><?php echo $dept_info['d_code']; ?></a></td>
                <td><?php echo $ses_info['ses_duration']; ?></td>
                <td><?php echo $sem_info['sem_name']; ?></td>
                <td><?php echo $sec_info['sec_name']; ?></td>
            <td><?php echo "<img src = 'image/".$std['image']."' height=80px width=80px />"; ?></td>
            <td><a href="student_edit.php?updt_id=<?php echo $std['id']; ?>">Get Edit</a> </td>          
            <td>
                <form action="student_post_edit.php" method="post">
                    <input type="hidden" value="<?php echo $std['id']; ?>" name="updt_id"/>
                    <input type="submit" value="post edit"/>
                    
                    
                </form>
            </td>
            <td><a href="delete.php?std_del=<?php echo $std['id'];?>">delete</a></td>
               
            
            </tr>
           
            <?php  $i++; } } else{ ?>
            <tr>
                <td class="text-center" colspan="11">Data Not Found</td>
            </tr>
            <?php } ?>
             
        </table>
        <a href="std_count.php?std_c_id=<?php echo $std['id']; ?>">student count</a>
    </center>
                
    </body>
</html>

