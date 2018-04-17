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
  <title>Edit-Attendance Monitoring System</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <script type="text/javascript" src="jQuery.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#Department").change(function() {
    var id=$(this).val();
    var dataString = 'id='+ id;

      $.ajax ({
        type: "POST",
        url: "ajax_department.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#Course").html(html);
          } 
      });
    });
  });
  </script>
   <script type="text/javascript">
    $(document).ready(function() {
    $("#Course").change(function() {
      var id=$(this).val();
      var dataString = 'id='+ id;

        $.ajax ({
          type: "POST",
          url: "ajax_section.php",
          data: dataString,
          cache: false,
          success: function(html) {
            $("#Section").html(html);
            } 
        });
      });
    });
  </script>
</head>
<body>
<div class="body-fixed">
    <div class="modal-func-edit">
    <?php $tbname = $_GET['tb'];
      if ($tbname == 'Department')  { ?>
        <div class="hidden-del"></div>
    <?php } elseif ($tbname == 'Student') { ?>
        <div class="hidden-stud-one"></div>
    <?php } elseif ($tbname == 'Course') { ?>
        <div class="hidden-course"></div>
    <?php } elseif ($tbname == 'Section') { ?>
        <div class="hidden-course"></div>
    <?php } elseif ($tbname == 'Event') { ?>
        <div class="hidden-event1"></div>
    <?php } elseif ($tbname == 'Attendance') { ?>
        <div class="hidden-attend1"></div>
    <?php } elseif ($tbname == 'Security') { ?>
        <div class="hidden-insert-secu1"></div> 
    <?php } ?>
        <?php 
         if ($tbname == 'Student') {
        ?>
          <div class="modal-content-func-student-wide">
        <?php
         }else{
        ?>
          <div class="modal-content-func">
        <?php
         }
        ?>
          <div class="imgcontainer">
             <?php
              $tbname = $_GET['tb'];
              if ($tbname == 'Student') {
                  echo "<img src=img/student-edit-1.png alt=Avatar class=avatar-func>";  
              }
              elseif ($tbname == 'Department') {
                  echo "<img src=img/dept-edit.png alt=Avatar class=avatar-func>"; 
              }
              elseif ($tbname == 'Attendance') {
                  echo "<img src=img/attendance-edit-1.png alt=Avatar class=avatar-func-att>"; 
              }
              elseif ($tbname == 'Event') {
                  echo "<img src=img/calendar-edit.png alt=Avatar class=avatar-func-cal>"; 
              }
              elseif ($tbname == 'Course') {
                  echo "<img src=img/course-edit.png alt=Avatar class=avatar-func>"; 
              }
              elseif ($tbname == 'Section') {
                  echo "<img src=img/section-edit-1.png alt=Avatar class=avatar-func>"; 
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

                     $query = "SELECT * FROM student
                     WHERE StudID = '".$studid."'";

                     $qry = "SELECT * FROM department";

                     $result = mysqli_query($dbcon, $query);
                     $result1 = mysqli_query($dbcon, $qry);
                     
                    echo "<form class=container action=update.php?acctype=".$acctype."&tb=Student method=POST>";
                     
                     while ($row = mysqli_fetch_array($result)) {
                           echo "<label><b>StudID</b></label>";
                           echo "<div class=hide></div>";
                           echo "<input class=input-edit type='text' name='id' value='".$row['StudID']."'>";
                           echo "<label><b>StudentName</b></label>";
                           echo "<input class=input-edit type='text' name='name' value='".$row['StudName']."' required=''>";
                           echo "<label><b>Address</b></label>";
                           echo "<input class=input-edit type='text' name='address' value='".$row['Address']."' required=''>";
                           echo "<label><b>Department</b></label>";
                           echo "<select class=select-att1 name='cboxDepartment' id='Department' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                             while ($row1 = mysqli_fetch_array($result1)) {
                               echo "<option value='".$row1['DeptID']."'>".$row1['DeptName']."</option>";
                             }
                             echo "</select>";

                           echo "<div class='course-sect'>";
                           echo "<div class='course-sect1-a-wide'>";
                             echo "<label><b>Course</b></label>";
                             echo "<select class=select-att1-small name='cboxCourse' id='Course'>";
                               echo "<option>--Course--</option>";
                             echo "</select>
                          </div>
                          <div class=course-sect2-wide>"; 
                             echo "<label><b>Section</b></label>";
                             echo "<select name='cboxSection' id='Section' class='select-att1'>
                              <option>--Section--</option>
                             </select>
                           </div>
                          </div>";
                           echo "<div class=container-footer-func>";
                           echo "<button type=submit class=btn2>Update</button></div>";
                     } 
                     echo "</form>";
                     echo "<div class=container-footer1-func>";
                     echo "<a href=student.php?acctype=".$acctype."><button type=submit class=btn1>Back</button></a></div>";
                }
                elseif ($tbname == 'Department') {
                     $deptid = $_GET['id'];
                     $acctype = $_GET['acctype'];

                     $query = "SELECT * FROM department
                     WHERE DeptID = '$deptid'";

                     $result = mysqli_query($dbcon, $query);
                     
                    echo "<form class=container action=update.php?acctype=".$acctype."&tb=Department method=POST>";
                     
                     while ($row = mysqli_fetch_array($result)) {
                           echo "<label><b>DeptID</b></label>";
                           echo "<div class=hide></div>";
                           echo "<input class=input-edit type='text' name='id' value='".$row['DeptID']."'>";
                           echo "<label><b>DeptName</b></label>";
                           echo "<input class=input-edit type='text' name='deptname' value='".$row['DeptName']."' required=''>";
                           echo "<div class=container-footer-func>";
                           echo "<button type=submit class=btn2>Update&nbsp;&nbsp;&nbsp;</button></div>";
                     } 
                     echo "</form>";
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
                         
                        echo "<form class=container action=update.php?acctype=".$acctype."&tb=Attendance&event=".$event." method=POST>";

                        $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                $rest = mysqli_query($dbcon, $qry);

                                echo "<select name='cboxEvent' class=select-hidden>";
                                  while ($rw = mysqli_fetch_array($rest)) {
                                    echo "<option value='".$rw['EventID']."'></option>";
                                  }
                                  echo "</select>";
                         
                         while ($row = mysqli_fetch_array($result)) {
                               echo "<label><b>AttendID</b></label>";
                               echo "<div class=hide></div>";
                               echo "<input class=input-edit type='text' name='id' value='".$row['AttendID']."' disable=true>";
                               echo "<label><b>Student</b></label>";

                               $qry = "SELECT StudID FROM attendance WHERE AttendID ='".$attendid."'";
                               $result1 = mysqli_query($dbcon, $qry);
                               while ($rows = mysqli_fetch_array($result1)) {
                                 echo "<input type='text'  class=input-edit name='txtStudent' value=".$row['StudID']." required=''>";
                               }
                               
                               echo "<label><b>Event</b></label>";

                               $qry1 = "SELECT * FROM event";
                               $result2 = mysqli_query($dbcon, $qry1);
                               echo "<select class=select-attend1 name='cboxEvent' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                                 while ($row2 = mysqli_fetch_array($result2)) {
                                    echo "<option value='".$row2['EventID']."'>".$row2['EventName']."</option>";
                                 }
                               echo "</select>";
                               echo "<label><b>Time</b></label>";
                               echo "<input class=input-edit type='text' name='time' value='".$row['AttendTime']."' required=''>";

                               echo "<div class=ampminout1>
                               <div class=ampm-del-eve>";
                                   echo "<label><b>Am/Pm</b></label>";
                                   $qry1 = "SELECT * FROM ampm";
                                   $result2 = mysqli_query($dbcon, $qry1);
                                   echo "<select class=input-edit name='cboxAmPm' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                                     while ($row2 = mysqli_fetch_array($result2)) {
                                        echo "<option value='".$row2['AmPmID']."'>".$row2['AmPmName']."</option>";
                                     }
                                    echo "</select>
                                </div>
                                <div class=inout>";
                                    echo "<label><b>In/Out</b></label>";
                                    $qry1 = "SELECT * FROM timeinout";
                                    $result2 = mysqli_query($dbcon, $qry1);
                                    echo "<select class=input-edit name='cboxInOut' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                                     while ($row2 = mysqli_fetch_array($result2)) {
                                        echo "<option value='".$row2['TimeInOutID']."'>".$row2['TimeInOutName']."</option>";
                                     }
                                    echo "</select>
                                  </div>";
                                echo "</div>";

                               echo "<div class=container-footer-func>";
                               echo "<button type=submit class=btn2>Update&nbsp;&nbsp;&nbsp;</button></div></form>";
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
                                  echo "</select>";

                           echo "<button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></div></form>";
                  
                }
                elseif ($tbname == 'Event') {
                     $eventid = $_GET['id'];
                     $acctype = $_GET['acctype'];

                     $query = "SELECT * FROM event
                     WHERE EventID = '$eventid'";

                     $result = mysqli_query($dbcon, $query);
                     
                    echo "<form class=container action=update.php?acctype=".$acctype."&tb=Event method=POST>";
                     
                     while ($row = mysqli_fetch_array($result)) {
                           echo "<label><b>EventID</b></label>";
                           echo "<div class=hide></div>";
                           echo "<input class=input-edit type='text' name='id' value='".$row['EventID']."'>";
                           echo "<label><b>EventName</b></label>";
                           echo "<input class=input-edit type='text' name='eventname' value='".$row['EventName']."' required=''>";
                           echo "<label><b>Venue</b></label>";
                           echo "<input class=input-edit type='text' name='venue' value='".$row['Venue']."' required=''>
                           <div class=ampminout>
                           <div class=ampm-del-eve>";
                             echo "<label><b>Date</b></label>";
                             echo "<input class=input-edit type='text' name='date' value='".$row['Date']."' required=''></div>
                           <div class=inout>";  
                           echo "<label><b>No. of Attendee</b></label>";
                           echo "<input class=input-edit type='text' name='numattend' value='".$row['NumAttendee']."' required=''>";
                           echo "</div></div>";
                           echo "<div class=container-footer-func>";
                           echo "<button type=submit class=btn2>Update&nbsp;&nbsp;&nbsp;</button></div>";
                     } 
                     echo "</form>";
                     echo "<div class=container-footer1-func>";
                     echo "<a href=event.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Course') {
                     $courseid = $_GET['id'];
                     $acctype = $_GET['acctype'];

                     $query = "SELECT * FROM course WHERE CourseID = '$courseid'";
                     $qry = "SELECT * FROM department";
                     $res = mysqli_query($dbcon, $qry);
                     $result = mysqli_query($dbcon, $query);
                     
                    echo "<form class=container action=update.php?acctype=".$acctype."&tb=Course method=POST>";
                     
                     while ($row = mysqli_fetch_array($result)) {
                           echo "<label><b>CourseID</b></label>";
                           echo "<div class=hide></div>";
                           echo "<input class=input-edit type='text' name='id' value='".$row['CourseID']."'>";
                           echo "<label><b>CourseName</b></label>";
                           echo "<input class=input-edit type='text' name='coursename' value='".$row['CourseName']."' required=''>";
                           echo "<label><b>Department</b></label>";
                           echo "<select class=select-att name='cboxDepartment' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                              while ($row = mysqli_fetch_array($res)) {
                                echo "<option value='".$row['DeptID']."'>".$row['DeptName']."</option>";
                              }
                           echo "</select>";
                           echo "<div class=container-footer-func>";
                           echo "<button type=submit class=btn2>Update&nbsp;&nbsp;&nbsp;</button></div>";
                     } 
                     echo "</form>";
                     echo "<div class=container-footer1-func>";
                     echo "<a href=course.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                 elseif ($tbname == 'Section') {
                     $sectid = $_GET['id'];
                     $acctype = $_GET['acctype'];

                     $query = "SELECT * FROM section WHERE SectionID = '$sectid'";
                     $qry = "SELECT * FROM course";
                     $res = mysqli_query($dbcon, $qry);
                     $result = mysqli_query($dbcon, $query);
                     
                    echo "<form class=container action=update.php?acctype=".$acctype."&tb=Section method=POST>";
                     
                     while ($row = mysqli_fetch_array($result)) {
                           echo "<label><b>SectionID</b></label>";
                           echo "<div class=hide></div>";
                           echo "<input class=input-edit type='text' name='id' value='".$row['CourseID']."'>";
                           echo "<label><b>SectionName</b></label>";
                           echo "<input class=input-edit type='text' name='sectionname' value='".$row['SectionName']."' required=''>";
                           echo "<label><b>Course</b></label>";
                           echo "<select class=select-att name='cboxCourse' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                              while ($row = mysqli_fetch_array($res)) {
                                echo "<option value='".$row['CourseID']."'>".$row['CourseName']."</option>";
                              }
                           echo "</select>";
                           echo "<div class=container-footer-func>";
                           echo "<button type=submit class=btn2>Update&nbsp;&nbsp;&nbsp;</button></div>";
                     } 
                     echo "</form>";
                     echo "<div class=container-footer1-func>";
                     echo "<a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
                elseif ($tbname == 'Security') {
                     $userid = $_GET['id'];
                     $acctype = $_GET['acctype'];

                     $query = "SELECT * FROM login WHERE UserID = '".$userid."'";
                     $qry = "SELECT * FROM accounttype";
                     $res = mysqli_query($dbcon, $qry);
                     $result = mysqli_query($dbcon, $query);
                     
                    echo "<form class=container action=update.php?acctype=".$acctype."&tb=Security method=POST>";
                     
                     while ($row = mysqli_fetch_array($result)) {
                           echo "<label><b>UserID</b></label>";
                           echo "<div class=hide></div>";
                           echo "<input class=input-edit type='text' name='id' value='".$row['UserID']."'>";
                           echo "<label><b>UserName</b></label>";
                           echo "<input class=input-edit type='text' name='user' value='".$row['UserName']."'>";
                           echo "<label><b>Password</b></label>";
                           echo "<input class=input-edit type='password' name='password' value='".$row['Password']."'>";
                           echo "<label><b>Accout Type</b></label>";
                           echo "<select class=select-att name='cboxAccount' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                              while ($row = mysqli_fetch_array($res)) {
                                echo "<option value='".$row['AccTypeID']."'>".$row['AccountName']."</option>";
                              }
                           echo "</select>";
                           echo "<div class=container-footer-func>";
                           echo "<button type=submit class=btn2>Update&nbsp;&nbsp;&nbsp;</button></div>";
                     } 
                     echo "</form>";
                     echo "<div class=container-footer1-func>";
                     echo "<a href=home.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                }
          ?>
        </div>
    </div>
</div>
</body>
</html>