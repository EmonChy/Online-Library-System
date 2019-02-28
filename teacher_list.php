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
        <h1>Teachers List</h1>
        <table class="table">
            <?php
        $all_teachers = get_all_teachers();
            ?>
            <tr>
                <th>name</th>
                <th>id</th>
                <th>mob</th>
                <th>email</th>
                <th>dept</th>
               
            </tr>
            <?php
            foreach ($all_teachers as $teacher){
               
                
            ?>
            <tr>
             <td><?php echo $teacher['t_name']; ?> </td>
             <td><?php echo $teacher['t_id']; ?></td>
               
                <td><?php echo $teacher['t_mob']; ?></td>
                <td><?php echo $teacher['t_email']; ?></td>
                <td><?php echo $teacher['t_dept']; ?></td>
                
              
            </tr>
            <?php }?>
            
        </table>   
    </center>

