<?php 
    session_start();
    if(isset($_SESSION['id'])){
       $username=($_SESSION['UserName']);
    }
    else{
      header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search-Attendance Monitoring System</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
	 <div class="modal-fixed"  id="id02">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                <?php
                include('config.php');
                $tbname = $_GET['tb'];

                if ($tbname == 'Student') {
                  echo "Students";
                  $acctype = $_GET['acctype'];
                  echo "<a href=student.php?acctype=".$acctype."><div class=close-attendance title =Close>&times;</div></a>";
                }
                else{
                  echo "Attendance";
                  $acctype = $_GET['acctype'];
                  $event = $_GET['event'];

                  $qry = "SELECT * FROM event WHERE EventID = ".$event;
                  $rest = mysqli_query($dbcon, $qry);
                  echo "<form action = attendance.php?acctype=".$acctype." method = post>";
                   echo "<select name='cboxEvent' class=select-hidden>";
                      while ($rw = mysqli_fetch_array($rest)) {
                        echo "<option value='".$rw['EventID']."'></option>";
                      }
                   echo "</select>";
                
                  echo "<button class=close-attendance-button title =Close>&times;</button></form>";
                }
                
                 ?>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');

                $acctype = $_GET['acctype'];
                $stat = $_GET['status'];
                $stud = $_POST['txtSearch'];
                $tbname = $_GET['tb'];

                if($tbname == 'Student'){

                echo "<table cellpadding=9 cellspacing=0 border=0>";
                echo "<tr>";
                  echo "<td class=head><b>StudID</b></td>";
                  echo "<td class=head><b>StudName</b></td>";
                  echo "<td class=head><b>Address</b></td>";
                  echo "<td class=head><b>CourseName</b></td>";
                  echo "<td class=head><b>DeptName</b></td>";
                  echo "<td class=head><b>Section</b></td>";
                    if (($acctype == 'Admin') && ($stat == 'Edit')) {
                      echo "<td class=head><b>Edit</b></td>";
                    }
                    elseif (($acctype == 'Admin') && ($stat == 'Delete')) {
                      echo "<td class=head><b>Delete</b></td>";
                    }
                  echo "</tr>";

                 if (empty($_POST['txtSearch'])) {
                  	echo "<tr>
                  		<td colspan=7><center><b style=color:#f00;>**StudID is empty!<b></center>
                  		  </tr>";
                  } 
                  else{
	                $query = "SELECT * FROM student JOIN course ON course.CourseID=student.CourseID JOIN section ON section.SectionID=student.SectionID JOIN department ON department.DeptID=course.DeptID WHERE StudID = '".$stud."'";
	                $result = mysqli_query($dbcon, $query);

	                if ($row = mysqli_fetch_array($result)) {
		                  echo "<tr>";
		                  echo "<td>".$row['StudID']."</td>";
		                  echo "<td>".$row['StudName']."</td>";
		                  echo "<td>".$row['Address']."</td>";
                      echo "<td>".$row['CourseName']."</td>";
		                  echo "<td>".$row['DeptName']."</td>";
                      echo "<td>".$row['SectionName']."</td>";
		                  if (($acctype == 'Admin') && ($stat == 'Edit')){
		                      echo "<td><a href=edit.php?id=".$row['StudID']."&acctype=".$acctype."&tb=Student><img src=img/edit.png class=edit1></a></td>";
		                  }
                      elseif (($acctype == 'Admin') && ($stat == 'Delete')) {
                          echo "<td><a href=delete.php?id=".$row['StudID']."&acctype=".$acctype."&tb=Student><img src=img/delete.png class=edit2></a></td>";
                      }
		                  	echo "</tr>";
		                }
	                  else{
	                	echo "<tr>
                  		<td colspan=7><center><b style=color:#f00;>**StudID doesn't exist!<b></center>
                  		  </tr>";
	            		}
	            	}
                echo "</table>";
              }
              elseif($tbname == 'Attendance'){
                echo "<table cellpadding=9 cellspacing=0 border=0>";
                echo "<tr>";
                  echo "<td class=head><b>AttendID</b></td>";
                  echo "<td class=head><b>StudID</b></td>";
                  echo "<td class=head><b>EventName</b></td>";
                  echo "<td class=head><b>Time</b></td>";
                  echo "<td class=head><b>Am/Pm</b></td>";
                  echo "<td class=head><b>In/Out</b></td>";
                    if (($acctype == 'Admin') && ($stat == 'Edit')) {
                      echo "<td class=head><b>Edit</b></td>";
                    }
                    elseif (($acctype == 'Admin') && ($stat == 'Delete')) {
                      echo "<td class=head><b>Delete</b></td>";
                    }
                  echo "</tr>";

                 if (empty($_POST['txtSearch'])) {
                    echo "<tr>
                      <td colspan=7><center><b style=color:#f00;>**StudID is empty!<b></center>
                        </tr>";
                  } 
                  else{
                  $query = "SELECT * FROM attendance JOIN ampm ON ampm.AmPmID=attendance.AmPmID JOIN timeinout ON timeinout.TimeInOutID=attendance.TimeInOutID 
                   WHERE StudID = '".$stud."' AND EventID ='".$event."'";
                  $result = mysqli_query($dbcon, $query);

                  if ($count = mysqli_num_rows($result) != 0){

                     while($row = mysqli_fetch_array($result)) {
                      echo "<tr>";
                      echo "<td>".$row['AttendID']."</td>";
                      echo "<td>".$row['StudID']."</td>";

                      $query1 = "SELECT * FROM event WHERE EventID = '".$event."'";
                      $result1 = mysqli_query($dbcon, $query1);
                      while ($row1 = mysqli_fetch_array($result1)) {
                         echo "<td>".$row1['EventName']."</td>";
                      }
                      echo "<td>".$row['AttendTime']."</td>";
                      echo "<td>".$row['AmPmName']."</td>";
                      echo "<td>".$row['TimeInOutName']."</td>";
                      if (($acctype == 'Admin') && ($stat == 'Edit')){
                          echo "<td><a href=edit.php?id=".$row['StudID']."&acctype=".$acctype."&tb=Attendance><img src=img/edit.png class=edit1></a></td>";
                      }
                      elseif (($acctype == 'Admin') && ($stat == 'Delete')) {
                          echo "<td><a href=delete.php?id=".$row['StudID']."&acctype=".$acctype."&tb=Attendance><img src=img/delete.png class=edit2></a></td>";
                      }
                        echo "</tr>";
                    }

                  }
                  else{
                   echo "<tr>
                     <td colspan=7><center><b style=color:#f00;>**StudID doesn't exist!<b></center>
                     </tr>";
                  }
                }
                echo "</table>";
              }
              ?>
              </div>          
          </div>
          <div class="button-cancel">
          	<?php
                $acctype = $_GET['acctype'];
                $tbname = $_GET['tb'];
            
                if ($tbname == 'Student') {
                  echo "<a href=student.php?acctype=".$acctype."><button type=button class =cancelbtn>Cancel</button></a>";
                }
              	else{
                  $event = $_GET['event'];
                  $qry = "SELECT * FROM event WHERE EventID = ".$event;
                  $rest = mysqli_query($dbcon, $qry);
                  echo "<form action = attendance.php?acctype=".$acctype." method = post>";
                   echo "<select name='cboxEvent' class=select-hidden>";
                      while ($rw = mysqli_fetch_array($rest)) {
                        echo "<option value='".$rw['EventID']."'></option>";
                      }
                   echo "</select>";
                  echo "<button type=submit class=cancelbtn>Cancel</button></div></form>";
                }
             ?>
            </div>
          </div>
      </div>
</div>
</body>
</html>