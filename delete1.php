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
  <title>Delete-Attendance Monitoring System</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
   <div class="modal-del">
        <div class="modal-content-del">
          <div class="imgcontainer-del">
            <?php
              $tbname = $_GET['tb'];
              if ($tbname == 'Student') {
                  echo "<img src=img/student-del-1.png alt=Avatar class=avatar-del>";  
              }
              elseif ($tbname == 'Department') {
                  echo "<img src=img/dept-del.png alt=Avatar class=avatar-del>"; 
              }
              elseif ($tbname == 'Attendance') {
                  echo "<img src=img/attendance-del.png alt=Avatar class=avatar-del>"; 
              }
              elseif ($tbname == 'Event') {
                  echo "<img src=img/calendar-del.png alt=Avatar class=avatar-del>"; 
              }
              elseif ($tbname == 'Course') {
                  echo "<img src=img/course-del-1.png alt=Avatar class=avatar-del>"; 
              }
              elseif ($tbname == 'Section') {
                  echo "<img src=img/section-del-1.png alt=Avatar class=avatar-del>"; 
              }
               elseif ($tbname == 'Security') {
                  echo "<img src=img/security.png alt=Avatar class=avatar-del>"; 
              }
            ?>
          </div>
          
          <?php
               include('config.php');

                if ($tbname == 'Student') {
                
                   $studid = $_GET['id']; 
                   $acctype = $_GET['acctype'];

                   $query = "DELETE  FROM student
                   WHERE StudID = '".$studid."'";

                   mysqli_query($dbcon, $query);
                   
                   echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                   echo "<div class=container-footer1-del>";
                   echo "<a href=student.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Department') {
                     $deptid = $_GET['id']; 
                     $acctype = $_GET['acctype'];

                     $query = "DELETE  FROM department
                     WHERE DeptID = $deptid";

                     mysqli_query($dbcon, $query);
                     
                     echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                     echo "<div class=container-footer1-del>";
                     echo "<a href=department.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Attendance') {
                     $attendid = $_GET['id']; 
                     $acctype = $_GET['acctype'];

                     $query = "DELETE  FROM attendance
                     WHERE AttendID = $attendid";

                     mysqli_query($dbcon, $query);
                     
                     echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                     echo "<div class=container-footer1-del>";

                      echo "<form action=attendance.php?acctype=".$acctype." method=post>";

                      $event = $_GET['event'];
                      $qry = "SELECT * FROM event WHERE EventID = ".$event;
                      $rest = mysqli_query($dbcon, $qry);

                            echo "<select name='cboxEvent' class=select-hidden>";
                            while ($rw = mysqli_fetch_array($rest)) {
                                echo "<option value='".$rw['EventID']."'></option>";
                            }
                                echo "</select>
                            <button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></div></form>";  

                     // echo "<a href=attendance.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Event') {
                     $eventid = $_GET['id']; 
                     $acctype = $_GET['acctype'];

                     $query = "DELETE  FROM event
                     WHERE EventID = $eventid";

                     mysqli_query($dbcon, $query);
                     
                     echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                     echo "<div class=container-footer1-del>";
                     echo "<a href=event.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Course') {
                     $courseid = $_GET['id']; 
                     $acctype = $_GET['acctype'];

                     $query = "DELETE  FROM course
                     WHERE CourseID = $courseid";

                     mysqli_query($dbcon, $query);
                     
                     echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                     echo "<div class=container-footer1-del>";
                     echo "<a href=course.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Section') {
                     $sectid = $_GET['id']; 
                     $acctype = $_GET['acctype'];

                     $query = "DELETE  FROM section
                     WHERE SectionID = '".$sectid."'";

                     mysqli_query($dbcon, $query);
                     
                     echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                     echo "<div class=container-footer1-del>";
                     echo "<a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Security') {
                     $userid = $_GET['id']; 
                     $acctype = $_GET['acctype'];

                     $query = "DELETE  FROM login
                     WHERE  UserID = $userid";

                     mysqli_query($dbcon, $query);
                     
                     echo "<div class=container-del><b class=b-green>*Record deleted successfully!</b><div>";

                     echo "<div class=container-footer1-del>";
                     echo "<a href=home.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
          ?>
        </div>
    </div>
</body>
</html>
