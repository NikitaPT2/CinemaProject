<?php 
    $servername = "localhost:3306"; // Adrese un ports, uz kuru pieslēdzas datubāzes serveris
    $username = "root"; // Lietotājvārds datubāzes pieslēgšanai
    $password = ""; // Parole datubāzes pieslēgšanai
    $dbname = "cinema2"; // Nosaukums datubāzei, kurai piekļūs
    $connection = mysqli_connect($servername, $username, $password, $dbname); // Pieslēgšanās datubāzei

    if(!$connection){
        die("Connection failed:".mysqli_connect_error()); // Ja nav izdevies pieslēgties datubāzei, tad izvada kļūdas paziņojumu
    }else{
      #echo "Connected successfully!"; // Ja izdevies veiksmīgi pieslēgties datubāzei, tad izvada paziņojumu par veiksmīgu pieslēgšanos
    }
?>