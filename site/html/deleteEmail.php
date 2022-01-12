<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Modified by : Lucas Gianinetti & Christian Zaccaria on 12.01.2022
Date        : 28.09.2021
Filename    : deleteEmail.php
Description : delete an email
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] === false){
    header('location: login.php');
}

if(!empty($_POST['token'])) {
    if ($_SESSION['token'] == $_POST['token']) {
        include("common/dbConnect.php");
        try{
            $receiver = $pdo->query("SELECT receiver FROM Message WHERE idMessage=".$_POST['idMessage'])->fetch();
            if($receiver['receiver'] == $_SESSION['username']){
                $query = $pdo->prepare('DELETE FROM Message WHERE idMessage= ?');
                $query->execute(array($_POST['idMessage']));
                $_SESSION['emailDeleted'] = true;
            } else {
                $_SESSION['emailDeleted'] = false;
            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        header("location: home.php");
    }
    else{
        session_destroy();
        header('location: login.php');
    }
}else{
    session_destroy();
    header('location: login.php');
}

?>