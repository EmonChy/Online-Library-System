<?php include './includes/functions.php';


//if(isset($_POST['user_name']))
//{
// $name=$_POST['user_name'];
//
// $checkdata=" SELECT name FROM user WHERE name='$name' ";
//
// $query=mysql_query($checkdata);
//
// if(mysql_num_rows($query)>0)
// {
//  echo "User Name Already Exist";
// }
// else
// {
//  echo "OK";
// }
// exit();
//}

if(isset($_POST['s_email']))
{
 $emailId=$_POST['s_email'];

 $checkdata=" SELECT s_email FROM libsys_students WHERE s_email='$emailId' ";

 $query=mysql_query($checkdata);

 if(mysql_num_rows($query)>0)
 {
  echo "Email Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}
?>

