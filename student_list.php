<?php
include './functions.php';

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
            <?php
            $all_students = get_all_students();
            ?>
            <tr>
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
            </tr>
            <?php
            foreach ($all_students as $std){
                $dept_info = get_dept_info_by_id($std['u_dept']);
                $ses_info = get_ses_info_by_id($std['u_session']);
                $sem_info  = get_sem_info_by_id($std['u_sem']);
                $sec_info  = get_sec_info_by_id($std['u_section']);
                
            ?>
            <tr>
             <td><?php echo $std['u_name']; ?> </td>
             <td><a href="student_info.php?s_id=<?php echo $std['id']; ?>"><?php echo $std['u_id']; ?></a></td>
               
                <td><?php echo $std['u_email']; ?></td>
                <td><?php echo $std['u_mob']; ?></td>
                <td><?php echo $std['u_pin']; ?></td>
                <td><?php echo $std['u_amount']; ?></td>
                <td><?php echo $std['u_reg']; ?></td>
                <td><?php echo $dept_info['d_code']; ?></td>
                <td><?php echo $ses_info['ses_duration']; ?></td>
                <td><?php echo $sem_info['sem_name']; ?></td>
                <td><?php echo $sec_info['sec_name']; ?></td>   
            </tr>
            <?php }?>
            
        </table>   
    </center>
                
    </body>
</html>

