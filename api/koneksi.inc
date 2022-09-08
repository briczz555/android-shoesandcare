<?php

    $host = "localhost";
    $user = "454210";
    $pass = "Jancok123";
    $dbnm = "454210";

    try{
        $conn = new PDO("mysql:host=$host; dbname=$dbnm", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "";
        return $conn;
    }catch (PDOException $e){
        echo "Error : " .$e->getMessage();
    }

?>