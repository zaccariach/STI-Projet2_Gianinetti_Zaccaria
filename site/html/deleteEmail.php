<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 28.09.2021
Filename    : deleteEmail.php
Description : delete an email
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] === false){
    header('location: login.php');
}

include("common/dbConnect.php");

try{
    $receiver = $pdo->query("SELECT receiver FROM Message WHERE idMessage=".$_GET['id'])->fetch();
    if($receiver['receiver'] == $_SESSION['username']){
        $query = $pdo->prepare('DELETE FROM Message WHERE idMessage= ?');
        $query->execute(array($_GET['id']));
        $_SESSION['emailDeleted'] = true;
    } else {
        $_SESSION['emailDeleted'] = false;
    }
} catch(PDOException $e){
    echo $e->getMessage();
}

header("location: home.php");