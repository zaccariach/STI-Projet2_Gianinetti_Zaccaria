<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 26.09.2021
Filename    : index.php
Description : Index of website, redirection of users
*/

if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}
else{
    header('location: home.php');
}
?>