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
  <title>Attendance-Attendance Monitoring System</title>
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
    $("#Department1").change(function() {
    var id=$(this).val();
    var dataString = 'id='+ id;

      $.ajax ({
        type: "POST",
        url: "ajax_department.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#Course1").html(html);
          } 
      });
    });
  });
  </script>
  <script type="text/javascript">
  $(document).ready(function() {
    $("#Department2").change(function() {
    var id=$(this).val();
    var dataString = 'id='+ id;

      $.ajax ({
        type: "POST",
        url: "ajax_department.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#Course2").html(html);
          } 
      });
    });
  });
  </script>
   <script type="text/javascript">
  $(document).ready(function() {
    $("#Course2").change(function() {
    var id=$(this).val();
    var dataString = 'id='+ id;

      $.ajax ({
        type: "POST",
        url: "ajax_section.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#Section2").html(html);
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
  <script type="text/javascript">
  $(document).ready(function() {
    $("#Course1").change(function() {
    var id=$(this).val();
    var dataString = 'id='+ id;

      $.ajax ({
        type: "POST",
        url: "ajax_section.php",
        data: dataString,
        cache: false,
        success: function(html) {
          $("#Section1").html(html);
          } 
      });
    });
  });
  </script>
   <script>
      function startTime() {
          var today = new Date();
          var mo = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
          var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
          var d = today.getDate();
          var y = today.getFullYear();
          var h = today.getHours();
          var m = today.getMinutes();
          var s = today.getSeconds();

           var ampm = h >= 12 ? 'pm' : 'am';
           h = h % 12;
           h = h ? h : 12; // the hour '0' should be '12'

          h = timeCheck(h);
          m = checkTime(m);
          s = checkTime(s);
          d = checkTime(d);
          mo = checkTime(mo);
          document.getElementById('time').innerHTML = h + ":" + m + ":" + s + " " + ampm;
          document.getElementById('date').innerHTML = days[today.getDay()] + ", " + mo[today.getMonth()] + " " + d + ", " + y; 
          var t = setTimeout(startTime, 500);
      }

      function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
      }
          
      function timeCheck(a) {
              if (a < 10) {a = "0" + a};  // add zero in front of numbers < 10
              return a;
      }
   </script>
</head>

<body onload="startTime()">
<div class="body-fixed">

<div class="sidebar-attendance">
  <!--     <div class="csu">
    Cagayan State University
  </div>
  <div class="cics">
    College of Information and Computing Sciences
  </div> -->
  <div class="attendance">
    ATTENDANCE MONITORING SYSTEM
  </div>
  <div class="social-media">
    <img src="img/fb.png" class="social">
    <img src="img/ig.png" class="social">
    <img src="img/twitter.png" class="social">
    <img src="img/google.png" class="social">
    <img src="img/pinterest.png" class="social">
  </div>



      <div class="modal"  id="id02">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                Attendance
                <div class="search-att">
                 <?php
                  $acctype = $_GET['acctype'];
                  $event = $_POST['cboxEvent'];
                  echo "<form action=search.php?status=Edit&tb=Attendance&acctype=".$acctype."&event=".$event."  method=post>
                    <img src=img/search.png class=search-img>
                   <input type='text' name='txtSearch' class=searchbox placeholder='Search StudID'>
                    
                    <div class=search-div><button class=searchbtn>Search</button></div></form>";
                  ?>
                </div>

                 <div onclick ="document.getElementById('id02').style.display='none'" class="close-attendance" title ="Close" >&times;</div>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');

                $acctype = $_GET['acctype'];
                $event = $_POST['cboxEvent'];

                $query = "SELECT * FROM attendance WHERE EventID='".$event."' GROUP BY AttendID ASC";

                echo "<table cellpadding=9 cellspacing=0 border=0>";

                $result = mysqli_query($dbcon, $query);
                  echo "<tr>";
                  echo "<td class=head><b>AttendID</b></td>";
                  echo "<td class=head><b>StudName</b></td>";
                  echo "<td class=head><b>EventName</b></td>";
                  echo "<td class=head><b>Time</b></td>";
                  echo "<td class=head><b>Am/Pm</b></td>";
                  echo "<td class=head><b>In/Out</b></td>";
                  if ($acctype == 'Admin') {
                      echo "<td class=head><b>Edit</b></td>";
                  }
                  echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                  $att = $row['AttendID'];
                  echo "<tr>";
                  echo "<td>".$row['AttendID']."</td>";
                  $query1 = "SELECT * FROM student JOIN attendance ON student.StudID=attendance.StudID WHERE AttendID = '".$att."'";
                  $result1 = mysqli_query($dbcon, $query1);
                    while ($row1 = mysqli_fetch_array($result1)) {
                      echo "<td>".$row1['StudName']."</td>";
                    }

                  $query2 = "SELECT * FROM event JOIN attendance ON event.EventID = attendance.EventID WHERE AttendID = '".$att."'";
                  $result2 = mysqli_query($dbcon, $query2);
                    while ($row2= mysqli_fetch_array($result2)) {
                      echo "<td>".$row2['EventName']."</td>";
                    }

                  echo "<td>".$row['AttendTime']."</td>";

                  $query3 = "SELECT * FROM ampm JOIN attendance ON ampm.AmPmID = attendance.AmPmID WHERE AttendID='".$att."'";
                  $result3 = mysqli_query($dbcon, $query3);
                    while ($row3=mysqli_fetch_array($result3)) {
                       echo "<td>".$row3['AmPmName']."</td>";
                    }
                  
                  $query4 = "SELECT * FROM timeinout JOIN attendance ON timeinout.TimeInOutID = attendance.TimeInOutID WHERE AttendID = '".$att."'";
                  $result4 =  mysqli_query($dbcon, $query4);
                    while ($row4 = mysqli_fetch_array($result4)) {
                      echo "<td>".$row4['TimeInOutName']."</td>";
                    }

                  if ($acctype == 'Admin') {
                      echo "<td><a href=edit.php?id=".$row['AttendID']."&acctype=".$acctype."&tb=Attendance&event=".$event."><img src=img/edit.png class=edit1></a></td>";
                  }
                  echo "</tr>";
                }
                echo "</table>";
              ?>
              </div>          
          </div>
          <div class="button-cancel">
           <div class="recfound">
              <?php
                  include('config.php');
                  $qry = "SELECT Count(AttendID) FROM attendance WHERE EventID=".$event;
                  $res=mysqli_query($dbcon, $qry);
                  while ($row = mysqli_fetch_array($res)) {
                  echo "<b>".$row[0]."</b> Record(s) found. ";
               }   
              ?>
            </div>
              <button type="button" onclick ="document.getElementById('id02').style.display='none'" class ="cancelbtn">Cancel</button>
            </div>
          </div>

      </div>

      <div class="modal"  id="id04">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                Attendance
                <div class="search-att">
                 <?php
                  $acctype = $_GET['acctype'];
                  echo "<form action=search.php?status=Delete&tb=Attendance&acctype=".$acctype."&event=".$event."  method=post>
                    <img src=img/search.png class=search-img>
                   <input type='text' name='txtSearch' class=searchbox placeholder='Search StudID'>
                    
                    <div class=search-div><button class=searchbtn>Search</button></div></form>";
                  ?>
                </div>
                 <div onclick ="document.getElementById('id04').style.display='none'" class="close-attendance" title ="Close" >&times;</div>
              </div>
          <div class="table-record">
              <div class="record">

                 <?php
                include('config.php');

                $acctype = $_GET['acctype'];
                $event = $_POST['cboxEvent'];

                $query = "SELECT * FROM attendance WHERE EventID='".$event."' GROUP BY AttendID ASC";

                echo "<table cellpadding=9 cellspacing=0 border=0>";

                $result = mysqli_query($dbcon, $query);
                  echo "<tr>";
                  echo "<td class=head><b>AttendID</b></td>";
                  echo "<td class=head><b>StudName</b></td>";
                  echo "<td class=head><b>EventName</b></td>";
                  echo "<td class=head><b>Time</b></td>";
                  echo "<td class=head><b>Am/Pm</b></td>";
                  echo "<td class=head><b>In/Out</b></td>";
                  if ($acctype == 'Admin') {
                      echo "<td class=head><b>Delete</b></td>";
                  }
                  echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                  $att = $row['AttendID'];
                  echo "<tr>";
                  echo "<td>".$row['AttendID']."</td>";
                  $query1 = "SELECT * FROM student JOIN attendance ON student.StudID=attendance.StudID WHERE AttendID = '".$att."'";
                  $result1 = mysqli_query($dbcon, $query1);
                    while ($row1 = mysqli_fetch_array($result1)) {
                      echo "<td>".$row1['StudName']."</td>";
                    }

                  $query2 = "SELECT * FROM event JOIN attendance ON event.EventID = attendance.EventID WHERE AttendID = '".$att."'";
                  $result2 = mysqli_query($dbcon, $query2);
                    while ($row2= mysqli_fetch_array($result2)) {
                      echo "<td>".$row2['EventName']."</td>";
                    }

                  echo "<td>".$row['AttendTime']."</td>";

                  $query3 = "SELECT * FROM ampm JOIN attendance ON ampm.AmPmID = attendance.AmPmID WHERE AttendID='".$att."'";
                  $result3 = mysqli_query($dbcon, $query3);
                    while ($row3=mysqli_fetch_array($result3)) {
                       echo "<td>".$row3['AmPmName']."</td>";
                    }
                  
                  $query4 = "SELECT * FROM timeinout JOIN attendance ON timeinout.TimeInOutID = attendance.TimeInOutID WHERE AttendID = '".$att."'";
                  $result4 =  mysqli_query($dbcon, $query4);
                    while ($row4 = mysqli_fetch_array($result4)) {
                      echo "<td>".$row4['TimeInOutName']."</td>";
                    }

                  if ($acctype == 'Admin') {
                      echo "<td><a href=delete.php?id=".$row['AttendID']."&acctype=".$acctype."&tb=Attendance&event=".$event."><img src=img/delete.png class=edit1></a></td>";
                  }
                  echo "</tr>";
                }
                echo "</table>";
              ?>
              </div>          
          </div>
          <div class="button-cancel">

              <button type="button" onclick ="document.getElementById('id04').style.display='none'" class ="cancelbtn">Cancel</button>
            </div>
          </div>
      </div>

      <div class="modal"  id="id05">
        <!-- <div class="reports"> -->
          <div class="title">
              <div class="title-attendance">
                 Reports
                 <div class="selection-report">
                 <div class="select-img">
                    <div class="select-img1">
                      <img src="img/section.png" class="selection-report-img" onclick="document.getElementById('id08').style.display='block'; document.getElementById('id05').style.display='block'">
                    </div>
                    <div class="select-text-div">
                      Section
                    </div>
                  </div>
                   <div class="select-img2">
                    <div class="select-img1">
                      <img src="img/course.png" class="selection-report-img" onclick="document.getElementById('id07').style.display='block'; document.getElementById('id05').style.display='block'">
                    </div>
                    <div class="select-text-div">
                      Course
                    </div>
                  </div>
                  <div class="select-img3">
                    <div class="select-img1">
                      <img src="img/dept.png" class="selection-report-img" onclick="document.getElementById('id06').style.display='block'; document.getElementById('id05').style.display='block'">
                    </div>
                    <div class="select-text-div">
                      Department
                    </div>
                  </div>
                  <div class="select-img4">
                    <div class="select-img1">
                      <img src="img/calendar.png" class="selection-report-img" onclick="document.getElementById('id09').style.display='block'; document.getElementById('id05').style.display='block'">
                    </div>
                    <div class="select-text-div">
                      Event
                    </div>
                  </div>
                 </div>
              
                 <div onclick ="document.getElementById('id05').style.display='none'" class="close-attendance" title ="Close" >&times;</div>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');
                $acctype = $_GET['acctype'];
                $event = $_POST['cboxEvent'];
                echo "<table cellpadding=9 cellspacing=0 border=0>";
                echo "<tr>";
                echo "<td class=head><b>StudID</b></td>";
                echo "<td class=head><b>StudName</b></td>";
                echo "<td class=head><b>EventName</b></td>";
                echo "<td class=head><b>No of Bottles</b></td>";
                echo "</tr>";
                      
                $qry = "SELECT *, Count(AttendID) FROM student JOIN attendance ON attendance.StudID=student.StudID WHERE EventID = '".$event."' GROUP BY StudName";
                $result = mysqli_query($dbcon, $qry);
                  while ($rows=mysqli_fetch_array($result)) {
                    
                      echo "<tr>";
                      echo "<td>".$rows['StudID']."</td>";
                      echo "<td>".$rows['StudName']."</td>";

                      $query = "SELECT * FROM event WHERE EventID='".$event."'";
                      $res = mysqli_query($dbcon, $query);
                      while ($row = mysqli_fetch_array($res)) {
                        echo "<td>".$row['EventName']."</td>";
                      }
                        if ($rows['Count(AttendID)'] == 4) {
                          echo "<td>0</td>";
                        }
                        elseif($rows['Count(AttendID)']==3){
                          echo "<td>50</td>";
                        }
                        elseif($rows['Count(AttendID)']==2){
                          echo "<td>100</td>";
                        }
                        elseif($rows['Count(AttendID)']==1){
                          echo "<td>150</td>";
                        }
                    }
                  echo "</tr>";
                echo "</table>";
              ?>
              </div>          
          </div>
          
          <div class="button-cancel">
           <div class="recfound">
              <?php
                  include('config.php');
                  $qry = "SELECT Count(DISTINCT StudID) FROM attendance WHERE EventID=".$event;
                  $res=mysqli_query($dbcon, $qry);
                  while ($row = mysqli_fetch_array($res)) {
                  echo "<b>".$row[0]."</b> Record(s) found. ";
               }   
              ?>
            </div>
              <button type="button" onclick ="document.getElementById('id05').style.display='none'" class ="cancelbtn">Cancel</button>
            </div>
          </div>
      </div>



</div>



<div class="sidebar-right-attendance">
<?php $acctype = $_GET['acctype'];
    if ($acctype == 'User') { ?>
  <div class="hidden1"></div>
<?php } else { ?>
    <div class="hidden-admin-att"></div>
<?php } ?>
  <div class="form-attendance-attend">
       <div class="imgcontainer-home">
              <div class="imgcontainer-avatar-home">
                  <img src="img/csu-cics1.png" alt="Avatar" class="avatar-home">
              </div>
              <div class="dateandtime">
                  <div class="date" id="date">
                    
                  </div>
                  <div class="time" id="time">
                    
                  </div> 
              </div>
       </div>
       
       <div class="attend-view">
            <div class="attend1">
              <img src="img/attendance-view.png" class="img-home-attend">
            </div>
            <div class="attend2">
              <button class="button-home" onclick="document.getElementById('id02').style.display='block'">View Attendance</button>
            </div>
       </div>
       <?php
          if ($acctype == 'Admin') {
       ?>
       <div class="student-view">
          <div class="attend1">
            <img src="img/attendance1.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home" onclick="document.getElementById('id03').style.display='block'">Add Attendance</button>
          </div>
       </div>
       <div class="student-view">
          <div class="attend1">
            <img src="img/attendance-3.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home-attend" onclick="document.getElementById('id04').style.display='block'">Delete Attendance</button>
          </div>
       </div>
       <div class="student-view">
          <div class="attend1">
            <img src="img/attendance.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home-attend" onclick="document.getElementById('id05').style.display='block'">View Reports</button>
          </div>
       </div>
       <?php }else{
        ?>
        <div class="student-view">
          <div class="attend1">
            <img src="img/attendance.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home-attend" onclick="document.getElementById('id05').style.display='block'">View Reports</button>
          </div>
       </div>
       <?php
       }
        ?>
       <div class="container-footer-home-user">
          <?php 
              echo "<a href=attendance-event.php?acctype=".$acctype."><button class=button-back-home-att-event>Back</button></a>";
          ?>
       </div>
  </div>

   <!--  //////////////////// The Modal ///////////////////// -->
     <div id="id03" class="modal-insert-attend">
      <div class="modal-1">
        <span onclick ="document.getElementById('id03').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        echo "<form  action=insert.php?acctype=".$acctype."&tb=Attendance method=POST class=modal-content animate>"
        ?>
          <div class="imgcontainer-attend">
            <img src="img/attendance-add.png" alt="Avatar" class="avatar-func">
          </div>
          <div class="container">
            <label><b>Student Name</b></label>
            <input type="text" name="txtStudID" class="select-attend" placeholder="Enter StudID" required="">
            <label><b>Event Name</b></label>
                  <?php 
                    include('config.php');
                    $event = $_POST['cboxEvent'];
                    $query = "SELECT * FROM event WHERE EventID = ".$event;
                    
                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend' name='cboxEvent' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['EventID'].">".$row['EventName']."</option>";
                      }
                    echo "</select>";
                 ?>
                 &nbsp;&nbsp;&nbsp;&nbsp;<label><b>Am/Pm</b></label>
                  <?php 
                    include('config.php');

                    $query = "SELECT * FROM ampm";

                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend-ampm' name='cboxAmPm' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['AmPmID'].">".$row['AmPmName']."</option>";
                      }
                    echo "</select>";
                 ?>
                &nbsp;&nbsp;&nbsp;&nbsp;<label><b>In/Out</b></label>
                  <?php 
                    include('config.php');

                    $query = "SELECT * FROM timeinout";

                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend-ampm' name='cboxInOut' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['TimeInOutID'].">".$row['TimeInOutName']."</option>";
                      }
                    echo "</select>";
                 ?>
            <button type="submit" onclick="document.getElementById('id02').style.display='action'">Add Attendance</button> 
          </div>
          <div class="container-footer">

          <button type="button" onclick ="document.getElementById('id03').style.display='none'" class ="cancelbtn">Cancel</button>
         </div>
        </form>
      </div> 
    </div>



 <!--  //////////////////// The Modal ///////////////////// -->
    <div id="id06" class="modal-insert-attend-d-c-s1">
      <div class="modal-1">
        <span onclick ="document.getElementById('id06').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        echo "<form  action=report.php?acctype=".$acctype."&event=".$event."&tb=Department method=post class=modal-content animate>"
        ?>
          <div class="imgcontainer-attend-d-c-s">
            <img src="img/attendance.png" alt="Avatar" class="avatar-func">
          </div>
          <div class="container">
            <label><b>Department</b></label>
                  <?php 
                    include('config.php');
                    $query = "SELECT * FROM department";
                    
                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend-dept-course-sect' name='cboxDepartment' id='Department' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['DeptID'].">".$row['DeptName']."</option>";
                      }
                    echo "</select>";
                 ?>
                <!--  <label><b>Course</b></label>
                  
                    <select class="select-attend-dept-course-sect" id="Course" name="cboxCourse" onmousedown='if(this.options.length>4){this.size=4;}' onchange='this.size=0;' onblur='this.size=0;'>
                      <option>Course</option>
                    </select>

                <label><b>Section</b></label>
                    <select class="select-attend-dept-course-sect" id="Section" name="cboxSection" onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>
                    <option>Section</option>
                    </select> -->

            <button type="submit" onclick="document.getElementById('id02').style.display='action'">View Attendance</button> 
          </div>
          <div class="container-footer">

          <button type="button" onclick ="document.getElementById('id06').style.display='none'" class ="cancelbtn">Cancel</button>
         </div>
        </form>
      </div> 
    </div>



    <!--  //////////////////// The Modal ///////////////////// -->
    <div id="id07" class="modal-insert-attend-d-c-s2">
      <div class="modal-1">
        <span onclick ="document.getElementById('id07').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        echo "<form  action=report.php?acctype=".$acctype."&event=".$event."&tb=Course method=post class=modal-content animate>"
        ?>
          <div class="imgcontainer-attend-d-c-s">
            <img src="img/attendance.png" alt="Avatar" class="avatar-func">
          </div>
          <div class="container">
            <label><b>Department</b></label>
                  <?php 
                    include('config.php');
                    $query = "SELECT * FROM department";
                    
                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend-dept-course-sect' name='cboxDepartment' id='Department1' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['DeptID'].">".$row['DeptName']."</option>";
                      }
                    echo "</select>";
                 ?>
                 <label><b>Course</b></label>
                  
                    <select class="select-attend-dept-course-sect" id="Course1" name="cboxCourse" onmousedown='if(this.options.length>4){this.size=4;}' onchange='this.size=0;' onblur='this.size=0;'>
                      <option>--Course--</option>
                    </select>

              <!--   <label><b>Section</b></label>
                    <select class="select-attend-dept-course-sect" id="Section1" name="cboxSection" onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>
                    <option>Section</option>
                    </select> -->

            <button type="submit" onclick="document.getElementById('id02').style.display='action'">View Attendance</button> 
          </div>
          <div class="container-footer">

          <button type="button" onclick ="document.getElementById('id07').style.display='none'" class ="cancelbtn">Cancel</button>
         </div>
        </form>
      </div> 
    </div>

       <!--  //////////////////// The Modal ///////////////////// -->
    <div id="id08" class="modal-insert-attend-d-c-s">
      <div class="modal-1">
        <span onclick ="document.getElementById('id08').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        echo "<form  action=report.php?acctype=".$acctype."&event=".$event."&tb=Section method=post class=modal-content animate>"
        ?>
          <div class="imgcontainer-attend-d-c-s">
            <img src="img/attendance.png" alt="Avatar" class="avatar-func">
          </div>
          <div class="container">
            <label><b>Department</b></label>
                  <?php 
                    include('config.php');
                    $query = "SELECT * FROM department";
                    
                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend-dept-course-sect' name='cboxDepartment' id='Department2' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['DeptID'].">".$row['DeptName']."</option>";
                      }
                    echo "</select>";
                 ?>
                 <label><b>Course</b></label>
                  
                    <select class="select-attend-dept-course-sect" id="Course2" name="cboxCourse" onmousedown='if(this.options.length>4){this.size=4;}' onchange='this.size=0;' onblur='this.size=0;'>
                      <option>--Course--</option>
                    </select>

                <label><b>Section</b></label>
                    <select class="select-attend-dept-course-sect" id="Section2" name="cboxSection" onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>
                    <option>--Section--</option>
                    </select>

            <button type="submit" onclick="document.getElementById('id02').style.display='action'">View Attendance</button> 
          </div>
          <div class="container-footer">

          <button type="button" onclick ="document.getElementById('id08').style.display='none'" class ="cancelbtn">Cancel</button>
         </div>
        </form>
      </div> 
    </div>


    <!--  //////////////////// The Modal ///////////////////// -->
    <div id="id09" class="modal-insert-attend-d-c-s1">
      <div class="modal-1">
        <span onclick ="document.getElementById('id09').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        echo "<form  action=report.php?acctype=".$acctype."&event=".$event."&tb=Event method=post class=modal-content animate>"
        ?>
          <div class="imgcontainer-attend-d-c-s">
            <img src="img/attendance.png" alt="Avatar" class="avatar-func">
          </div>
          <div class="container">
          <div class="ampminout2">
            <div class="ampm-ins1"> 
              <label><b>From</b></label>
                <input type="date" name="txtFrom" class="select-attend-dept-course-sect">
            </div>
            <div class="inout-ins">
              <label><b>To</b></label>
                <input type="date" name="txtTo" class="select-attend-dept-course-sect">
            </div>
          </div>
          
            <button type="submit" onclick="document.getElementById('id02').style.display='action'">View Event</button> 
          </div>
          <div class="container-footer">

          <button type="button" onclick ="document.getElementById('id09').style.display='none'" class ="cancelbtn">Cancel</button>
         </div>
        </form>
      </div> 
    </div>


</div>
</div>
</body>
</html>