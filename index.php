<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Attendance Monitoring System</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-index">

<div class="sidebar">
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

</div>

<div class="sidebar-right">
  
  <div class="form">
    <div class="imgcontainer-login">
      <img src="img/csu-cics.png" alt="Avatar" class="avatar-login">
    </div>
      <button class="button-login" onclick="document.getElementById('id01').style.display='block'">Login</button>
  </div>

    <!-- //////////////////// The Modal /////////////////////-->
    <div id="id01" class="modal-log">
      <div class="modal-1">
        <span onclick ="document.getElementById('id01').style.display='none'" class="close" title ="Close" >&times;</span>
        <!--/////////// Modal Content ///////////-->
        <form  action="login.php" method="POST" class="modal-content animate">
          <div class="imgcontainer">
            <img src="img/avatar1.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="txtUserName" class="input-log" required="">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="txtPassword"  class="input-log" required="">
            <button type="submit" onclick="document.getElementById('id02').style.display='action'">Log in</button> 
          </div>
          <div class="container-footer">
            <button type="button" onclick ="document.getElementById('id01').style.display='none'" class ="cancelbtn">Cancel</button>
            <div class="insert-user">
              <img src="img/avatar-add.png" class="ins-user" onclick ="document.getElementById('id02').style.display='block'">
            </div>
          </div>
        </form>
      </div>
    </div>

    <div id="id02" class="modal-log-1">
      <div class="modal-1">
        <span onclick ="document.getElementById('id02').style.display='none'" class="close" title ="Close" >&times;</span>
        <!--/////////// Modal Content ///////////-->
        <form  action="insert-user.php" method="POST" class="modal-content animate">
          <div class="imgcontainer">
            <img src="img/avatar-add.png" alt="Avatar" class="avatar-small">
          </div>
          <div class="container">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="txtUserName" class="input-log" required="">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="txtPassword"  class="input-log" required="">
            <label><b>Account type</b></label>
                  <?php 
                    include('config.php');
                    $query = "SELECT * FROM accounttype";
                    $result = mysqli_query($dbcon, $query);
                    echo "<select class=select-stud name='cboxAccount' onmousedown='if(this.options.length>4){this.size=4;}'   onchange='this.size=0;' onblur='this.size=0;'>";
                      while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='".$row['AccTypeID']."'>".$row['AccountName']."</option>";
                      }
                    echo "</select>";
                 ?>
            <button type="submit" onclick="document.getElementById('id02').style.display='action'">Add User</button> 
          </div>
          <div class="container-footer">
            <button type="button" onclick ="document.getElementById('id02').style.display='none'" class ="cancelbtn">Cancel</button>
          </div>
        </form>
      </div>
    </div>
</div>
</div>
</body>
</html>
