<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 24.09.2021
Filename    : header.php
Description : Header
*/
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-grid.css">
        <title>Mailbox STI</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <span class="navbar-brand mb-0 h1">Mailbox STI</span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newEmail.php">New message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Account</a>
                    </li>
                    <?php if($_SESSION['isAdmin'] == true)
                        echo '<li class="nav-item"><a class="nav-link" href="usersManager.php">Users management</a></li>'
                    ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="common/logout.php">Logout</a>
                    </li
                </ul>
            </div>
        </nav>