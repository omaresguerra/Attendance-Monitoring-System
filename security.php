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
	<title>Security-Attendance Monitoring System</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
	 <div class="modal-fixed"  id="id02">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                Security
                <?php
                include('config.php');
                $acctype = $_GET['acctype'];
                $username=$_POST['txtUserName'];
                $password=$_POST['txtPassword'];
                if (empty($_POST['txtUserName']) || empty($_POST['txtPassword'])){
                  echo "";
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
                  
                  if(!$result || mysqli_num_rows($result) <= 0){
                  }
                    if($acct == "Admin") { ?>

                       <div class="search1">
                        <div class=search-div>
                         <button class=addbtn onclick="document.getElementById('id01').style.display='block'">Add User</button>
                        </div>
                      </div> 
                  <?php
                    } 
                  }
                } 
                ?>
                <?php
                $acctype = $_GET['acctype'];
                 echo "<a href=home.php?acctype=".$acctype."><div class=close-attendance title =Close>&times;</div></a>";
                 ?>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');

                $acctype = $_GET['acctype'];
                $username=$_POST['txtUserName'];
                $password=$_POST['txtPassword'];

                echo "<table cellpadding=9 cellspacing=0 border=0>";
                echo "<tr>";
                echo "<td class=head><b>UserID</b></td>";
                echo "<td class=head><b>UserName</b></td>";
                echo "<td class=head><b>Password</b></td>";
                echo "<td class=head><b>Account type</b></td>";
                echo "<td class=head><b>Edit</b></td>";
                echo "<td class=head><b>Delete</b></td></tr>";

                if (empty($_POST['txtUserName']) || empty($_POST['txtPassword'])){
                  echo "<tr><td colspan=6><center><b style=color:red>**Username/Password is empty!</b></center></td></tr>";
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
                  }

                  if(!$result || mysqli_num_rows($result) <= 0){

                    echo "<tr><td colspan=6><center><b style=color:red>**Error logging in. The username or password does not match.</b></center></td></tr>";
                  }
                  else{
                    if($acct == "Admin") {
                    $query1 = "SELECT * FROM login JOIN accounttype ON login.AccTypeID = accounttype.AccTypeID";
                    $result1 = mysqli_query($dbcon, $query1);

                    while ($row = mysqli_fetch_array($result1)) {
                        echo "<tr>";
                        echo "<td>".$row['UserID']."</td>";
                        echo "<td>".$row['UserName']."</td>";
                        echo "<td>".$row['Password']."</td>";
                        echo "<td>".$row['AccountName']."</td>";
                        echo "<td><a href=edit.php?id=".$row['UserID']."&acctype=".$acctype."&tb=Security><img src=img/edit.png class=edit1></a></td>";
                        echo "<td><a href=delete.php?id=".$row['UserID']."&acctype=".$acctype."&tb=Security><img src=img/delete.png class=edit2></a></td></tr>";
                      }
                    }
                    else{
                       echo "<tr><td colspan=6><center><b style=color:red>**Error logging in. Accountype is invalid.</b></center></td></tr>";
                    }
                  }
                }
                echo "</table>";
              ?>
              </div>          
          </div>
          <div class="button-cancel">
          	<?php
                $acctype = $_GET['acctype'];
              	echo "<a href=home.php?acctype=".$acctype."><button type=button class =cancelbtn>Cancel</button></a>";
             ?>
            </div>
          </div>
      </div>

      <!--  //////////////////// The Modal ///////////////////// -->
     <div id="id01" class="modal-insert-secu">
      <div class="modal-1">
        <span onclick ="document.getElementById('id01').style.display='none'" class="close" title ="Close" >&times;</span>
        <!-- /////////// Modal Content /////////// -->
        <?php
          $acctype = $_GET['acctype'];
        
        echo "<form method=post action=insert.php?acctype=".$acctype."&tb=Security class=modal-content animate>";
       ?>
          <div class="imgcontainer-student">
            <img src="img/security.png" alt="Avatar" class="avatar-student">
          </div>
          <div class="container">
            <label><b>User Name</b></label>
            <input type="text" name="txtUserName" class="select1" placeholder="Enter UserName">
            <label><b>Password</b></label>
            <input type="text" name="txtPassword" class="select1" placeholder="Enter Password">
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
            <button type="submit">Add User</button> 
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