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
  <title>Student-Attendance Monitoring System</title>
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
  <!-- <div class="csu">
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
                Students
                <div class="search">
                <?php
                $acctype = $_GET['acctype'];
                echo "<form action=search.php?status=Edit&tb=Student&acctype=".$acctype."  method=post>
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

                $query = "SELECT * FROM student JOIN course ON course.CourseID = student.CourseID JOIN section ON section.SectionID = student.SectionID JOIN department ON course.DeptID = department.DeptID GROUP BY StudName ASC";

                echo "<table cellpadding=9 cellspacing=0 border=0>";

                $result = mysqli_query($dbcon, $query);
                  echo "<tr >";
                  echo "<td class=head><b>StudID</b></td>";
                  echo "<td class=head><b>StudName</b></td>";
                  echo "<td class=head><b>Address</b></td>";
                  echo "<td class=head><b>Course</b></td>";
                  echo "<td class=head><b>Department</b></td>";
                  echo "<td class=head><b>Section</b></td>";
                    if ($acctype == 'Admin') {
                      echo "<td class=head><b>Edit</b></td>";
                    }
                  echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".$row['StudID']."</td>";
                  echo "<td>".$row['StudName']."</td>";
                  echo "<td>".$row['Address']."</td>";
                  echo "<td>".$row['CourseName']."</td>";
                  echo "<td>".$row['DeptName']."</td>";
                  echo "<td>".$row['SectionName']."</td>";
                    if ($acctype == 'Admin') {
                      echo "<td><a href=edit.php?id=".$row['StudID']."&acctype=".$acctype."&tb=Student><img src=img/edit.png class=edit1></a></td>";
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
                  $qry = "SELECT Count(StudID) FROM student";
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
                Student
                <div class="search">
                  <?php
                  $acctype = $_GET['acctype'];
                  echo "<form action=search.php?status=Delete&acctype=".$acctype." method=post>
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

                $query = "SELECT * FROM student JOIN course ON course.CourseID = student.CourseID JOIN section ON student.SectionID = section.SectionID 
                JOIN department ON department.DeptID = course.DeptID GROUP BY StudName ASC";

                echo "<table cellpadding=9 cellspacing=0 border=0>";

                $result = mysqli_query($dbcon, $query);
                  echo "<tr>";
                  echo "<td class=head><b>StudID</b></td>";
                  echo "<td class=head><b>StudName</b></td>";
                  echo "<td class=head><b>Address</b></td>";
                  echo "<td class=head><b>Course</b></td>";
                  echo "<td class=head><b>Department</b></td>";
                  echo "<td class=head><b>Section</b></td>";
                  echo "<td class=head><b>Delete</b></td>";
                  echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".$row['StudID']."</td>";
                  echo "<td>".$row['StudName']."</td>";
                  echo "<td>".$row['Address']."</td>";
                  echo "<td>".$row['CourseName']."</td>";
                  echo "<td>".$row['DeptName']."</td>";
                  echo "<td>".$row['SectionName']."</td>";
                  echo "<td><a href=delete.php?id=".$row['StudID']."&acctype=".$acctype."&tb=Student><img src=img/delete.png class=edit2></a></td>";
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
                  $qry = "SELECT Count(StudID) FROM student";
                  $res=mysqli_query($dbcon, $qry);
                  while ($row = mysqli_fetch_array($res)) {
                  echo "<b>".$row[0]."</b> Record(s) found. ";
               }   
              ?>
            </div>
              <button type="button" onclick ="document.getElementById('id04').style.display='none'" class ="cancelbtn">Cancel</button>
            </div>
          </div>
         
      </div>


</div>



<div class="sidebar-right-attendance">
<?php $acctype = $_GET['acctype'];
    if ($acctype == 'User') { ?>
	<div class="hidden"></div>
<?php } else { ?>
    <div class="hidden-admin"></div>
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
              <img src="img/student-view.png" class="img-home-attend">
            </div>
            <div class="attend2">
              <button class="button-home" onclick="document.getElementById('id02').style.display='block'">View Student</button>
            </div>
       </div>
       <?php 
             $acctype = $_GET['acctype'];

             if ($acctype == 'Admin') {
        ?>
       <div class="student-view">
          <div class="attend1">
            <img src="img/student-add.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home" onclick="document.getElementById('id03').style.display='block'">Add Student</button>
          </div>
       </div>
       <div class="student-view">
          <div class="attend1">
            <img src="img/student-del.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home-attend" onclick="document.getElementById('id04').style.display='block'">Delete Student</button>
          </div>
       </div>
       <?php 
        }
        ?>
       <div class="container-footer-home-user">
          <?php 
              echo "<a href=home.php?acctype=".$acctype."><button class=button-back-home>&nbsp;&nbsp;&nbsp;Home</button></a>";
          ?>
       </div>
  </div>

   <!--  //////////////////// The Modal ///////////////////// -->
     <div id="id03" class="modal-insert-student">
      <div class="modal-1-addstud">
        <span onclick ="document.getElementById('id03').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        
        echo "<form method=post action=insert.php?acctype=".$acctype."&tb=Student class=modal-content animate>";
       ?>
          <div class="imgcontainer-student">
            <img src="img/student-add-1.png" alt="Avatar" class="avatar-student-stud">
          </div>
          <div class="container">
            <label><b>Student ID</b></label>
            <input type="text" name="txtStudID" class="select1-stud" placeholder="Enter StudID" required="">
            <label><b>Student Name</b></label>
            <input type="text" name="txtStudName" class="select1-stud" placeholder="Enter StudentName" required="">
            <label><b>Address</b></label>
            <input type="text" name="txtAddress" class="select1-stud" placeholder="Enter Address" required="">
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

            <div class="course-sect-stud">
              <div class="course-sect1">
                 <label><b>Course</b></label>
                  <select class="select-attend-dept-course-sect" id="Course" name="cboxCourse">
                      <option>--Course--</option>
                    </select>
              </div>
              <div class="course-sect2">
                <label><b>Section</b></label>
                  <select name="cboxSection" id="Section" class="select-attend-dept-course-sect">
                      <option>--Section--</option>
                  </select>
              </div>
            </div>
            <div class="container-footer-stud-1">
              <button type="submit">Add Student</button> 
            </div>
          </div>          
        </form>
      </div> 
    </div>

</div>


</div>
</body>
</html>
