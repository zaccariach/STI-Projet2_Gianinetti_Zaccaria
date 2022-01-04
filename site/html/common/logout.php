<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 24.09.2021
Filename    : logout.php
Description : Destroy session and return to login page
*/
session_start();

//Session Destroy
session_destroy();

//Return to login page
header("location: ../login.php");
?>