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
   <div class="modal-func-del">
    <?php $tbname = $_GET['tb'];
      if ($tbname == 'Department') { ?>
        <div class="hidden-del"></div>
    <?php } elseif ($tbname == 'Student') { ?>
        <div class="hidden-stud"></div>
    <?php } elseif ($tbname == 'Attendance') { ?>
        <div class="hidden-attend2"></div>
    <?php } elseif ($tbname == 'Course') { ?>
        <div class="hidden-course"></div>
    <?php } elseif ($tbname == 'Section') { ?>
        <div class="hidden-course"></div>
    <?php } elseif ($tbname == 'Event') { ?>
        <div class="hidden-event-del"></div>
    <?php } elseif ($tbname == 'Security') { ?>
        <div class="hidden-sec"></div>
    <?php } ?>

        <div class="modal-content-func">
          <div class="imgcontainer">
            <?php
              $tbname = $_GET['tb'];
              if ($tbname == 'Student') {
                  echo "<img src=img/student-del-1.png alt=Avatar class=avatar-func>";  
              }
              elseif ($tbname == 'Department') {
                  echo "<img src=img/dept-del.png alt=Avatar class=avatar-func>"; 
              }
              elseif ($tbname == 'Attendance') {
                  echo "<img src=img/attendance-del.png alt=Avatar class=avatar-func>"; 
              }
              elseif ($tbname == 'Event') {
                  echo "<img src=img/calendar-del.png alt=Avatar class=avatar-func-cal>"; 
              }
              elseif ($tbname == 'Course') {
                  echo "<img src=img/course-del-1.png alt=Avatar class=avatar-func>"; 
              }
              elseif ($tbname == 'Section') {
                  echo "<img src=img/section-del-1.png alt=Avatar class=avatar-func>"; 
              }
              elseif ($tbname == 'Security') {
                  echo "<img src=img/security.png alt=Avatar class=avatar-func>"; 
              }
            ?>
          </div>

          <?php
               include('config.php');

               if ($tbname == 'Student') {
                   $studid = $_GET['id']; 
                   $acctype = $_GET['acctype'];

                   $query = "SELECT * FROM student JOIN course ON student.CourseID= course.CourseID JOIN section ON student.SectionID = section.SectionID 
                   JOIN department ON department.DeptID=course.DeptID
                   WHERE StudID = '".$studid."'";

                   $result = mysqli_query($dbcon, $query);

                  echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                  echo "<div class=container>";
                   
                   while ($row = mysqli_fetch_array($result)) {
                         echo "<label><b>StudID</b></label>";
                         echo "<div class=input>".$row['StudID']."</div>";
                         echo "<label><b>StudentName</b></label>";
                         echo "<div class=input>".$row['StudName']."</div>";
                         echo "<label><b>Address</b></label>";
                         echo "<div class=input>".$row['Address']."</div>
                         <div class= 'course-sect'>
                         <div class='course-sect1-b'>";
                           echo "<label><b>DeptID</b></label>";
                           echo "<div class=input>".$row['DeptID']."</div>
                          </div>
                          <div class = 'course-sect2-a'>";
                           echo "<label><b>CourseID</b></label>";
                           echo "<div class=input>".$row['CourseID']."</div>
                           </div>
                           <div class = 'course-sect2-b'>";
                            echo "<label><b>SectionID</b></label>";
                           echo "<div class=input>".$row['SectionID']."</div>
                           </div>
                         </div>";
                         echo "<div class=container-footer-func>";
                         echo "<a href=delete1.php?id=".$studid."&acctype=".$acctype."&tb=Student><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                   } 
                   echo "<div class=container-footer1-func>";
                   echo "<a href=student.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Department') {

                       $deptid = $_GET['id']; 
                       $acctype = $_GET['acctype'];

                       $query = "SELECT * FROM department
                       WHERE DeptID = $deptid";

                       $result = mysqli_query($dbcon, $query);

                      echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                      echo "<div class=container>";
                       
                       while ($row = mysqli_fetch_array($result)) {
                             echo "<label><b>DeptID</b></label>";
                             echo "<div class=input>".$row['DeptID']."</div>";
                             echo "<label><b>DeptName</b></label>";
                             echo "<input type='text' class=input value='".$row['DeptName']."'>";
                             echo "<div class=container-footer-func>";
                             echo "<a href=delete1.php?id=".$deptid."&acctype=".$acctype."&tb=Department><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                       } 
                       echo "<div class=container-footer1-func>";
                       echo "<a href=department.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Attendance') {
                           $attendid = $_GET['id']; 
                           $acctype = $_GET['acctype'];
                           $event = $_GET['event'];

                           $query = "SELECT * FROM attendance
                           WHERE AttendID = $attendid";

                           $result = mysqli_query($dbcon, $query);

                          echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                          echo "<div class=container>";
                           
                           while ($row = mysqli_fetch_array($result)) {
                                 echo "<label><b>AttendID</b></label>";
                                 echo "<div class=input-del type='text'>".$row['AttendID']."</div>";
                                 echo "<label><b>Student</b></label>";
                                 echo "<div class=input-del type='text'>".$row['StudID']."</div>";
                                 echo "<label><b>Event</b></label>";
                                 echo "<div class=input-del type='text'>".$row['EventID']."</div>";
                                 echo "<label><b>Time</b></label>";
                                 echo "<div class=input-del type='text'>".$row['AttendTime']."</div>
                                 <div class = ampminout2>
                                    <div class=ampm-del-eve>";
                                     echo "<label><b>Am/Pm</b></label>";
                                     echo "<div class=input-del type='text'>".$row['AmPmID']."</div></div>
                                    <div class=inout>";
                                     echo "<label><b>In/Out</b></label>";
                                     echo "<div class=input-del type='text'>".$row['TimeInOutID']."</div></div>
                                 </div>";
                                 echo "<div class=container-footer-func>";        
                                 echo "<a href=delete1.php?id=".$attendid."&acctype=".$acctype."&tb=Attendance&event=".$event."><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                           } 
                           echo "<div class=container-footer1-func>";

                           echo "<form action=attendance.php?acctype=".$acctype." method=post>";

                            $event = $_GET['event'];
                            $qry = "SELECT * FROM event WHERE EventID = ".$event;
                            $rest = mysqli_query($dbcon, $qry);

                            echo "<select name='cboxEvent' class=select-hidden>";
                            while ($rw = mysqli_fetch_array($rest)) {
                                echo "<option value='".$rw['EventID']."'></option>";
                            }
                                echo "</select>
                            <button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></div></form>";  

                           // echo "<a href=attendance.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                 elseif ($tbname == 'Event') {

                       $eventid = $_GET['id']; 
                       $acctype = $_GET['acctype'];

                       $query = "SELECT * FROM event
                       WHERE EventID = $eventid";

                       $result = mysqli_query($dbcon, $query);

                      echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                      echo "<div class=container>";
                       
                       while ($row = mysqli_fetch_array($result)) {
                             echo "<label><b>EventID</b></label>";
                             echo "<div class=input>".$row['EventID']."</div>";
                             echo "<label><b>EventName</b></label>";
                             echo "<div class=input>".$row['EventName']."</div>";
                             echo "<label><b>Venue</b></label>";
                             echo "<div class=input>".$row['Venue']."</div>
                             <div class=ampminout>
                             <div class=ampm-del-eve>
                             <label><b>Date</b></label>";
                             echo "<div class=input>".$row['Date']."</div>
                             </div>
                             <div class=inout>";
                             echo "<label><b>No of Attendee</b></label>";
                             echo "<div class=input>".$row['NumAttendee']."</div>
                             </div>
                             </div>";
                             echo "<div class=container-footer-func>";
                             echo "<a href=delete1.php?id=".$eventid."&acctype=".$acctype."&tb=Event><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                       } 
                       echo "<div class=container-footer1-func>";
                       echo "<a href=event.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Course') {
                   $courseid = $_GET['id']; 
                   $acctype = $_GET['acctype'];

                   $query = "SELECT * FROM course
                   WHERE CourseID = '".$courseid."'";

                   $result = mysqli_query($dbcon, $query);

                  echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                  echo "<div class=container>";
                   
                   while ($row = mysqli_fetch_array($result)) {
                         echo "<label><b>CourseID</b></label>";
                         echo "<div class=input>".$row['CourseID']."</div>";
                         echo "<label><b>CourseName</b></label>";
                         echo "<div class=input>".$row['CourseName']."</div>";
                         echo "<label><b>DeptID</b></label>";
                         echo "<div class=input>".$row['DeptID']."</div>";
                         echo "<div class=container-footer-func>";
                         echo "<a href=delete1.php?id=".$courseid."&acctype=".$acctype."&tb=Course><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                   } 
                   echo "<div class=container-footer1-func>";
                   echo "<a href=course.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Section') {
                   $sectid = $_GET['id']; 
                   $acctype = $_GET['acctype'];

                   $query = "SELECT * FROM section
                   WHERE SectionID = ".$sectid;

                   $result = mysqli_query($dbcon, $query);

                  echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                  echo "<div class=container>";
                   
                   while ($row = mysqli_fetch_array($result)) {
                         echo "<label><b>SectionID</b></label>";
                         echo "<div class=input>".$row['SectionID']."</div>";
                         echo "<label><b>SectionName</b></label>";
                         echo "<div class=input>".$row['SectionName']."</div>";
                         echo "<label><b>CourseID</b></label>";
                         echo "<div class=input>".$row['CourseID']."</div>";
                         echo "<div class=container-footer-func>";
                         echo "<a href=delete1.php?id=".$sectid."&acctype=".$acctype."&tb=Section><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                   } 
                   echo "<div class=container-footer1-func>";
                   echo "<a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Security') {
                   $userid = $_GET['id']; 
                   $acctype = $_GET['acctype'];

                   $query = "SELECT * FROM login
                   WHERE UserID = '".$userid."'";

                   $result = mysqli_query($dbcon, $query);

                  echo "<b class=b-red>*Are you sure you want to delete data?</b>";
                  echo "<div class=container>";
                   
                   while ($row = mysqli_fetch_array($result)) {
                         echo "<label><b>UserID</b></label>";
                         echo "<div class=input>".$row['UserID']."</div>";
                         echo "<label><b>UserName</b></label>";
                         echo "<div class=input>".$row['UserName']."</div>";
                         echo "<label><b>Password</b></label>";
                         echo "<div class=input>".$row['Password']."</div>";
                         echo "<label><b>AccTypeID</b></label>";
                         echo "<div class=input>".$row['AccTypeID']."</div>";
                         echo "<div class=container-footer-func>";
                         echo "<a href=delete1.php?id=".$userid."&acctype=".$acctype."&tb=Security><button type=submit class=btn>Delete&nbsp;&nbsp;&nbsp;</button></a></div></div>";
                   } 
                   echo "<div class=container-footer1-func>";
                   echo "<a href=home.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                      
          ?>
        </div>
    </div>
</div>
</body>
</html>
