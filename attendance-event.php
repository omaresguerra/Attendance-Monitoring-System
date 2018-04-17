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
</div>


<div class="sidebar-right-attendance">
<?php $acctype = $_GET['acctype'];
    if ($acctype == 'User') { ?>
  <div class="hidden"></div>
<?php } else { ?>
    <div class="hidden-admin-att-view"></div>
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
      <?php $acctype = $_GET['acctype']; echo "<form method=post action=attendance.php?acctype=".$acctype.">"; ?>
       <div class="student-view-att-eve">
          <div class="container-att-view">
             <label class="left-att"><b>Select Event first.</b></label>
                  <?php 
                    include('config.php');

                    $query = "SELECT * FROM event";

                    $result = mysqli_query($dbcon, $query);

                    echo "<select class='select-attend-att-view' name='cboxEvent'>";

                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['EventID'].">".$row['EventName']."</option>";
                      }
                    echo "</select>";
                 ?>
          </div>
       </div>
      
       <div class="student-view-att-eve">
          <div class="attend2-view-att">
            <button class=button-home-attend-att-view>Add Event</button>
          </div>
       </div>
       <?php echo "</form>"; ?>
       <div class="container-footer-home-user">
          <?php 
              echo "<a href=home.php?acctype=".$acctype."><button class=button-back-home>&nbsp;&nbsp;&nbsp;Home</button></a>";
          ?>
       </div>
  </div>
</div>


</div>
</body>
</html>
