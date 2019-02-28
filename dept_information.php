<?php
include './functions.php';
 if(isset($_GET['count_id']))
  {
      $cid = $_GET['count_id'];
      $count = get_all_students_by_dept_count($cid);
      $countt  =  get_all_teachers_by_dept_count($cid);
      
     
       
    
  }
 
  
  
?>





<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>home Page</title>
        <style></style>
       
           <link rel="stylesheet" href="css/bootstrap.css"/>
    </head>
    <body>
         
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary text-center "> 
            <div class="panel panel-heading">
                <h1 style="font-family: cursive;font-weight: bold;">Department info page</h1>     
            </div>
            <div class="panel panel-body ">
               
                <table class="table table-bordered table-striped" >
                    <tr>
                        <td colspan="2">
                            <img class="img img-thumbnail img-rounded" src="image/kh001.jpg" alt="flower" width="200"/>
                    </tr>
                    <tr>
                        <td class="text-right text-info ">no of students:</td>
                        <td class="text-left"><a href="dept_students.php?dept_id=<?php echo $cid['id']; ?>"><?php echo count($count); ?></a></td>
                     
                      
                    </tr>
                    <tr>
                          <td class="text-right text-info ">no of teachers:</td>
                          <td class="text-left"><?php echo  count($countt);  ?></td>
                    </tr>
                    
                
                </table>
                             
            </div>
            
        </div>
            </div>
          </div>
        </div>
        
    </body>
</html>

