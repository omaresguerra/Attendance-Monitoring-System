<?php
	session_start();
	session_destroy();
	if(isset($_SESSION['id'])){
       header("Location:login.php");
    }
?>