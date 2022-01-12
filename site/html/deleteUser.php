<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Modified by : Lucas Gianinetti & Christian Zaccaria on 12.01.2022
Date        : 29.09.2021
Filename    : deleteUser.php
Description : Delete one user
*/
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}

if(!empty($_POST['token'])){
    if($_SESSION['token'] == $_POST['token']){
        include("common/dbConnect.php");
        try{
            $user = $pdo->query("SELECT username FROM User WHERE username=\"".$_POST['username']."\"")->fetch();
            if(!empty($user['username'])){
                if($user['username'] == $_SESSION['username']){
                    $_SESSION['userDeleted'] = false;
                }
                else{
                    $pdo->query("DELETE FROM User WHERE username=\"".$_POST['username']."\"");
                    $_SESSION['userDeleted'] = true;
                }
            } else {
                $_SESSION['userDeleted'] = false;
            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        header("location: usersManager.php");
    }
    else{
        session_destroy();
        header('location: login.php');
    }
} else{
    session_destroy();
    header('location: login.php');
}

?>