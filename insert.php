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
  <title>Insert-Attendance Monitoring System</title>
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
        <div class="hidden-attend-ins"></div>
    <?php } elseif ($tbname == 'Event') { ?>
        <div class="hidden-event-ins"></div>
    <?php } elseif ($tbname == 'Course') { ?>
        <div class="hidden-course-upd"></div>
    <?php } elseif ($tbname == 'Section') { ?>
        <div class="hidden-course-upd"></div>
    <?php } elseif ($tbname == 'Security') { ?>
        <div class="hidden-insert-secu"></div>
    <?php } ?>
        <div class="modal-content-func">
          <div class="imgcontainer">
          <?php
            include('config.php');
            $tbname = $_GET['tb'];
            if ($tbname == 'Student') {
               echo "<img src=img/student-add-1.png alt=Avatar class=avatar-func>";
            }
            elseif ($tbname == 'Department') {
              echo "<img src=img/dept-add.png alt=Avatar class=avatar-func>";
            }
            elseif ($tbname == 'Attendance') {
               echo "<img src=img/attendance-add.png alt=Avatar class=avatar-func>";
            }
            elseif ($tbname == 'Event') {
               echo "<img src=img/calendar-add.png alt=Avatar class=avatar-func>";
            }
            elseif ($tbname == 'Course') {
               echo "<img src=img/course-add-1.png alt=Avatar class=avatar-func>";
            }
            elseif ($tbname == 'Section') {
               echo "<img src=img/section-add-1.png alt=Avatar class=avatar-func>";
            }
            elseif ($tbname == 'Security') {
               echo "<img src=img/security.png alt=Avatar class=avatar-func>";
            }
          ?>
           
          </div>
          
          <?php
            if ($tbname == 'Student') {
          ?>
                <div class="container">
                <label><b>Student ID</b></label>
                  <div class="input">
                      <?php 
                          $studid = $_POST['txtStudID']; 
                          echo "$studid";
                      ?>
                  </div>
                  <label><b>Student Name</b></label>
                  <div class="input">
                      <?php 
                          $studname = $_POST['txtStudName']; 
                          echo "$studname";
                      ?>
                  </div>
                  <label><b>Address</b></label>
                  <div class="input">
                      <?php 
                          $address = $_POST['txtAddress']; 
                          echo "$address";
                      ?>
                  </div>
                  <div class="course-sect">
                    <div class="course-sect1-a">
                      <label><b>Course</b></label>
                      <div class="input-dept-ins">
                          <?php 
                              include('config.php');
                              $course = $_POST['cboxCourse'];
                              
                              if($_POST['cboxCourse']==0){
                                 echo "Invalid selection!";
                              }
                              else{
                              $query = "SELECT CourseName FROM course WHERE CourseID = '".$course."'";
                              $result = mysqli_query($dbcon, $query);

                               while ($row = mysqli_fetch_array($result)) {
                                   $course = $row['CourseName'];
                                   echo "$course";
                               }
                              } 
                          ?>
                      </div>
                    </div>
                    <div class="course-sect2">
                      <label><b>Section</b></label>
                      <div class="input-dept-ins">
                          <?php 
                              include('config.php');
                              $sect = $_POST['cboxSection'];
                              if ($_POST['cboxSection'] == 0) {
                                echo "Invalid selection!";
                              }
                              else{
                                $query = "SELECT SectionName FROM section WHERE SectionID = '".$sect."'";
                                $result = mysqli_query($dbcon, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                   $sec = $row['SectionName'];
                                   echo "$sec";
                                 }
                              }  
                          ?>
                      </div>
                    </div>
                  </div>
                  <?php
                    include('config.php');

                    $acctype = $_GET['acctype'];
                    $studid = $_POST['txtStudID'];
                    $studname = $_POST['txtStudName'];
                    $address = $_POST['txtAddress'];
                    $course = $_POST['cboxCourse'];
                    $sect = $_POST['cboxSection'];

                    $qry="SELECT * FROM student WHERE StudID ='".$studid."'";
                    $result1 = mysqli_query($dbcon, $qry);
                    
                    
                    if (empty($_POST['txtStudName']) || empty($_POST['txtAddress']) || empty($_POST['txtStudID']) || empty($_POST['cboxCourse']) || empty($_POST['cboxSection'])){
                      echo "<b style=color:red>**Can't insert record. Some data/s is/are empty!</b>";
                    }
                    elseif ($sect == 0) {
                      echo "<b style=color:red>**Can't insert record. Some data/s is/are empty!</b>";
                    }
                    elseif ($course == 0) {
                      echo "<b style=color:red>**Can't insert record. Some data/s is/are empty!</b>";
                    }
                    elseif ($row1 = mysqli_fetch_array($result1)){
                        echo "<b style=color:red>**Can't insert record. StudID must be unique!</b>";
                    }
                    else {
                      $query = "INSERT INTO student(StudID, StudName, Address, CourseID, SectionID) Values('$studid','$studname','$address','$course', '$sect')";

                      mysqli_query($dbcon, $query);

                      echo "<b style=color:#00d600>**Data inserted successfully!</b>";                
                    }   
                ?>  
                </div>

                <div class="container-footer-func">
                    <?php
                      echo "<a href=student.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                    ?>
                   
                </div>
          <?php 
            }
            elseif ($tbname == 'Department') {
           ?>
                      <div class="container">
                      <label><b>Department Name</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                              include('config.php');
                              $deptname = $_POST['txtDeptName']; 
                              echo "'".$deptname."'";
                          ?>
                      >
                      <?php
                        include('config.php');

                        $acctype = $_GET['acctype'];
                        $deptname = $_POST['txtDeptName'];

                        $qry = "SELECT DeptName FROM department WHERE DeptName='".$deptname."'";
                        $res = mysqli_query($dbcon, $qry);
                        $count = mysqli_num_rows($res);
                        if (empty($_POST['txtDeptName'])){
                          echo "<b style=color:red>**Can't insert record. Data is empty!</b>";
                        }
                        elseif($count >= 1){
                          echo "<b style=color:red>**Can't insert record. Data already exist!</b>";
                        }
                        else {
                          $query = "INSERT INTO department(DeptName) Values('$deptname')";

                          if(mysqli_query($dbcon, $query)){
                            echo "<b style=color:#00d600>**Data inserted successfully!</b>";        
                          }
                          else{
                            echo "<h2>Error!</h2>".mysqli_error($dbcon);
                          }
                        }   
                    ?>  
                    </div>

                    <div class="container-footer-func">
                        <?php
                          echo "<a href=department.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        ?>
                       
                    </div>
            <?php 
              } 
              elseif ($tbname == 'Attendance') {
            ?>
                      <?php  $acctype = $_GET['acctype']; 
                      echo "<form action=attendance.php?acctype=".$acctype." method=post>"; ?>

                      <div class="container">
                      <label><b>Student Name</b></label>
                      <div class="input">
                      <?php 
                          include('config.php');
                          $stud = $_POST['txtStudID'];
                          echo "$stud"; 
                      ?>
                      </div>
                      <label><b>Event Name</b></label>
                      <div class="input" style="margin-bottom: 15px;">
                          <?php 
                              $event = $_POST['cboxEvent'];
                              echo "$event";
                          ?>
                      </div>
                      <div class="ampminout">
                        <div class="ampm-del-eve">
                        <label><b>Am/Pm</b></label>
                          <div class="input" style="margin-bottom: 15px;">
                              <?php 
                                  $ampm = $_POST['cboxAmPm'];
                                  echo "$ampm";
                              ?>
                          </div>
                        </div>
                        <div class="inout">
                        <label><b>In/Out</b></label>
                          <div class="input" style="margin-bottom: 15px;">
                              <?php 
                                  $inout = $_POST['cboxInOut'];
                                  echo "$inout";
                              ?>
                          </div>
                        </div>
                      </div>
                      <?php
                        include('config.php');
                        $acctype = $_GET['acctype'];
                        $stud = $_POST['txtStudID'];
                        $event = $_POST['cboxEvent'];
                        $ampm = $_POST['cboxAmPm'];
                        $inout = $_POST['cboxInOut'];

                        $qry = "SELECT StudID, EventID FROM attendance WHERE StudID = '".$stud."' AND EventID = '".$event. "' AND AmPmID = '".$ampm."' AND TimeInOutID = '".$inout."'";
                        $res1 = mysqli_query($dbcon, $qry);
                        $count = mysqli_num_rows($res1);

                        if(empty($_POST['txtStudID'])){
                            echo "<b style=color:red>**Can't insert record. Data is empty!</b>";
                                $event = $_POST['cboxEvent'];
                                $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                $rest = mysqli_query($dbcon, $qry);

                                echo "<select name='cboxEvent' class=select-hidden>";
                                  while ($rw = mysqli_fetch_array($rest)) {
                                    echo "<option value='".$rw['EventID']."'></option>";
                                  }
                                  echo "</select>";
                        }
                        elseif ($count == 1) {
                           echo "<b style=color:red>**Can't insert record. Data already exist!</b>";
                              $event = $_POST['cboxEvent'];
                              $qry = "SELECT * FROM event WHERE EventID = ".$event;
                              $rest = mysqli_query($dbcon, $qry);

                                echo "<select name='cboxEvent' class=select-hidden>";
                                while ($rw = mysqli_fetch_array($rest)) {
                                    echo "<option value='".$rw['EventID']."'></option>";
                                  }
                                    echo "</select>";
                        }
                        else{
                          $qry = "SELECT COUNT(StudID) FROM student WHERE StudID = '".$stud."'";
                            
                            if ($res = mysqli_query($dbcon, $qry)){

                            while($row = mysqli_fetch_array($res)){
                                if ($row[0] == 0){  
                                 echo "<b style=color:red>**Can't insert record. StudID doesn't exist!</b>";
                                      $event = $_POST['cboxEvent'];
                                      $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                      $rest = mysqli_query($dbcon, $qry);

                                      echo "<select name='cboxEvent' class=select-hidden>";
                                      while ($rw = mysqli_fetch_array($rest)) {
                                        echo "<option value='".$rw['EventID']."'></option>";
                                      }
                                      echo "</select>";
                                }
                                else{
                                  $query = "INSERT INTO attendance(StudID, EventID, AttendTime, AmPmID, TimeInOutID) Values('$stud','$event', now(), '$ampm','$inout')";

                                    if(mysqli_query($dbcon, $query)){
                                      echo "<b style=color:#00d600>**Data inserted successfully!</b>";

                                      $event = $_POST['cboxEvent'];
                                      $qry = "SELECT * FROM event WHERE EventID = ".$event;
                                      $rest = mysqli_query($dbcon, $qry);

                                      echo "<select name='cboxEvent' class=select-hidden>";
                                      while ($rw = mysqli_fetch_array($rest)) {
                                        echo "<option value='".$rw['EventID']."'></option>";
                                      }
                                      echo "</select>";
                                    }
                                    else{
                                      echo "Error! ".mysqli_error($dbcon);
                                    }
                                    
                                }
                            }
                           }
                           else{
                            echo "Error!".mysqli_error($dbcon);
                           }
                          } 
                      ?>  
                    </div>

                    <div class="container-footer-func">
                        <button type="submit" class="btn1">&nbsp;&nbsp;&nbsp;Back</button></a>     
                    </div>
                    </form>

            <?php 
              }
              elseif ($tbname == 'Event') {
           ?>
                      <div class="container">
                      <label><b>Event Name</b></label>
                      <div class="input">
                          <?php 
                              include('config.php');
                              $eventname = $_POST['txtEventName']; 
                              echo "$eventname";
                          ?>
                      </div>
                      <label><b>Venue</b></label>
                      <div class="input">
                          <?php 
                              $venue= $_POST['txtVenue']; 
                              echo "$venue";
                          ?>
                      </div>
                      <div class="ampminout">
                        <div class="ampm-eve">
                          <label><b>Date</b></label>
                          <div class="input">
                              <?php 
                                  $date= $_POST['txtDate']; 
                                  echo "$date";
                              ?>
                          </div>
                        </div>
                        <div class="inout">
                          <label><b>No. of Attendee</b></label>
                          <div class="input">
                              <?php 
                                  $num= $_POST['txtNum']; 
                                  echo "$num";
                              ?>
                          </div>
                        </div>
                      </div>
                      <?php
                        include('config.php');

                        $acctype = $_GET['acctype'];
                        $eventname = $_POST['txtEventName'];
                        $venue = $_POST['txtVenue'];
                        $date = $_POST['txtDate'];
                        $num = $_POST['txtNum'];

                        if (empty($_POST['txtEventName']) || empty($_POST['txtVenue']) || empty($_POST['txtDate']) || empty($_POST['txtNum'])){
                          echo "<b style=color:red>**Can't insert record. Some data/s is/are empty!</b>";
                        }
                        elseif ($num <= 0) {
                          echo "<b style=color:red>**Can't insert record. Invalid no. of Attendee!</b>";
                        }
                        else {
                          $query = "INSERT INTO event(EventName,Venue,Date, NumAttendee) Values('$eventname','$venue','$date', '$num')";

                          if(mysqli_query($dbcon, $query)){
                            echo "<b style=color:#00d600>**Data inserted successfully!</b>";        
                          }
                          else{
                            echo "<h2>Error!</h2>".mysqli_error($dbcon);
                          }
                        }   
                    ?>  
                    </div>

                    <div class="container-footer-func">
                        <?php
                          echo "<a href=event.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        ?>
                       
                    </div>
            <?php 
              }  elseif ($tbname == 'Course') {
            ?>
                      <div class="container">
                      <label><b>Course Name</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                              include('config.php');
                              $deptname = $_POST['txtCourseName']; 
                              echo "'".$deptname."'";
                          ?>
                      >
                      <label><b>Department</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                          include('config.php');
                          $dept = $_POST['cboxDepartment'];
                          $query = "SELECT DeptName FROM department WHERE DeptID = $dept";
                          $result = mysqli_query($dbcon, $query);
                          while ($row = mysqli_fetch_array($result)) {
                             $department = $row['DeptName'];
                             echo "'".$department."'";
                           } 
                          ?>
                      >
                      <?php
                        include('config.php');
                        $acctype = $_GET['acctype'];
                        $coursename = $_POST['txtCourseName'];
                        $dept = $_POST['cboxDepartment'];

                        if (empty($_POST['txtCourseName'])){
                          echo "<b style=color:red>**Can't insert record. Data is empty!</b>";
                        }
                        else {
                          $query = "INSERT INTO course(CourseName, DeptID) Values('$coursename','$dept')";

                          if(mysqli_query($dbcon, $query)){
                            echo "<b style=color:#00d600>**Data inserted successfully!</b>";        
                          }
                          else{
                            echo "<h2>Error!</h2>".mysqli_error($dbcon);
                          }
                        }   
                    ?>  
                    </div>

                    <div class="container-footer-func">
                        <?php
                          echo "<a href=course.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        ?>
                       
                    </div>
            <?php 
              }  elseif ($tbname == 'Section') {
            ?>
                      <div class="container">
                      <label><b>Section Name</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                              include('config.php');
                              $deptname = $_POST['txtSectionName']; 
                              echo "'".$deptname."'";
                          ?>
                      >
                      <label><b>Course</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                          include('config.php');
                          $course = $_POST['cboxCourse'];
                          $query = "SELECT CourseName FROM course WHERE CourseID = '".$course."'";
                          $result = mysqli_query($dbcon, $query);
                          while ($row = mysqli_fetch_array($result)) {
                             $courses = $row['CourseName'];
                             echo "'".$courses."'";
                           } 
                          ?>
                      >
                      <?php
                        include('config.php');
                        $acctype = $_GET['acctype'];
                        $sectname = $_POST['txtSectionName'];
                        $course = $_POST['cboxCourse'];

                        if (empty($_POST['txtSectionName'])){
                          echo "<b style=color:red>**Can't insert record. Data is empty!</b>";
                        }
                        else {
                          $query = "INSERT INTO section(SectionName, CourseID) Values('$sectname','$course')";

                          if(mysqli_query($dbcon, $query)){
                            echo "<b style=color:#00d600>**Data inserted successfully!</b>";        
                          }
                          else{
                            echo "<h2>Error!</h2>".mysqli_error($dbcon);
                          }
                        }   
                    ?>  
                    </div>

                    <div class="container-footer-func">
                        <?php
                          echo "<a href=section.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        ?>
                       
                    </div>
            <?php 
              } elseif ($tbname == 'Security') {
            ?>
                      <div class="container">
                      <label><b>User Name</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                              include('config.php');
                              $name = $_POST['txtUserName']; 
                              echo "'".$name."'";
                          ?>
                      >
                      <label><b>Password</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                              include('config.php');
                              $pass = $_POST['txtPassword']; 
                              echo "'".$pass."'";
                          ?>
                      >
                      <label><b>Account type</b></label>
                      <input type="text" class="input" style="margin-bottom: 15px;" value=
                          <?php 
                          include('config.php');
                          $act = $_POST['cboxAccount'];
                          $query = "SELECT AccountName FROM accounttype WHERE AccTypeID = $act";
                          $result = mysqli_query($dbcon, $query);
                          while ($row = mysqli_fetch_array($result)) {
                             $acct = $row['AccountName'];
                             echo "'".$acct."'";
                           } 
                          ?>
                      >
                      <?php
                        include('config.php');
                        $acctype = $_GET['acctype'];
                        $name = $_POST['txtUserName'];
                        $pass = $_POST['txtPassword'];
                        $act = $_POST['cboxAccount'];

                        if (empty($_POST['txtUserName']) || empty($_POST['txtPassword'])){
                          echo "<b style=color:red>**Can't insert record. Some data/s is/are empty!</b>";
                        }
                        else {
                          $query = "INSERT INTO login(UserName, Password, AccTypeID) Values('$name','$pass', '$act')";

                          if(mysqli_query($dbcon, $query)){
                            echo "<b style=color:#00d600>**Data inserted successfully!</b>";        
                          }
                          else{
                            echo "<h2>Error!</h2>".mysqli_error($dbcon);
                          }
                        }   
                    ?>  
                    </div>

                    <div class="container-footer-func">
                        <?php
                          echo "<a href=home.php?acctype=".$acctype."><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        ?>
                       
                    </div>
            <?php 
              } 
              ?>
        </div>
    </div>
</div>
</body>
</html>
