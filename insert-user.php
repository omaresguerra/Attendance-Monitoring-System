<!DOCTYPE html>
<html>
<head>
  <title>Insert-Attendance Monitoring System</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-index">
   <div class="modal-func">
       <div class="hidden-insert-secu"></div>
    <div class="modal-content-func">
        <div class="imgcontainer">
          <img src=img/avatar-add.png alt=Avatar class=avatar-func>
        </div>
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
                          echo "<a href=index.php><button type=submit class=btn1>&nbsp;&nbsp;&nbsp;Back</button></a>";
                        ?>
                       
                    </div>
     </div>
   </div>
</div>
</body>
</html>
