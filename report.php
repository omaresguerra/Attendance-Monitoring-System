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
	<title>Report-Attendance Monitoring System</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
	 <div class="modal-fixed"  id="id02">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
              <?php
                $tbname=$_GET['tb'];
                if ($tbname == 'Department') {
              ?>
                  Department Report
                  <div class="search-att-dept">
                    <?php
                      $acctype = $_GET['acctype'];
                      $event = $_GET['event'];
                      $dept = $_POST['cboxDepartment'];
                      echo "<div class=absent-div>
                      <a href=report-absent.php?acctype=".$acctype."&event=".$event."&dept=".$dept."&tb=Department>
                        <button class=searchbtn-absent>View Absences</button></a>
                      </div>";
                      echo "<div class=search-div-dept>
                      <a href=report-dept.php?acctype=".$acctype."&event=".$event.">
                        <button class=searchbtn-dept>View no of Attendees</button></a>
                      </div>";
                    ?>
                  </div>
              <?php
                }elseif ($tbname == 'Course') {
                  $acctype = $_GET['acctype'];
                  $event = $_GET['event'];
                  $course = $_POST['cboxCourse'];
                  echo "Course Report";
                  echo "
                  <div class=search-att-dept>
                    <div class=search-div-dept-1>
                        <a href=report-absent.php?acctype=".$acctype."&event=".$event."&course=".$course."&tb=Course>
                          <button class=searchbtn-dept>View Absences</button></a>
                    </div>
                  </div>";
                }
                elseif ($tbname == 'Section') {
                  $acctype = $_GET['acctype'];
                  $event = $_GET['event'];
                  $section = $_POST['cboxSection'];
                  echo "Section Report";
                  echo "
                  <div class=search-att-dept>
                    <div class=search-div-dept-1>
                        <a href=report-absent.php?acctype=".$acctype."&event=".$event."&sect=".$section."&tb=Section>
                          <button class=searchbtn-dept>View Absences</button></a>
                    </div>
                  </div>";
                }
                 elseif ($tbname == 'Event') {
                  echo "Event Report";
                }
              ?>


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
                
                  echo "<button class=close-attendance-button title=Close>&times;</button></form>";
                 ?>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');

                $tbname = $_GET['tb'];

                if ($tbname == 'Department'){
                  $acctype = $_GET['acctype'];
                  $dept = $_POST['cboxDepartment'];
                  $event = $_GET['event'];
                  echo "<table cellpadding=9 cellspacing=0 border=0>";
                  echo "<tr>";
                    echo "<td class=head><b>StudID</b></td>";
                    echo "<td class=head><b>StudName</b></td>";
                    echo "<td class=head><b>EventName</b></td>";
                    echo "<td class=head><b>DeptName</b></td>";
                    echo "<td class=head><b>No of Bottles</b></td>";
                    echo "</tr>";

  	                $query = "SELECT *, Count(AttendID) FROM  attendance JOIN student ON student.StudID = attendance.StudID JOIN course ON course.CourseID=student.CourseID  WHERE EventID = '".$event."' AND DeptID='".$dept."' GROUP BY StudName";
  	                $result = mysqli_query($dbcon, $query);
                    while ($rows = mysqli_fetch_array($result)) {

                      if ($rows['Count(AttendID)'] == 4) {

                        echo "<tr>";
                        echo "<td>".$rows['StudID']."</td>";
                        echo "<td>".$rows['StudName']."</td>";

                        $query1 = "SELECT * FROM event WHERE EventID = '".$event."'";
                        $result1 = mysqli_query($dbcon, $query1);
                        while ($row1 = mysqli_fetch_array($result1)) {
                          echo "<td>".$row1['EventName']."</td>";
                        }

                        $query2 = "SELECT * FROM department WHERE DeptID='".$dept."'";
                        $result2 = mysqli_query($dbcon, $query2);
                        while ($row2=mysqli_fetch_array($result2)) {
                          echo "<td><i>* ".$row2['DeptName']."</i></td>";
                        }
                          // if ($rows['Count(AttendID)'] == 4) {
                            echo "<td>0</td>";
                      }     
                          // }
                          // elseif($rows['Count(AttendID)']==3){
                          //   echo "<td>50</td>";
                          // }
                          // elseif($rows['Count(AttendID)']==2){
                          //   echo "<td>100</td>";
                          // }
                          // elseif($rows['Count(AttendID)']==1){
                          //   echo "<td>150</td>";
                          // }
                      }
                      echo "</tr>";
                    echo "</table>";
                  }

                  elseif ($tbname == 'Course') {

                      $acctype = $_GET['acctype'];
                      $course = $_POST['cboxCourse'];
                      $event = $_GET['event'];
                      echo "<table cellpadding=9 cellspacing=0 border=0>";
                      echo "<tr>";
                        echo "<td class=head><b>StudID</b></td>";
                        echo "<td class=head><b>StudName</b></td>";
                        echo "<td class=head><b>EventName</b></td>";
                        echo "<td class=head><b>CourseName</b></td>";
                        echo "<td class=head><b>No of Bottles</b></td>";
                        echo "</tr>";

                      $query = "SELECT *, Count(AttendID) FROM  attendance JOIN student ON student.StudID = attendance.StudID  WHERE EventID = '".$event."' AND CourseID='".$course."' GROUP BY StudName";
                      $result = mysqli_query($dbcon, $query);
                      while ($rows = mysqli_fetch_array($result)) {

                        if ($rows['Count(AttendID)'] == 4) {
                          echo "<tr>";
                          echo "<td>".$rows['StudID']."</td>";
                          echo "<td>".$rows['StudName']."</td>";

                          $query1 = "SELECT * FROM event WHERE EventID = '".$event."'";
                          $result1 = mysqli_query($dbcon, $query1);
                          while ($row1 = mysqli_fetch_array($result1)) {
                            echo "<td>".$row1['EventName']."</td>";
                          }

                          $query2 = "SELECT * FROM course WHERE CourseID='".$course."'";
                          $result2 = mysqli_query($dbcon, $query2);
                          while ($row2=mysqli_fetch_array($result2)) {
                            echo "<td><i>* ".$row2['CourseName']."</i></td>";
                          }
                            // if ($rows['Count(AttendID)'] == 4) {
                              echo "<td>0</td>";
                         }     
                            // }
                            // elseif($rows['Count(AttendID)']==3){
                            //   echo "<td>50</td>";
                            // }
                            // elseif($rows['Count(AttendID)']==2){
                            //   echo "<td>100</td>";
                            // }
                            // elseif($rows['Count(AttendID)']==1){
                            //   echo "<td>150</td>";
                            // }
                        }
                        echo "</tr>";
                      echo "</table>";
                  }
                  elseif ($tbname == 'Section') {

                      $acctype = $_GET['acctype'];
                      $sect = $_POST['cboxSection'];
                      $event = $_GET['event'];
                      echo "<table cellpadding=9 cellspacing=0 border=0>";
                      echo "<tr>";
                        echo "<td class=head><b>StudID</b></td>";
                        echo "<td class=head><b>StudName</b></td>";
                        echo "<td class=head><b>EventName</b></td>";
                        echo "<td class=head><b>SectionName</b></td>";
                        echo "<td class=head><b>No of Bottles</b></td>";
                        echo "</tr>";

                      $query = "SELECT *, Count(AttendID) FROM  attendance JOIN student ON student.StudID = attendance.StudID  WHERE EventID = '".$event."' AND SectionID='".$sect."' GROUP BY StudName";
                      $result = mysqli_query($dbcon, $query);
                      while ($rows = mysqli_fetch_array($result)) {

                        if ($rows['Count(AttendID)'] == 4) {
                          echo "<tr>";
                          echo "<td>".$rows['StudID']."</td>";
                          echo "<td>".$rows['StudName']."</td>";

                          $query1 = "SELECT * FROM event WHERE EventID = '".$event."'";
                          $result1 = mysqli_query($dbcon, $query1);
                          while ($row1 = mysqli_fetch_array($result1)) {
                            echo "<td>".$row1['EventName']."</td>";
                          }

                          $query2 = "SELECT * FROM section WHERE SectionID='".$sect."'";
                          $result2 = mysqli_query($dbcon, $query2);
                          while ($row2=mysqli_fetch_array($result2)) {
                            echo "<td><i>* ".$row2['SectionName']."</i></td>";
                          }
                            // if ($rows['Count(AttendID)'] == 4) {
                              echo "<td>0</td>";
                         }     
                            // }
                            // elseif($rows['Count(AttendID)']==3){
                            //   echo "<td>50</td>";
                            // }
                            // elseif($rows['Count(AttendID)']==2){
                            //   echo "<td>100</td>";
                            // }
                            // elseif($rows['Count(AttendID)']==1){
                            //   echo "<td>150</td>";
                            // }
                        }

                        echo "</tr>";
                      echo "</table>";
                  }
                  elseif ($tbname == 'Event') {
                      $acctype = $_GET['acctype'];
                      $from = $_POST['txtFrom'];
                      $to = $_POST['txtTo'];

                      echo "<table cellpadding=9 cellspacing=0 border=0>";
                      echo "<tr>";
                        echo "<td class=head><b>EventID</b></td>";
                        echo "<td class=head><b>EventName</b></td>";
                        echo "<td class=head><b>Venue</b></td>";
                        echo "<td class=head><b>Date</b></td>";
                        echo "</tr>";

                      $query = "SELECT * FROM event";
                      $result = mysqli_query($dbcon, $query);
                      while ($row = mysqli_fetch_array($result)) {
                        if ($row['Date'] >= $from && $row['Date'] <= $to) {
                            echo "<tr>";
                            echo "<td>".$row['EventID']."</td>";
                            echo "<td>".$row['EventName']."</td>";
                            echo "<td>".$row['Venue']."</td>";
                            echo "<td>".$row['Date']."</td>";
                        }
                      }
                       echo "</tr>";
                      echo "</table>";
                  }
              ?>
              </div>          
          </div>
          <div class="button-cancel">
      
          	<?php
                $acctype = $_GET['acctype'];
                $tbname = $_GET['tb'];
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