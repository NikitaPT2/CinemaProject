<?php 
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "cinema";
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if(!$connection){
        die("Connection failed:".mysqli_connect_error());
    }else{
      #echo "Connected successfully!";
    }
?>