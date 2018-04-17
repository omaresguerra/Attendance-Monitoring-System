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
  <title>Update-Attendance Monitoring System</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
   <div class="modal-func">
    <?php $tbname = $_GET['tb'];
      if ($tbname == 'Department') { ?>
        <div class="hidden-del-upd"></div>
    <?php } elseif ($tbname == 'Student') { ?>
        <div class="hidden-stud"></div>
    <?php } elseif ($tbname == 'Attendance') { ?>
        <div class="hidden-attend"></div>
    <?php } elseif ($tbname == 'Event') { ?>
        <div class="hidden-event"></div>
    <?php } elseif ($tbname == 'Course') { ?>
        <div class="hidden-course-upd"></div>
    <?php } elseif ($tbname == 'Section') { ?>
        <div class="hidden-course-upd-1"></div>
    <?php } elseif ($tbname == 'Security') { ?>
        <div class="hidden-sec1"></div>
    <?php } ?>
        <div class="modal-content-func1">
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
                  echo "<img src=img/attendance-edit.png alt=Avatar class=avatar-func-att>"; 
              }
              elseif ($tbname == 'Event') {
                  echo "<img src=img/calendar-edit.png alt=Avatar class=avatar-func>"; 
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
                $acctype = $_GET['acctype'];

                if ($tbname == 'Student'){

                    $studid = $_POST['id'];
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $course = $_POST['cboxCourse'];
                    $section = $_POST['cboxSection'];

                    if (empty($_POST['name']) || empty($_POST['address'])|| $_POST['cboxSection']==0 || $_POST['cboxCourse'] == 0) {
                        $query0A = "SELECT CourseName FROM course
                          WHERE CourseID = '".$course."'";
                        $result0A = mysqli_query($dbcon, $query0A);

                        echo "<div class=container>

                        <label><b>StudID</b></label>";
                        echo "<div class=input>";
                        echo "$studid";
                        echo "</div>

                        <label><b>Name</b></label>

                        <div class=input>";
                        echo "$name";
                        echo "</div>

                        <label><b>Address</b></label>

                        <div class=input>";
                        echo "$address";
                        echo "</div>

                        <div class = 'course-sect'>
                        <div class = 'course-sect1-a'>
                            <label><b>Course</b></label>

                            <div class=input>";
                            while ($row0A=mysqli_fetch_array($result0A)) {
                                $acct0A = $row0A['CourseName'];
                                echo "$acct0A";
                            } 
                            echo "</div>
                        </div>
                        <div class = 'course-sect2'>";

                           $queryA = "SELECT SectionName FROM section
                              WHERE SectionID = '".$section."'";
                            $resultA = mysqli_query($dbcon, $queryA);
                            echo " <label><b>Course</b></label>
                            <div class=input>";

                            while ($rowA=mysqli_fetch_array($resultA)) {
                                $acctA = $rowA['SectionName'];
                                echo "$acctA";
                            } 
                            echo "</div>
                        </div>
                        </div>

                        <div class=update>
                        <b style=color:#f00;>**Can't update record. Data/s is/are  empty!</b>
                        </div>";
                        echo "<div class=container-footer-func1>
                           <a href=student.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                    }
                    else{
                        $query = "UPDATE student SET StudID='".$studid."', StudName='".$name."', Address='".$address."', CourseID='".$course."', SectionID='".$section."' WHERE StudID='".$studid."'";

                        $query0A = "SELECT CourseName FROM course
                          WHERE CourseID = '".$course."'";

                        if(mysqli_query($dbcon, $query)){

                        $result0A = mysqli_query($dbcon, $query0A);

                        echo "<div class=container>

                        <label><b>StudID</b></label>";
                        echo "<div class=input>";
                        echo "$studid";
                        echo "</div>

                        <label><b>Name</b></label>

                        <div class=input>";
                        echo "$name";
                        echo "</div>

                        <label><b>Address</b></label>

                        <div class=input>";
                        echo "$address";
                        echo "</div>

                        <div class = 'course-sect'>
                        <div class = 'course-sect1-a'>
                            <label><b>Course</b></label>
                            <div class=input-dept-ins>";
                            while ($row0A=mysqli_fetch_array($result0A)) {
                                $acct0A = $row0A['CourseName'];
                                echo "$acct0A";
                            }
                            echo "</div>
                        </div>
                        <div class= 'course-sect2'>
                            <label><b>Course</b></label>
                            <div class=input-dept-ins>";
                            $queryB = "SELECT SectionName FROM section WHERE SectionID ='".$section."'";
                            $resultB = mysqli_query($dbcon, $queryB);
                            while ($rowB=mysqli_fetch_array($resultB)) {
                                $acctB = $rowB['SectionName'];
                                echo "$acctB";
                            }
                            echo "</div>
                        </div>
                        </div>
                        <div class=update>
                        <b style=color:#00d600;>*Data updated successfully!</b>
                        </div>";

                        }else{
                            echo "<h2>Error</h2>".mysqli_error($dbcon);
                        } 
                        echo "<div class=container-footer-func1>
                          <a href=student.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a></div>";
                    }
                }
                elseif ($tbname == 'Department') {

                        $deptid = $_POST['id'];
                        $name = $_POST['deptname'];

                        if (empty($_POST['deptname'])) {
                            $query0A = "SELECT * FROM department WHERE DeptID = '".$deptid;
                            $result0A = mysqli_query($dbcon, $query0A);
                            echo "<div class=container>
                            <label><b>DeptName</b></label>";
                            echo "<input type='text' class=input placeholder='".$name."'>
                            <div class=update>
                            <b style=color:#f00;>**DeptName is empty!</b>
                            </div>";
                            echo "<div class=container-footer-func1>
                                <a href=department.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        }
                        else{

                             $query = "UPDATE department SET DeptName='$name' WHERE DeptID='$deptid'";

                             if(mysqli_query($dbcon, $query)){

                            echo "<div class=container>
                            <label><b>DeptName</b></label>";
                            echo "<input type='text' class=input value ='".$name."'>
                            <div class=update>
                            <b style=color:#00d600;>*Data updated successfully!</b>
                            </div>";
                            }
                            else{
                              echo "<h3>Error!</h3>".mysqli_error($dbcon);
                            }
                            echo "<div class=container-footer-func1>
                                <a href=department.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                    }                    
                }
                elseif ($tbname == 'Attendance') {

                        $attendid = $_POST['id'];
                        $stud = $_POST['txtStudent'];
                        $event = $_POST['cboxEvent'];
                        $attendtime = $_POST['time'];
                        $ampm = $_POST['cboxAmPm'];
                        $inout = $_POST['cboxInOut'];


                        $qry = "SELECT StudID, EventID FROM attendance WHERE StudID = '".$stud."' AND EventID = '".$event. "' AND AmPmID = '".$ampm."' AND TimeInOutID = '".$inout."'";
                        $res1 = mysqli_query($dbcon, $qry);
                        $count = mysqli_num_rows($res1);

                        if(empty($_POST['time']) || empty($_POST['txtStudent'])){
                           
                        $qry="SELECT EventName, AmPmName, TimeInOutName FROM event
                               JOIN attendance ON event.EventID=attendance.EventID 
                               JOIN ampm ON ampm.AmPmID=attendance.AmPmID
                               JOIN timeinout ON timeinout.TimeInOutID=attendance.TimeInOutID
                               WHERE AttendID = $attendid";
                            $res = mysqli_query($dbcon, $qry);

                            echo "<div class=container>
                            <label><b>AttendID</b></label>";
                            echo "<div class=input>";
                            echo "$attendid";
                            echo "</div>
                            ";
                            echo "<label><b>Student</b></label>
                                <div class=input>
                                $stud
                                </div>";

                            while ($row=mysqli_fetch_array($res)) {
                                $event = $row['EventName'];                       
                                $am = $row['AmPmName'];
                                $in = $row['TimeInOutName'];
                            }
                                echo "<label><b>Events</b></label>
                                <div class=input>
                                $event
                                </div>";
                            
                                echo "<label><b>AttendTime</b></label>
                                <div class=input>
                                $attendtime
                                </div>";

                                echo "<div class=ampminout-1>
                                <div class=ampm-del-eve>";
                                    echo "<label><b>Am/Pm</b></label>
                                    <div class=input-edit>
                                    $am
                                    </div>
                                </div>";
                                echo "<div class=inout>";
                                    echo "<label><b>In/Out</b></label>
                                    <div class=input-edit>
                                    $in
                                    </div>
                                </div>";
                            echo "</div>";

                            echo "<div class=update1>
                            <b style=color:#f00;>**Can't update record. Data/s is/are empty!</b>
                            </div>";
                            echo "<div class=container-footer-func1>";
                            echo "<form action=attendance.php?acctype=".$acctype." method=post>";

                                $event = $_GET['event'];
                                $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                $rest = mysqli_query($dbcon, $qry);

                                echo "<select name='cboxEvent' class=select-hidden>";
                                  while ($rw = mysqli_fetch_array($rest)) {
                                    echo "<option value='".$rw['EventID']."'></option>";
                                  }
                                  echo "</select>
                                <button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></form>";          
                        }
                        elseif ($count == 1) {
                            echo "<div class=container>
                            <label><b>AttendID</b></label>";
                            echo "<div class=input>";
                            echo "$attendid";
                            echo "</div>
                            ";
                            echo "<label><b>Student</b></label>
                                <div class=input>
                                $stud
                                </div>";

                            Echo "<label><b>Events</b></label>
                                <div class=input>
                                $event
                                </div>";
                            
                                echo "<label><b>AttendTime</b></label>
                                <div class=input>
                                $attendtime
                                </div>";

                                echo "<div class=ampminout-1>
                                <div class=ampm-del-eve>";
                                    echo "<label><b>Am/Pm</b></label>
                                    <div class=input-edit>
                                    $ampm
                                    </div>
                                </div>";
                                echo "<div class=inout>";
                                    echo "<label><b>In/Out</b></label>
                                    <div class=input-edit>
                                    $inout
                                    </div>
                                </div>";
                            echo "</div>";

                           echo "<div class=update1>
                            <b style=color:#f00;>**Can't update record. Data already exist!</b>
                            </div>";
                            echo "<div class=container-footer-func1>";

                            echo "<form action=attendance.php?acctype=".$acctype." method=post>";

                            $event = $_GET['event'];
                            $qry = "SELECT * FROM event WHERE EventID = ".$event;
                            $rest = mysqli_query($dbcon, $qry);

                            echo "<select name='cboxEvent' class=select-hidden>";
                            while ($rw = mysqli_fetch_array($rest)) {
                                echo "<option value='".$rw['EventID']."'></option>";
                            }
                                echo "</select>
                                <button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></form>";             
                        }
                        else{
                            $qry = "SELECT COUNT(StudID) FROM student WHERE StudID = '".$stud."'";
                            $res = mysqli_query($dbcon, $qry);
                            while ($row1=mysqli_fetch_array($res)) {
                                if ($row1[0] == 0) {
                                    $qry="SELECT EventName, AmPmName, TimeInOutName FROM event
                                       JOIN attendance ON event.EventID=attendance.EventID 
                                       JOIN ampm ON ampm.AmPmID=attendance.AmPmID
                                       JOIN timeinout ON timeinout.TimeInOutID=attendance.TimeInOutID
                                       WHERE AttendID = $attendid";
                                    $res = mysqli_query($dbcon, $qry);

                                    echo "<div class=container>
                                    <label><b>AttendID</b></label>";
                                    echo "<div class=input>";
                                    echo "$attendid";
                                    echo "</div>
                                    ";
                                    echo "<label><b>Student</b></label>
                                        <div class=input>
                                        $stud
                                        </div>";

                                    while ($row=mysqli_fetch_array($res)) {
                                        $event = $row['EventName'];                       
                                        $am = $row['AmPmName'];
                                        $in = $row['TimeInOutName'];
                                    }
                                        echo "<label><b>Events</b></label>
                                        <div class=input>
                                        $event
                                        </div>";
                                    
                                        echo "<label><b>AttendTime</b></label>
                                        <div class=input>
                                        $attendtime
                                        </div>";

                                        echo "<div class=ampminout2>
                                        <div class=ampm-del-eve>";
                                            echo "<label><b>Am/Pm</b></label>
                                            <div class=input>
                                            $am
                                            </div>
                                        </div>";
                                        echo "<div class=inout>";
                                            echo "<label><b>In/Out</b></label>
                                            <div class=input>
                                            $in
                                            </div>
                                        </div>";
                                    echo "</div>";
                                    echo "<div class=update1>
                                    <b style=color:#f00;>**Can't update record. StudID doesn't exist!</b>
                                    </div>";
                                    echo "<div class=container-footer-func1>";

                                    echo "<form action=attendance.php?acctype=".$acctype." method=post>";

                                    $event = $_GET['event'];
                                    $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                    $rest = mysqli_query($dbcon, $qry);

                                    echo "<select name='cboxEvent' class=select-hidden>";
                                    while ($rw = mysqli_fetch_array($rest)) {
                                        echo "<option value='".$rw['EventID']."'></option>";
                                    }
                                    echo "</select>
                                    
                                    <button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></form>";          
                                }
                                else{
                                    $query = "UPDATE attendance SET StudID='".$stud."', EventID='".$event."', AttendTime='".$attendtime."',AmPmID='".$ampm."',TimeInOutID='".$inout."' WHERE AttendID='".$attendid."'";
                                    // $query2 = "SELECT * FROM student JOIN attendance ON student.StudID=attendance.StudID
                                    //     JOIN event ON event.EventID=attendance.EventID
                                    //     JOIN ampm ON ampm.AmPmID = attendance.AmPmID 
                                    //     JOIN timeinout ON timeinout.TimeInOutID=attendance.TimeInOutID
                                    //     WHERE AttendID = $attendid";

                                    $result = mysqli_query($dbcon, $query);
                                    // $result2 = mysqli_query($dbcon, $query2);
                                    // while ($row=mysqli_fetch_array($result2)) {
                                    //     $attend = $row['AttendID'];
                                    //     $stud = $row['StudName'];
                                    //     $event = $row['EventName'];
                                    //     $time = $row['AttendTime'];
                                    //     $ampm = $row['AmPmName'];
                                    //     $inout = $row['TimeInOutName'];
                                    // }
                                    echo"<div class=container>
                                    <label><b>Attend ID</b></label>
                                    <div class=input>";
                                    echo "$attendid";

                                    echo "</div><label><b>Student</b></label>
                                    <div class=input>";
                                    echo "$stud";
                                    echo "</div>

                                    <label><b>Event</b></label>
                                    <div class=input>";
                                    echo "$event";
                                    echo "</div>

                                    <label><b>Time</b></label>
                                    <div class=input>";
                                    echo "$attendtime";
                                    echo "</div>

                                    <div class=ampminout2>
                                        <div class=ampm-del-eve>
                                            <label><b>AmPm</b></label>
                                            <div class=input>";
                                            echo "$ampm";
                                            echo "</div>
                                        </div>
                                        <div class=inout>
                                            <label><b>In/Out</b></label>
                                            <div class=input>";
                                            echo "$inout";
                                            echo "</div>
                                        </div>
                                    </div>
                                    <div class=update1>
                                    <b style=color:#00d600;>*Data updated successfully!</b>
                                    </div>
                                    <div class=container-footer-func1>";

                                     echo "<form action=attendance.php?acctype=".$acctype." method=post>";

                                    $event = $_GET['event'];
                                    $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                    $rest = mysqli_query($dbcon, $qry);

                                    echo "<select name='cboxEvent' class=select-hidden>";
                                    while ($rw = mysqli_fetch_array($rest)) {
                                        echo "<option value='".$rw['EventID']."'></option>";
                                    }
                                     echo "</select>
                                    <button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></form>";          
                                }
                            }
                        }
                }        
                elseif ($tbname == 'Event') {

                        $eventid = $_POST['id'];
                        $name = $_POST['eventname'];
                        $venue = $_POST['venue'];
                        $date = $_POST['date'];
                        $num = $_POST['numattend'];

                        if (empty($_POST['eventname']) || empty($_POST['venue']) || empty($_POST['date']) || empty($_POST['numattend']) || $num<=0) {
                            $query0A = "SELECT * FROM event WHERE EventID = '".$eventid;
                            $result0A = mysqli_query($dbcon, $query0A);
                            echo "<div class=container>
                            <label><b>EventName</b></label>";
                            echo "<div class=input>";
                            echo "$name";
                            echo "</div>
                            <label><b>Venue</b></label>";
                            echo "<div class=input>";
                            echo "$venue";
                            echo "</div>
                            <div class=ampminout3>
                                <div class=ampm-del-eve>
                                    <label><b>Date</b></label>";
                                    echo "<div class=input>";
                                    echo "$date";
                                    echo "</div>
                                    </div>
                                <div class=inout>
                                    <label><b>No. of Attendee </b></label>";
                                    echo "<div class=input>";
                                    echo "$num";
                                    echo "</div>
                                </div>
                            </div>
                            <div class=update>
                            <b style=color:#f00;>**Can't update record. Invalid input! </b>
                            </div>";
                            echo "<div class=container-footer-func1>
                                <a href=event.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        }
                        else{

                             $query = "UPDATE event SET EventName='".$name."',Venue='".$venue."',Date='".$date."',NumAttendee = '".$num."' WHERE EventID='".$eventid."'";

                             if(mysqli_query($dbcon, $query)){

                            echo "<div class=container>
                            <label><b>EventName</b></label>";
                            echo "<div class=input>";
                            echo "$name";
                            echo "</div>
                             <label><b>Venue</b></label>";
                            echo "<div class=input>";
                            echo "$venue";
                            echo "</div>
                            <div class=ampminout3>
                                <div class=ampm-del-eve>
                                    <label><b>Date</b></label>";
                                    echo "<div class=input>";
                                    echo "$date";
                                    echo "</div>
                                </div>
                                <div class=inout>
                                    <label><b>No of Attendee</b></label>";
                                    echo "<div class=input>";
                                    echo "$num";
                                    echo "</div>
                                </div>
                            </div>
                            <div class=update>
                            <b style=color:#00d600;>*Data updated successfully!</b>
                            </div>";
                            }
                            else{
                              echo "<h3>Error!</h3>".mysqli_error($dbcon);
                            }
                            echo "<div class=container-footer-func1>
                                <a href=event.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                    }                    
                }
                 elseif ($tbname == 'Course') {

                        $courseid = $_POST['id'];
                        $name = $_POST['coursename'];
                        $dept = $_POST['cboxDepartment'];

                        if (empty($_POST['coursename'])) {
                            $query0A = "SELECT * FROM course WHERE CourseID = '".$courseid."'";
                            $qry = "SELECT * FROM department WHERE DeptID='".$dept."'";
                            $res = mysqli_query($dbcon, $qry);
                            $result0A = mysqli_query($dbcon, $query0A);
                            echo "<div class=container>
                            <label><b>CourseName</b></label>";
                            echo "<input type='text' class=input placeholder='".$name."'>
                            <label><b>Department</b></label>";
                            echo "<input type'text' class=input value=";
                             while ($row=mysqli_fetch_array($res)) {
                                $acct0A = $row['DeptName'];
                                echo "'".$acct0A."'";
                            } 
                            echo ">
                            <div class=update>
                            <b style=color:#f00;>**CourseName is empty!</b>
                            </div>";
                            echo "<div class=container-footer-func1>
                                <a href=course.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        }
                        else{
                            $query = "UPDATE course SET CourseName='".$name."', DeptID='".$dept."' WHERE CourseID='".$courseid."'";
                            $qry = "SELECT * FROM department WHERE DeptID='".$dept."'";
                            $res = mysqli_query($dbcon, $qry);
                            if(mysqli_query($dbcon, $query)){
                            echo "<div class=container>
                            <label><b>CourseName</b></label>";
                            echo "<input type='text' class=input value ='".$name."'>
                             <label><b>DeptID</b></label>";
                            echo "<input type='text' class=input value =";
                                while ($row=mysqli_fetch_array($res)) {
                                $acct0A = $row['DeptName'];
                                echo "'".$acct0A."'";
                                } 
                            echo ">
                            <div class=update>
                            <b style=color:#00d600;>*Data updated successfully!</b>
                            </div>";
                            }
                            else{
                              echo "<h3>Error!</h3>".mysqli_error($dbcon);
                            }
                            echo "<div class=container-footer-func1>
                                <a href=course.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                    }                    
                }

                elseif ($tbname == 'Section') {

                        $sectid = $_POST['id'];
                        $name = $_POST['sectionname'];
                        $course = $_POST['cboxCourse'];

                        $query = "SELECT SectionName FROM section WHERE SectionName = '".$name."'";
                        $result = mysqli_query($dbcon, $query);
                        $count = mysqli_num_rows($result);

                        if (empty($_POST['sectionname'])) {
                            $qry = "SELECT * FROM course WHERE CourseID='".$course."'";
                            $res = mysqli_query($dbcon, $qry);

                            echo "<div class=container>
                            <label><b>CourseName</b></label>";
                            echo "<input type='text' class=input placeholder='".$name."'>
                            <label><b>Department</b></label>";
                            echo "<input type'text' class=input value=";
                             while ($row=mysqli_fetch_array($res)) {
                                $acct = $row['CourseName'];
                                echo "'".$acct."'";
                            } 
                            echo ">
                            <div class=update>
                            <b style=color:#f00;>**SectionName is empty!</b>
                            </div>";
                            echo "<div class=container-footer-func1>
                                <a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        }
                        elseif ($count == 1) {
                            $qry = "SELECT * FROM course WHERE CourseID='".$course."'";
                            $res = mysqli_query($dbcon, $qry);
                            echo "<div class=container>
                            <label><b>CourseName</b></label>";
                            echo "<input type='text' class=input placeholder='".$name."'>
                            <label><b>Department</b></label>";
                            echo "<input type'text' class=input value=";
                             while ($row=mysqli_fetch_array($res)) {
                                $acct = $row['CourseName'];
                                echo "'".$acct."'";
                            } 
                            echo ">
                            <div class=update>
                            <b style=color:#f00;>**Can't update record! Data already exist. </b>
                            </div>";
                            echo "<div class=container-footer-func1>
                                <a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        }
                        else{
                            $query = "UPDATE section SET SectionName='".$name."', CourseID='".$course."' WHERE SectionID='".$sectid."'";
                            $qry = "SELECT * FROM course WHERE CourseID='".$course."'";
                            $res = mysqli_query($dbcon, $qry);
                            if(mysqli_query($dbcon, $query)){
                            echo "<div class=container>
                            <label><b>SectionName</b></label>";
                            echo "<input type='text' class=input value ='".$name."'>
                             <label><b>Course</b></label>";
                            echo "<input type='text' class=input value =";
                                while ($row=mysqli_fetch_array($res)) {
                                $acct0A = $row['CourseName'];
                                echo "'".$acct0A."'";
                                } 
                            echo ">
                            <div class=update>
                            <b style=color:#00d600;>*Data updated successfully!</b>
                            </div>";
                            }
                            else{
                              echo "<h3>Error!</h3>".mysqli_error($dbcon);
                            }
                            echo "<div class=container-footer-func1>
                                <a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                    }                    
                }

                elseif ($tbname == 'Security') {

                        $id = $_POST['id'];
                        $name = $_POST['user'];
                        $pass = $_POST['password'];
                        $act = $_POST['cboxAccount'];

                        if (empty($_POST['user']) || empty($_POST['password'])) {
                            $query0A = "SELECT * FROM login WHERE UserID = '".$id."'";
                            $qry = "SELECT * FROM accounttype WHERE AccTypeID='".$act."'";
                            $res = mysqli_query($dbcon, $qry);
                            $result0A = mysqli_query($dbcon, $query0A);
                            echo "<div class=container>
                            <label><b>UserName</b></label>";
                            echo "<div class=input>$name</div>
                            <label><b>Password</b></label>";
                            echo "<input type='password' class=input value='".$pass."'>
                            <label><b>Account type</b></label>";
                            echo "<div class=input>";
                             while ($row=mysqli_fetch_array($res)) {
                                $acct0A = $row['AccountName'];
                                echo "".$acct0A."";
                            } 
                            echo "</div>
                            <div class=update>
                            <b style=color:#f00;>**Some data/s is/are  empty!</b>
                            </div>";
                            echo "<div class=container-footer-func1>
                                <a href=home.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        }
                        else{
                            $query = "UPDATE login SET UserName='".$name."', Password= '".$pass."', AccTypeID='".$act."' WHERE UserID='".$id."'";
                            $qry = "SELECT * FROM accounttype WHERE AccTypeID='".$act."'";
                            $res = mysqli_query($dbcon, $qry);
                            if(mysqli_query($dbcon, $query)){
                            echo "<div class=container>
                            <label><b>CourseName</b></label>";
                            echo "<input type='text' class=input value ='".$name."'>
                            <label><b>Password</b></label>";
                            echo "<input type='password' class=input value ='".$pass."'>
                             <label><b>Account type</b></label>";
                            echo "<input type='text' class=input value =";
                                while ($row=mysqli_fetch_array($res)) {
                                $acct0A = $row['AccountName'];
                                echo "'".$acct0A."'";
                                } 
                            echo ">
                            <div class=update>
                            <b style=color:#00d600;>*Data updated successfully!</b>
                            </div>";
                            }
                            else{
                              echo "<h3>Error!</h3>".mysqli_error($dbcon);
                            }
                            echo "<div class=container-footer-func1>
                                <a href=home.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                    }                    
                }

            ?>
          
        </div>
    </div>
</div>
</body>
</html>
