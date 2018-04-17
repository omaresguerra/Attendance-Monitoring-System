<!DOCTYPE html>
<html>
<head>
  <title>Delete-Attendance Monitoring System</title>
</head>
<style type="text/css">
  body{ font-family:Verdana,sans-serif; font-size:15px; margin: 0 auto; color: #686868; background-image: url(img/Road.jpg); background-size: 1366px; background-position: center; background-repeat: no-repeat;}
  .modal { width: 100%; background-color: rgba(0,0,0,.8);
    margin: 0 auto; padding-top: 145px; height: 517px;}
  .modal-content { background-color: #fff; margin: 0px auto;   border: 1px solid #888; width: 35%; box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); padding-bottom: 20px; border-radius: 10px;}
  .imgcontainer {text-align: center; margin: 14px 0 12px 0; }
  .avatar { width: 160px; margin-top:0px;}
  .container { padding:0.01em 16px; margin-top:46px; background-color: #fff; text-align: center;}
  .input { width: 100%; padding: 12px 20px; margin: 5px 0 5px; display: inline-block; border: 1px solid #b6b6b6; box-sizing: border-box; font-family:Verdana,sans-serif; font-size:15px; border-radius: 4px; color: #a0a0a0;}
  .container-footer {padding:0.01em 16px; padding-bottom: 0px;background-color:#fff; text-align: center; margin-top: 0px;}
  .container-footer1 {padding:0.01em 16px; background-color:#fff; text-align: center; margin-right: 15px; margin-left: 15px; margin-top: 50px;}
  .btn {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 14px 0px ; cursor: pointer; width: 55%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 42px; margin-bottom: 0px; background-image: url(img/backto.png); background-repeat: no-repeat; background-size: 83px; background-position:right;}
  .btn1 {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 0px 0px; margin: 0px 0; cursor: pointer; width: 55%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 42px; margin-top: 15px; background-image: url(img/back.png); background-repeat: no-repeat; background-size: 90px; background-position:left;}
  button {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 55%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: -12px; margin-top: 15px; background-image: url(img/backto.png); background-repeat: no-repeat; background-size: 95px; background-position:right; }
  .btn:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
  .btn1:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
  button:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
  select { width: 100%; padding: 12px 10px; margin: 5px 0 15px; display: inline-block; border: 1px solid #ccc; box-sizing: border-box; font-family:Verdana,sans-serif; font-size:15px; border-radius: 4px; color: #6a6a6a; }
  b{color: #00d600;}
</style>
<body>

   <div class="modal">
        <div class="modal-content">
          <div class="imgcontainer">
            <img src="img/attendance-3.png" alt="Avatar" class="avatar">
          </div>
          
          <?php
               include('config.php');
               $attendid = $_GET['id']; 
               $acctype = $_GET['acctype'];

               $query = "DELETE  FROM attendance
               WHERE AttendID = $attendid";

              mysqli_query($dbcon, $query);
               
              echo "<div class=container><b>*Record deleted successfully!</b><div>";

              echo "<div class=container-footer1>";
               echo "<a href=attendance.php?acctype=".$acctype."><button type=submit class=btn1>Back</button></a></div>";
          ?>
        </div>
    </div>
</body>
</html>
