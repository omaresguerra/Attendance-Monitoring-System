<!DOCTYPE html>
<html>
<head>
  <title>Insert-Attendance Monitoring System</title>
</head>
<style type="text/css">
  body{ font-family:Verdana,sans-serif; font-size:15px; margin: 0 auto; color: #686868; background-image: url(img/Road.jpg); background-size: 1366px; background-position: center; background-repeat: no-repeat;}
  .modal { width: 100%; background-color: rgba(0,0,0,.8);
    margin: 0 auto; padding-top: 50px; height: 612px;}
  .modal-content { background-color: #fff; margin: 0px auto;   border: 1px solid #888; width: 35%; box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); padding-bottom: 20px; border-radius: 10px;}
  .imgcontainer {text-align: center; margin: 10px 0 12px 0; }
  .avatar { width: 200px; margin-top:0px;}
  .container { padding:0.01em 16px; margin-top:16px; }
  .input { width: 100%; padding: 12px 10px; margin: 5px 0 15px; display: inline-block; border: 1px solid #b6b6b6; box-sizing: border-box; font-family:Verdana,sans-serif; font-size:15px; border-radius: 4px; color: #a0a0a0; height: 43px;}
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
            <img src="img/dept.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <label><b>Department Name</b></label>
            <div class="input">
                <?php 
                    include('config.php');
                    $deptname = $_POST['txtDeptName']; 
                    echo "$deptname";
                ?>
            </div>
            <?php
              include('config.php');

              $acctype = $_GET['acctype'];
              $deptname = $_POST['txtDeptName'];

              if (empty($_POST['txtDeptName'])){
                echo "<b style=color:red>**DeptName is empty!</b>";
              }
              else {
                $query = "INSERT INTO department(DeptName) Values('$deptname')";

                if(mysqli_query($dbcon, $query)){
                  echo "<b style=color:#00d600>**Data inserted successfully!</b>";        
                }
                else{
                  echo "<h2>Error!</h2>".mysqli_error($dbcon);
                }
              }   
          ?>  
          </div>

          <div class="container-footer">
              <?php
                echo "<a href=department.php?acctype=".$acctype."><button type=submit class=btn>Back</button></a>";
              ?>
             
          </div>
        </div>
    </div>
</body>
</html>
