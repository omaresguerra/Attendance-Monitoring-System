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
  <title>Home-Attendance Monitoring System</title>
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
<script type="text/javascript" src="jquery-1.11.0.js"></script>
<script>
 $(document).ready(function(){
    var $win = $(window);

    $('div.body-home').each(function(){
        var scroll_speed = 2;
        var $this = $(this);
        $(window).scroll(function() {
            var bgScroll = -(($win.scrollTop() - $this.offset().top)/ scroll_speed);
            var bgPosition = 'center '+ bgScroll + 'px';
            $this.css({ backgroundPosition: bgPosition });
        });
    });
});
</script>
<script>
 $(document).ready(function(){
    var $win = $(window);

    $('div.downbar1').each(function(){
        var scroll_speed = 2;
        var $this = $(this);
        $(window).scroll(function() {
            var bgScroll = -(($win.scrollTop() - $this.offset().top)/ scroll_speed);
            var bgPosition = 'center '+ bgScroll + 'px';
            $this.css({ backgroundPosition: bgPosition });
        });
    });
});
</script>
<script>
 $(document).ready(function(){
    var $win = $(window);

    $('div.downbar3').each(function(){
        var scroll_speed = 2;
        var $this = $(this);
        $(window).scroll(function() {
            var bgScroll = -(($win.scrollTop() - $this.offset().top)/ scroll_speed);
            var bgPosition = 'center '+ bgScroll + 'px';
            $this.css({ backgroundPosition: bgPosition });
        });
    });
});
</script>
</head>
<body class="bg-body" onload="startTime()">
<div class="body-home">
  <?php
      $acctype = $_GET['acctype'];
  ?>
<div class="sidebar-home1">
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
</div>

<div class="sidebar-right-home">

  <div class="form-home-space">
       <div class="imgcontainer-home">
              <div class="imgcontainer-avatar-home">
                  <img src="img/csu-cics1.png" alt="Avatar" class="avatar-home">
              </div>
              <div class="dateandtime">
                  <div class="date" id="date"></div>
                  <div class="time" id="time"></div> 
              </div>
       </div>
       <div class="attend">
            <div class="attend1">
              <img src="img/attendance.png" class="img-home">
            </div>
            <div class="attend2">
              <?php 
                 echo "<a href=attendance-event.php?acctype=".$acctype."><button class=button-home>Attendance</button></a>"
              ?>
             
            </div>
       </div>
       <div class="student">
          <div class="attend1">
            <img src="img/student.png" class="img-home-stud">
          </div>
          <div class="attend2">
            <?php
            echo "<a href=student.php?acctype=".$acctype."><button class=button-home>Students</button></a>";
            ?>
          </div>
       </div>
       <div class="student">
          <div class="attend1">
            <img src="img/dept.png" class="img-home">
          </div>
          <div class="attend2">
            <?php
            echo "<a href=department.php?acctype=".$acctype."><button class=button-home>Departments</button></a>";
            ?>
          </div>  
       </div>
       <div class="student">
          <div class="attend1">
            <img src="img/course.png" class="img-home">
          </div>
          <div class="attend2">
            <?php
            echo "<a href=course.php?acctype=".$acctype."><button class=button-home>Courses</button></a>";
            ?>
          </div>  
       </div>
        <div class="student">
          <div class="attend1">
            <img src="img/section.png" class="img-home">
          </div>
          <div class="attend2">
            <?php
            echo "<a href=section.php?acctype=".$acctype."><button class=button-home>Sections</button></a>";
            ?>
          </div>  
       </div>
       <div class="student">
          <div class="attend1">
            <img src="img/calendar.png" class="img-home-event">
          </div>
          <div class="attend2">
            <?php
            echo "<a href=event.php?acctype=".$acctype."><button class=button-home>Events</button></a>";
            ?>
          </div>  
       </div>
       <div class=container-footer-home>
              <?php
              if ($acctype == "Admin") {
              ?>
              
              <div class=attend1-security>
                  <img src=img/security.png class=img-home-sec onclick="document.getElementById('id01').style.display='block'" title="Security">
              </div>
                 
                    <!-- <button class=button-home onclick="document.getElementById('id01').style.display='block'">Security</button> -->
              <?php 
                }
               ?>   
                  <a href=logout.php><button class=button-back-home1 >Log out</button></a>
                 </div>
      </div>
    </div>
