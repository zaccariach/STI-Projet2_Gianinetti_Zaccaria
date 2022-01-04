<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 26.09.2021
Filename    : dbConnect.php
Description : Trying connection to db
*/
    try {
        $pdo = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Impossible to connect into DB : ". $e->getMessage();
    }
?>