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
    <div id="id01" class="modal">
      <div class="modal-1">
        <span onclick ="document.getElementById('id01').style.display='none'" class="close" title ="Close" >&times;</span>
        <!--/////////// Modal Content ///////////-->
        <form  action="login.php" method="POST" class="modal-content animate">
          <div class="imgcontainer">
            <img src="img/avatar1.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="txtUserName">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="txtPassword">
            <button type="submit" onclick="document.getElementById('id01').style.display='action'">Log in</button> 
          </div>
          <div class="container-footer">
            <button type="button" onclick ="document.getElementById('id01').style.display='none'" class ="cancelbtn">Cancel</button>
            
          </div>
        </form>
      </div>
    </div>
</div>
</body>
</html>
