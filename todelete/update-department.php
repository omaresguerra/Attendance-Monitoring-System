<!DOCTYPE html>
<html>
<head>
  <title>Update-Attendance Monitoring System</title>
</head>
<style type="text/css">
  body{ font-family:Verdana,sans-serif; font-size:15px; margin: 0 auto; color: #686868; background-image: url(img/Road.jpg); background-size: 1366px; background-position: center; background-repeat: no-repeat;}
  .modal { width: 100%; background-color: rgba(0,0,0,.8);
    margin: 0 auto; padding-top: 35px; height: 627px;}
  .modal-content { background-color: #fff; margin: 0px auto;   border: 1px solid #888; width: 35%; box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); padding-bottom: 20px; border-radius: 10px;}
  .imgcontainer {text-align: center; margin: 14px 0 12px 0; }
  .avatar { width: 160px; margin-top:0px;}
  .container { padding:0.01em 16px; margin-top:16px; }
  .input { width: 100%; padding: 10px 15px; margin: 5px 0 9px; display: inline-block; border: 1px solid #b6b6b6; box-sizing: border-box; font-family:Verdana,sans-serif; font-size:15px; border-radius: 4px; color: #686868; height: 42px;}
  .container-footer {padding:0.01em 16px;margin-top:1px;padding-bottom: 0px;background-color:#fff; text-align: center; margin-top: 8px;}
  .btn {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 50%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: 5px; background-image: url(img/back.png); background-repeat: no-repeat; background-size: 85px; background-position:left;}
  button {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 50%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: -12px; margin-top: 15px; background-image: url(img/backto.png); background-repeat: no-repeat; background-size: 95px; background-position:right; }
  .btn:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
   button:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
   b{ margin-top: 20px;}
   .update{ width: 90%; height: 20px; background-color: #fff; padding-top: 10px; padding-left: 15px; margin-bottom: 15px;}
</style>
<body>
   <div class="modal">
        <div class="modal-content">
          <div class="imgcontainer">
            <img src="img/attendance2.png" alt="Avatar" class="avatar">
          </div>      
                <?php
                include('config.php');
                $deptid = $_POST['id'];
                $name = $_POST['deptname'];

                if (empty($_POST['deptname'])) {
                    $query0A = "SELECT * FROM department WHERE DeptID = '".$deptid;
                    $result0A = mysqli_query($dbcon, $query0A);

                    echo "<div class=container>
                    <label><b>DeptName</b></label>";
                    echo "<div class=input>";
                    echo "$deptid";
                    echo "</div>
                    <div class=update>
                    <b style=color:#f00;>**DeptName is empty!</b>
                    </div>";
                }
                else{

                     $query = "UPDATE department SET DeptName='$name' WHERE DeptID='$deptid'";

                     if(mysqli_query($dbcon, $query)){

                    echo "<div class=container>
                    <label><b>DeptName</b></label>";
                    echo "<div class=input>";
                    echo "$name";
                    echo "</div></div>
                    <div class=update>
                    <b style=color:#00d600;>*Data updated successfully!</b>
                    </div>";
                    }
                    else{
                      echo "<h3>Error!</h3>".mysqli_error($dbcon);
                    }
                }                    
            ?>
          <div class="container-footer">
              <?php
              $acctype = $_GET['acctype'];
              
                echo "<a href=department.php?acctype=".$acctype."><button type=submit class=btn>Back</button></a>";
              ?>
             
          </div>
        </div>
    </div>
</body>
</html>
