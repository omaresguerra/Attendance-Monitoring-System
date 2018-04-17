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
  .input { width: 100%; padding: 10px 15px; margin: 5px 0 9px; display: inline-block; border: 1px solid #b6b6b6; box-sizing: border-box; font-family:Verdana,sans-serif; font-size:15px; border-radius: 4px; color: #686868;}
  .container-footer {padding:0.01em 16px;margin-top:1px;padding-bottom: 0px;background-color:#fff; text-align: center; margin-top: 8px;}
  .btn {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 50%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: 5px; background-image: url(img/back.png); background-repeat: no-repeat; background-size: 85px; background-position:left;}
  button {font-size:16px; background-color: #f67400; border: none; color: #fff; padding: 8px 15px; margin: 8px 0; cursor: pointer; width: 50%; font-size: 18px; font-weight: bold; font-family:Verdana,sans-serif; -webkit-transition: all 0.4s ease; transition: all 0.4s ease; border-radius: 4px; height: 47px; margin-bottom: -12px; margin-top: 15px; background-image: url(img/backto.png); background-repeat: no-repeat; background-size: 95px; background-position:right; }
  .btn:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
   button:hover { box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);}
   b{ margin-top: 20px;}
   .update{ width: 100%; height: 20px; background-color: #fff; padding-top: 7px;}
</style>
<body>
   <div class="modal">
        <div class="modal-content">
          <div class="imgcontainer">
            <img src="img/attendance2.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <label><b>Attend ID</b></label>
            <div class="input">
                <?php
                include('config.php');

                $attendid = $_POST['id'];
                $stud = $_POST['cboxStudent'];
                $event = $_POST['cboxEvent'];
                $attendtime = $_POST['time'];

                $query = "UPDATE attendance SET StudID='".$stud."', EventID='".$event."', AttendTime='".$attendtime."' WHERE AttendID=".$attendid;

                $query0 = "SELECT * FROM attendance";

                $query0A = "SELECT AttendTime FROM attendance
                WHERE AttendID = $attendid";

                $query1 = "SELECT StudName FROM student JOIN attendance ON attendance.StudID = student.StudID
                  WHERE AttendID = $attendid";

                $query2 = "SELECT EventName FROM event JOIN attendance ON attendance.EventID = event.EventID
                  WHERE AttendID = $attendid";

                $result = mysqli_query($dbcon, $query);
                $result0 = mysqli_query($dbcon, $query0);
                $result0A = mysqli_query($dbcon, $query0A);
                $result1 = mysqli_query($dbcon, $query1);
                $result2 = mysqli_query($dbcon, $query2);

                while ($row0=mysqli_fetch_array($result0)) {
                    $acct0= $row0['AttendID'];
                }  
                    echo "$acct0";

                    echo "</div>
                    <label><b>Student</b></label>
                    <div class=input>";

                while ($row1=mysqli_fetch_array($result1)) {
                    $acct1= $row1['StudName'];
                }  
                    echo "$acct1";

                    echo "</div>
                    <label><b>Event</b></label>
                    <div class=input>";

                 while ($row2=mysqli_fetch_array($result2)) {
                    $acct2 = $row2['EventName'];
                }  
                    echo "$acct2";

                    echo "</div>
                    <label><b>Time</b></label>
                    <div class=input>";

                while ($row0A=mysqli_fetch_array($result0A)) {
                    $acct0A = $row0A['AttendTime'];
                } 
                    echo "$acct0A";
            ?>
          </div>
              <div class="update">
              <b style="color:#00d600;">*Data updated successfully!</b>
              </div>
          <div class="container-footer">
              <?php
              $acctype = $_GET['acctype'];
              
                echo "<a href=attendance.php?acctype=".$acctype."><button type=submit class=btn>Back</button></a>";
              ?>
             
          </div>
        </div>
    </div>
</body>
</html>
