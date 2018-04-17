<?php
include('config.php');

if($_POST['id']) {
	$id=$_POST['id'];

	$sql="SELECT CourseID, CourseName FROM course WHERE DeptID='".$id."'";
	$res = mysqli_query($dbcon, $sql);
		while($row=mysqli_fetch_array($res)) {
			$id=$row['CourseID'];
			$name=$row['CourseName'];
			echo "<option value='".$id."'>".$name."</option>";
		}
    }

?>