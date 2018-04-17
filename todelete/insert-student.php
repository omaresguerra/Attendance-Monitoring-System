<!DOCTYPE html>
<html>
<head>
  <title>Insert-Attendance Monitoring System</title>
</head>
<style type="text/css">
  body{ font-family:Verdana,sans-serif; font-size:15px; margin: 0 auto; color: #686868; background-image: url(img/Road.jpg); background-size: 1366px; background-position: center; background-repeat: no-repeat;}
  .modal { width: 100%; background-color: rgba(0,0,0,.8);
    margin: 0 auto; padding-top: 20px; height: 642px;}
  .modal-content { background-color: #fff; margin: 0px auto;   border: 1px solid #888; width: 35%; box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); padding-bottom: 20px; border-radius: 10px;}
  .imgcontainer {text-align: center; margin: 10px 0 12px 0; }
  .avatar { width: 200px; margin-top:0px;}
  .container { padding:0.01em 16px; margin-top:16px; }
  .input { width: 100%; padding: 8px 12px; margin: 5px 0 15px; display: inline-block; border: 1px solid #b6b6b6; box-sizing: border-box; font-family:Verdana,sans-serif; font-size:15px; border-radius: 4px; color: #a0a0a0; height: 39px;}
  .container-footer {padding:0.01em 16px;margin-top:16px;padding-bottom: 8px;background-color:#fff; text-align: center; margin-top: 20px;}
  .btn {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 50%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: 5px; background-image: url(img/back.png); background-repeat: no-repeat; background-size: 95px; background-position:left;}
  button {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 50%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: -12px; margin-top: 15px; background-image: url(img/backto.png); background-repeat: no-repeat; background-size: 95px; background-position:right; }
  .btn:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
  button:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
</style>
<body>
   <div class="modal">
        <div class="modal-content">
          <div class="imgcontainer">
            <img src="img/student.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
          <label><b>Student ID</b></label>
            <div class="input">
                <?php 
                    include('config.php');
                    $studid = $_POST['txtStudID']; 
                    echo "$studid";
                ?>
            </div>
            <label><b>Student Name</b></label>
            <div class="input">
                <?php 
                    include('config.php');
                    $studname = $_POST['txtStudName']; 
                    echo "$studname";
                ?>
            </div>
            <label><b>Address</b></label>
            <div class="input">
                <?php 
                    include('config.php');
                    $address = $_POST['txtAddress']; 
                    echo "$address";
                ?>
            </div>
            <label><b>Department</b></label>
            <div class="input">
                <?php 
                    include('config.php');
                    $dept = $_POST['cboxDepartment'];
                    $query = "SELECT DeptName FROM department WHERE DeptID = $dept";
                    $result = mysqli_query($dbcon, $query);

                    while ($row = mysqli_fetch_array($result)) {
                       $department = $row['DeptName'];

                       echo "$department";
                     } 
                ?>
            </div>
            <?php
              include('config.php');

              $acctype = $_GET['acctype'];
              $studid = $_POST['txtStudID'];
              $studname = $_POST['txtStudName'];
              $address = $_POST['txtAddress'];
              $dept = $_POST['cboxDepartment'];

              $qry="SELECT * FROM student WHERE StudID ='".$studid."'";
              $result1 = mysqli_query($dbcon, $qry);
              
              
              if (empty($_POST['txtStudName']) && empty($_POST['txtAddress']) && empty($_POST['txtStudID'])){
                echo "<b style=color:red>**StudID, StudName and Address are empty!</b>";
              }
              elseif (empty($_POST['txtStudName'])) {
                echo "<b style=color:red>**StudName is empty!</b>";
              }
              elseif (empty($_POST['txtAddress'])) {
                echo "<b style=color:red>**Address is empty!</b>";
              }
              elseif (empty($_POST['txtStudID'])) {
                echo "<b style=color:red>**Student ID is empty!</b>";
              }
              elseif ($row1 = mysqli_fetch_array($result1)){
                  echo "<b style=color:red>**Can't insert record. StudID must be unique!</b>";
              }
              else {
                $query = "INSERT INTO student(StudID, StudName, Address, DeptID) Values('$studid','$studname','$address','$dept')";

                mysqli_query($dbcon, $query);

                echo "<b style=color:#00d600>**Data inserted successfully!</b>";                
              }   
          ?>  
          </div>

          <div class="container-footer">
              <?php
                echo "<a href=student.php?acctype=".$acctype."><button type=submit class=btn>Back</button></a>";
              ?>
             
          </div>
        </div>
    </div>
</body>
</html>
