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
        <h1>Book issue List</h1>
        <table class="table">
            <?php
        $all_issue_book =get_all_issue_books();
            ?>
            <tr>
                <th>issue_date</th>
                <th>renew_date</th>
                <th>book_id</th>
                <th>student_id</th>
               
               
            </tr>
            <?php
            foreach ($all_issue_book as $issue_book){
                $std_info = get_issue_info_by_student_id($issue_book['student_id']);
                 $book_info = get_issue_info_by_book_id($issue_book['book_id']);
                
            ?>
            <tr>
             <td><?php echo $issue_book['issue_date']; ?> </td>
             <td><?php echo $issue_book['renew_date']; ?></td>
               
                <td><?php echo $std_info['u_id']; ?></td>
                <td><?php echo $book_info['code']; ?></td>
           
                
              
            </tr>
            <?php }?>
            
        </table>   
    </center>
</body>
</html>