</div>

<div id="id01" class="modal-log">
      <div class="modal-1">
        <span onclick ="document.getElementById('id01').style.display='none'" class="close" title ="Close" >&times;</span>
        <!--/////////// Modal Content ///////////-->
        <?php echo "<form  action=security.php?acctype=".$acctype." method=POST class=modal-content animate>" ?>
          <div class="imgcontainer">
            <img src="img/avatar1.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="txtUserName" class="input-log">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="txtPassword"  class="input-log">
            <button type="submit" onclick="document.getElementById('id02').style.display='action'">Confirm</button> 
          </div>
          <div class="container-footer">
            <button type="button" onclick ="document.getElementById('id01').style.display='none'" class ="cancelbtn">Cancel</button>
            
          </div>
        </form>
      </div>
    </div>


<div class="downbar">
  <div class="cics-mission">
      <div class="hr"></div><font class=cics-mision1>CSU Mission</font><div class="hr1"></div><br>"Transforming lives by educating for the best."
      <br><br>
      <div class="hr2"></div><font class=cics-mision1>CSU Vision</font><div class="hr3"></div><br>"CSU is committed to transform the lives<br> of people and communities through high quality <br>instruction, and innovative research, development, <br> production and extension."
  </div>
  <div class="left">
     <img src="img/research.png" class="drop">
     <img src="img/instruction.png" class="drop">
     <img src="img/extension.png" class="drop">
  </div>
</div>

<div class="downbar1">
  <div class="center">
     <font class=cics-mision3>AD OPTIMUM EDUCANS</font><br>
     <font class=cics-mision2-www1>"Educating for the best!"</font>
  </div>
</div>

<div class="downbar">
  <div class="cics-mission-2nd">
      <div class="hr"></div><font class=cics-mision1>College Goal</font><div class="hr1"></div><br>"The College shall produce competent ICS<br> professionals with a strong technical education <br> and research capabilities coupled with application <br> oriented perpective to ensure that they  can <br> effectively serve the needs of  indviduals <br> and organization."
  </div>
  <div class="left">
     <img src="img/csu.png" class="drop2">
     <img src="img/cics.png" class="drop2">
     <img src="img/carig.png" class="drop2">
  </div>
</div>

<div class="downbar3">
  <div class="center">
     <font class=cics-mision3>CAGAYAN STATE UNIVERSITY</font><br>
     <font class=cics-mision2-www>www.csu.edu.ph</font>
  </div>
</div>

<div class="downbar-about">
  <div class="center-about">
     <font class=cics-mision-about>About Us</font><br>
     <font class=cics-mision2-www2>Attendance Monitoring System</font><br>
     <font class=cics-mision2-www2>CSU | CICS</font>
  </div>
  <div class="aboutus">
    <div class="left1">
      <div class="nicole">
        <div class="profpic">
           <img src="img/nicole.png" id="drop1">
        </div>
        <div class="bio-info">
          <div class="name">nicole_naval</div>
          <div class="bio">Nicole-Anne V. Naval<br>Pengue-Ruyu, Tuguegarao City, Cagayan<br>0997-238-8429<br>nicoledyosa110596@yahoo.com</div>
        </div>
      </div>
      <div class="omar">
         <div class="profpic">
           <img src="img/omar.png" id="drop1">
        </div>
        <div class="bio-info">
          <div class="name">omar_esguerra</div>
          <div class="bio">John Omar D. Esguerra<br>Antagan 1, Tumauini, Isabela<br>0910-440-0435<br>esguerrajohnomar@gmail.com</div>
        </div>
      </div>
      <div class="kim">
         <div class="profpic">
           <img src="img/kim.png" id="drop1">
        </div>
        <div class="bio-info">
          <div class="name">kim_lacambra</div>
          <div class="bio">Kimberly-Rose L. Lacambra<br>Atulayan Sur, Tuguegarao City, Cagayan<br>0955-517-5438<br>keiar_eiyt@yahoo.com</div>
        </div>
      </div>
    </div>
    
  </div>
</div>

</body>
</html>
