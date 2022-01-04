<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 29.09.2021
Filename    : deleteUser.php
Description : Delete one user
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}

include("common/dbConnect.php");

try{
    $user = $pdo->query("SELECT username FROM User WHERE username=\"".$_GET['username']."\"")->fetch();
    if(!empty($user['username'])){
        if($user['username'] == $_SESSION['username']){
            $_SESSION['userDeleted'] = false;
        }
        else{
            $pdo->query("DELETE FROM User WHERE username=\"".$_GET['username']."\"");
            $_SESSION['userDeleted'] = true;
        }
    } else {
        $_SESSION['userDeleted'] = false;
    }
} catch(PDOException $e){
    echo $e->getMessage();
}

header("location: usersManager.php");
?>