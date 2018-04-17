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
	<title>Department Report-Attendance Monitoring System</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="body-fixed">
	 <div class="modal-fixed"  id="id02">
        <!-- <div class="table-attendance"> -->
          <div class="title">
              <div class="title-attendance">
                  Attendees Report
    
                <?php
                  include('config.php');
                  $acctype = $_GET['acctype'];
                  $event = $_GET['event'];

                  $qry = "SELECT * FROM event WHERE EventID = ".$event;
                  $rest = mysqli_query($dbcon, $qry);
                  echo "<form action = attendance.php?acctype=".$acctype." method = post>";
                   echo "<select name='cboxEvent' class=select-hidden>";
                      while ($rw = mysqli_fetch_array($rest)) {
                        echo "<option value='".$rw['EventID']."'></option>";
                      }
                   echo "</select>";
                
                  echo "<button class=close-attendance-button title =Close>&times;</button></form>";
                 ?>
              </div>
          <div class="table-record">
              <div class="record">

                <?php
                include('config.php');
                  $acctype = $_GET['acctype'];
                  $event = $_GET['event'];
                  echo "<table cellpadding=9 cellspacing=0 border=0>";
                  echo "<tr>";
                    echo "<td class=head><b>DeptName</b></td>";
                    echo "<td class=head><b>No of Attendees</b></td>";
                    echo "<td class=head><b>EventName</b></td>";
                    echo "</tr>";

                    $qry = "SELECT * FROM department";
                    $res = mysqli_query($dbcon, $qry);
                    while ($row = mysqli_fetch_array($res)) {
                      $department = $row['DeptID'];

                      echo "<tr><td>".$row['DeptName']."</td>";

                       $query = "SELECT Count(DISTINCT student.StudName) FROM  student JOIN attendance ON student.StudID = attendance.StudID JOIN course ON course.CourseID=student.CourseID  WHERE EventID = '".$event."' AND DeptID='".$department."'";

                        $result = mysqli_query($dbcon, $query);
                        while ($rows = mysqli_fetch_array($result)) {
                            echo "<td>".$rows[0]."</td>";
                        }

                        $query1 = "SELECT * FROM event WHERE EventID= '".$event."'";
                        $result1 = mysqli_query($dbcon, $query1);
                        while ($row1 = mysqli_fetch_array($result1)) {
                          echo "<td>".$row1['EventName']."</td>";
                        }
                        echo "</tr>";
                      }
                    echo "</table>";
                  ?>
              </div>          
          </div>
          <div class="button-cancel">
           

          	<?php
                $acctype = $_GET['acctype'];
                $event = $_GET['event'];
                $qry = "SELECT * FROM event WHERE EventID = ".$event;
                $rest = mysqli_query($dbcon, $qry);
                  echo "<form action = attendance.php?acctype=".$acctype." method = post>";
                   echo "<select name='cboxEvent' class=select-hidden>";
                      while ($rw = mysqli_fetch_array($rest)) {
                        echo "<option value='".$rw['EventID']."'></option>";
                      }
                  echo "</select>";
                  echo "<button type=submit class=cancelbtn>Cancel</button></div></form>";
             ?>
            </div>
          </div>
      </div>
</div>
</body>
</html>