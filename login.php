<!DOCTYPE html>
<html>
<head>
	<title>LogIn-Attendance Monitoring System</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
	 <div class="modal-func-login">
        <div class="modal-content-func">
          <div class="imgcontainer">
            <img src="img/avatar1.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <label><b>Username</b></label>
           	<div class="input"> 
           			<?php 
	                    include('config.php');
	                    $username = $_POST['txtUserName'];
                    	echo "$username";
                	?>
                	
             </div>
            <label><b>Password</b></label>
            <input class="input" type="password" style="background-color: #fff; margin-bottom: 10px;" disabled value=
            		<?php 
	                    include('config.php');
	                    $password = $_POST['txtPassword'];
                    	echo "$password";
                	?>
            >
            		
            <br>
            <?php
				include('config.php');
				session_start();
				$username=$_POST['txtUserName'];
				$password=$_POST['txtPassword'];

				if (empty($_POST['txtUserName']) || empty($_POST['txtPassword'])){
					// echo "<b style=color:red>**Username/Password is empty!</b>";
					header('Location:index.php');
				}
				else{

					$query = "SELECT * FROM login 
					WHERE UserName='$username' and Password='$password'";

					$qry = "SELECT AccountName FROM accounttype 
					JOIN login ON accounttype.AccTypeID = login.AccTypeID
					WHERE UserName='$username' and Password='$password'";
					
					$acc = mysqli_query($dbcon, $qry);
					$result = mysqli_query($dbcon, $query);

					while ($row=mysqli_fetch_array($acc)) {
						$acct = $row['AccountName'];
						$_SESSION['AccountName'] = $acct;
					}
					
					if(!$result || mysqli_num_rows($result) <= 0){

						// echo "<b style=color:red>**Error logging in. The username or password does not match.</b>";
						header('Location:index.php');
					}
					else{

						if ($acct == "Admin") {
							$_SESSION['UserName'] = $username;
							// echo "<b style=color:#00d600>*Login successfully! Welcome ADMIN!</b>";
							// echo "<center><a href=home.php?acctype=".$acct."><button class=btn0>Start</button></a></center>";
							header('Location:home.php?acctype='.$acct);
						}
						else{
							$_SESSION['UserName'] = $username;
							// echo "<b style=color:#00d600>*Login successfully! Welcome USER!</b>";
							// echo "<center><a href=home.php?acctype=".$acct."><button class=btn0>Start</button></a></center>";
							header('Location:home.php?acctype='.$acct);
						}
						$_SESSION['id']=$_POST['txtUserName'];
						if (isset($_SESSION['id'])){
						echo "congrats the session is running";
						}
						else {
						echo "no session";
						}
					}
				}
			?>	
          </div>

          <div class="container-footer-func">
	           <a href="index.html"><button type="submit" class="btn1">Back</button></a>
          </div>
        </div>
    </div>
</div>
</body>
</html>