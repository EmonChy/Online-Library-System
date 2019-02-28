 <?php
include './functions.php';
if(isset($_POST["dept_id"])){
    $dept_id =$_POST["dept_id"];
    $det_std_list= get_all_students_by_dept_count($dept_id);
    ?>    
    <option value="">STUDENTS LIST</option>
    <?php
    foreach ($det_std_list as $det_std)
    {
    ?>
    <option value="<?php echo $det_std['id']; ?>"><?php echo $det_std['u_name']." (".$det_std['u_id'].")"; ?></option>
<?php } } 
?>
