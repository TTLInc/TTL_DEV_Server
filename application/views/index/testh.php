<?php
// page2.php

session_start();
echo "Your Detail"."<br>";
echo $_SESSION['first_name']."<br>"; 
echo $_SESSION['gender']."<br>";
echo $_SESSION['email']."<br>"; 
   

?>