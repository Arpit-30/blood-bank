<?php
     $username="root";
     $servername="localhost";
     $password="";
     $database="blood_donation";
 
     $conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        echo"no coonnection to database";
    }

?>