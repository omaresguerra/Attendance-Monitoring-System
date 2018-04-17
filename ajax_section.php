<?php
include('config.php');

if($_POST['id']) {
	$id=$_POST['id'];

	$sql="SELECT SectionID, SectionName FROM section WHERE CourseID='".$id."' ORDER BY SectionName ASC";
	$res = mysqli_query($dbcon, $sql);
		while($row=mysqli_fetch_array($res)) {
			$id=$row['SectionID'];
			$name=$row['SectionName'];
			echo "<option value='".$id."'>".$name."</option>";
		}
    }

?>