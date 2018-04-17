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
	<title>Absent Report-Attendance Monitoring System</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
	 <div class="modal-fixed"  id="id02">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                  Absent Report
    
                <?php
                  include('config.php');
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
                 ?>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');
                $tbname = $_GET['tb'];

                if ($tbname == 'Department') {
                    $acctype = $_GET['acctype'];
                    $event = $_GET['event'];
                    $dept = $_GET['dept'];
                    echo "<table cellpadding=9 cellspacing=0 border=0>";
                    echo "<tr>";
                      echo "<td class=head><b>StudID</b></td>";
                      echo "<td class=head><b>StudName</b></td>";
                      echo "<td class=head><b>Department</b></td>";
                      echo "<td class=head><b>EventName</b></td>";
                      echo "<td class=head><b>No of Bottles</b></td>";
                      echo "</tr>";

                      $qry = "SELECT * FROM student JOIN course ON course.CourseID=student.CourseID WHERE DeptID = '".$dept."' ORDER BY StudName ASC";
                      $res = mysqli_query($dbcon, $qry);
                      while ($row = mysqli_fetch_array($res)) {
                         $stud = $row['StudID'];

                         $query = "SELECT Count(AttendID) FROM attendance WHERE EventID = '".$event."' AND StudID='".$stud."'";
                         $result = mysqli_query($dbcon, $query);
                         while ($rows = mysqli_fetch_array($result)) {

                           if ($rows[0] != 4) {
                              echo "<tr><td>".$row['StudID']."</td>";
                              echo "<td>".$row['StudName']."</td>";

                              $query1 = "SELECT * FROM department WHERE DeptID='".$dept."'";
                              $result1 = mysqli_query($dbcon, $query1);
                              while ($row1=mysqli_fetch_array($result1)) {
                                echo "<td><i>* ".$row1['DeptName']."</i></td>";
                              }

                              $query2 = "SELECT * FROM event WHERE EventID='".$event."'";
                              $result2 = mysqli_query($dbcon, $query2);
                              while ($row2=mysqli_fetch_array($result2)) {
                                 echo "<td><i>* ".$row2['EventName']."</i></td>";
                              }
                              if($rows['Count(AttendID)']==3){
                                echo "<td>50</td>";
                              }
                              elseif($rows['Count(AttendID)']==2){
                                echo "<td>100</td>";
                              }
                              elseif($rows['Count(AttendID)']==1){
                                echo "<td>150</td>";
                              }
                              elseif($rows['Count(AttendID)']==0){
                                echo "<td>200</td>";
                              }
                            } 
                         }
                      }
                      echo "</table>";

                  }
                  elseif ($tbname == 'Course') {
                    $acctype = $_GET['acctype'];
                    $event = $_GET['event'];
                    $course = $_GET['course'];
                    echo "<table cellpadding=9 cellspacing=0 border=0>";
                    echo "<tr>";
                      echo "<td class=head><b>StudID</b></td>";
                      echo "<td class=head><b>StudName</b></td>";
                      echo "<td class=head><b>Course</b></td>";
                      echo "<td class=head><b>EventName</b></td>";
                      echo "<td class=head><b>No of Bottles</b></td>";
                      echo "</tr>";

                      $qry = "SELECT * FROM student WHERE CourseID = '".$course."' ORDER BY StudName ASC";
                      $res = mysqli_query($dbcon, $qry);
                      while ($row = mysqli_fetch_array($res)) {
                         $stud = $row['StudID'];

                         $query = "SELECT Count(AttendID) FROM attendance WHERE EventID = '".$event."' AND StudID='".$stud."'";
                         $result = mysqli_query($dbcon, $query);
                         while ($rows = mysqli_fetch_array($result)) {

                           if ($rows[0] != 4) {
                              echo "<tr><td>".$row['StudID']."</td>";
                              echo "<td>".$row['StudName']."</td>";

                              $query1 = "SELECT * FROM course WHERE CourseID='".$course."'";
                              $result1 = mysqli_query($dbcon, $query1);
                              while ($row1=mysqli_fetch_array($result1)) {
                                echo "<td><i>* ".$row1['CourseName']."</i></td>";
                              }

                              $query2 = "SELECT * FROM event WHERE EventID='".$event."'";
                              $result2 = mysqli_query($dbcon, $query2);
                              while ($row2=mysqli_fetch_array($result2)) {
                                 echo "<td><i>* ".$row2['EventName']."</i></td>";
                              }
                              if($rows['Count(AttendID)']==3){
                                echo "<td>50</td>";
                              }
                              elseif($rows['Count(AttendID)']==2){
                                echo "<td>100</td>";
                              }
                              elseif($rows['Count(AttendID)']==1){
                                echo "<td>150</td>";
                              }
                              elseif($rows['Count(AttendID)']==0){
                                echo "<td>200</td>";
                              }
                            } 
                         }
                      }
                      echo "</table>";
                  }
                  elseif ($tbname == 'Section') {
                    $acctype = $_GET['acctype'];
                    $event = $_GET['event'];
                    $sect = $_GET['sect'];
                    echo "<table cellpadding=9 cellspacing=0 border=0>";
                    echo "<tr>";
                      echo "<td class=head><b>StudID</b></td>";
                      echo "<td class=head><b>StudName</b></td>";
                      echo "<td class=head><b>Section</b></td>";
                      echo "<td class=head><b>EventName</b></td>";
                      echo "<td class=head><b>No of Bottles</b></td>";
                      echo "</tr>";

                      $qry = "SELECT * FROM student WHERE SectionID = '".$sect."' ORDER BY StudName ASC";
                      $res = mysqli_query($dbcon, $qry);
                      while ($row = mysqli_fetch_array($res)) {
                         $stud = $row['StudID'];

                         $query = "SELECT Count(AttendID) FROM attendance WHERE EventID = '".$event."' AND StudID='".$stud."'";
                         $result = mysqli_query($dbcon, $query);
                         while ($rows = mysqli_fetch_array($result)) {

                           if ($rows[0] != 4) {
                              echo "<tr><td>".$row['StudID']."</td>";
                              echo "<td>".$row['StudName']."</td>";

                              $query1 = "SELECT * FROM section WHERE SectionID='".$sect."'";
                              $result1 = mysqli_query($dbcon, $query1);
                              while ($row1=mysqli_fetch_array($result1)) {
                                echo "<td><i>* ".$row1['SectionName']."</i></td>";
                              }

                              $query2 = "SELECT * FROM event WHERE EventID='".$event."'";
                              $result2 = mysqli_query($dbcon, $query2);
                              while ($row2=mysqli_fetch_array($result2)) {
                                 echo "<td><i>* ".$row2['EventName']."</i></td>";
                              }
                              if($rows['Count(AttendID)']==3){
                                echo "<td>50</td>";
                              }
                              elseif($rows['Count(AttendID)']==2){
                                echo "<td>100</td>";
                              }
                              elseif($rows['Count(AttendID)']==1){
                                echo "<td>150</td>";
                              }
                              elseif($rows['Count(AttendID)']==0){
                                echo "<td>200</td>";
                              }
                            } 
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
             ?>
            </div>
          </div>
      </div>
</div>
</body>
</html>