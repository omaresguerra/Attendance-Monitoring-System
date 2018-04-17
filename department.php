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
  <title>Department-Attendance Monitoring System</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
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
     <!--  <div class="csu">
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
                Departments
                 <div onclick ="document.getElementById('id02').style.display='none'" class="close-attendance" title ="Close" >&times;</div>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');

                $acctype = $_GET['acctype'];

                $query = "SELECT * FROM department GROUP BY DeptID ASC";

                echo "<table cellpadding=9 cellspacing=0 border=0>";

                $result = mysqli_query($dbcon, $query);
                  echo "<tr>";
                  echo "<td class=head><b>DeptID</b></td>";
                  echo "<td class=head><b>DeptName</b></td>";

                  if ($acctype =='Admin') {
                     echo "<td class=head><b>Edit</b></td>";
                  }
                  echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".$row['DeptID']."</td>";
                  echo "<td>".$row['DeptName']."</td>";
                  if ($acctype =='Admin') {
                     echo "<td><a href=edit.php?id=".$row['DeptID']."&acctype=".$acctype."&tb=Department><img src=img/edit.png class=edit1></a></td>";
                  }
                  echo "</tr>";
                }
                echo "</table>";
              ?>
              </div>          
          </div>
          <div class="button-cancel">

              <button type="button" onclick ="document.getElementById('id02').style.display='none'" class ="cancelbtn">Cancel</button>
            </div>
          </div>
         
      </div>

      <div class="modal"  id="id04">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                Attendance
                 <div onclick ="document.getElementById('id04').style.display='none'" class="close-attendance" title ="Close" >&times;</div>
              </div>
          <div class="table-record">
              <div class="record">

                 <?php
                include('config.php');

                $acctype = $_GET['acctype'];

                $query = "SELECT * FROM department GROUP BY DeptID ASC";

                echo "<table cellpadding=9 cellspacing=0 border=0>";

                $result = mysqli_query($dbcon, $query);
                  echo "<tr>";
                  echo "<td class=head><b>DeptID</b></td>";
                  echo "<td class=head><b>DeptName</b></td>";
                  echo "<td class=head><b>Delete</b></td>";
                  echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".$row['DeptID']."</td>";
                  echo "<td>".$row['DeptName']."</td>";
                  echo "<td><a href=delete.php?id=".$row['DeptID']."&acctype=".$acctype."&tb=Department><img src=img/delete.png class=edit2></a></td>";
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
              <img src="img/dept-view.png" class="img-home-attend">
            </div>
            <div class="attend2">
              <button class="button-home" onclick="document.getElementById('id02').style.display='block'">View Department</button>
            </div>
       </div>
       <?php 
           $acctype = $_GET['acctype'];
           if ($acctype == 'Admin') {
        ?>
       <div class="student-view">
          <div class="attend1">
            <img src="img/dept-add.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home" onclick="document.getElementById('id03').style.display='block'">Add Department</button>
          </div>
       </div>
       <div class="student-view">
          <div class="attend1">
            <img src="img/dept-del.png" class="img-home-attend">
          </div>
          <div class="attend2">
            <button class="button-home-attend" onclick="document.getElementById('id04').style.display='block'">Delete Department</button>
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
     <div id="id03" class="modal-insert-dept">
      <div class="modal-1">
        <span onclick ="document.getElementById('id03').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
       <?php
          $acctype = $_GET['acctype'];
        
        echo "<form action=insert.php?acctype=".$acctype."&tb=Department method=POST class=modal-content animate>";
       ?>
          <div class="imgcontainer-student">
            <img src="img/dept-add.png" alt="Avatar" class="avatar-student">
          </div>
          <div class="container">
           
            <label><b>DeptName</b></label>
            <input type="text" name="txtDeptName" class="select1" placeholder="Enter Department" required="">
            <button type="submit" onclick="document.getElementById('id02').style.display='action'">Add Department</button> 
          </div>

          <div class="container-footer">
            <button type="button" onclick ="document.getElementById('id03').style.display='none'" class ="cancelbtn">Cancel</button>
         </div>
        </form>
      </div> 
    </div>

</div>


</div>
</body>
</html>
