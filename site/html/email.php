<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 28.09.2021
Filename    : email.php
Description : display email selected
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}

include("common/dbConnect.php");

try {
    //Execute query to get account's informations
    $message = $pdo->query("SELECT dateReception, sender, receiver, subject, text FROM Message WHERE idMessage=".$_GET['id'])->fetch();
} catch(PDOException $e){
    echo $e->getMessage();
}

include('common/header.php');
?>
<div class="container  text-center">
    <br>
    <div class="row">
        <div class="col-8">
            <table class="table">
                <tr>
                    <th>Date de reception:</th>
                    <td><?php echo $message['dateReception'];?></td>
                </tr>
                <tr>
                    <th>Expediteur:</th>
                    <td><?php echo $message['sender'];?></td>
                </tr>
                <tr>
                    <th>Sujet:</th>
                    <td><?php echo $message['subject'];?></td>
                </tr>
                <tr>
                    <th>Message:</th>
                    <td><?php echo nl2br($message['text'])?></td>
                </tr>
            </table>
        </div>
        <div class="col-4">
            <div class="btn-group-vertical btn-group pt-1">
                <a href="newEmail.php?id=<?php echo $_GET['id'] ?>" class="btn btn-secondary btn-warning" role="button">Repondre</a>
                <a href="deleteEmail.php?id=<?php echo $_GET['id']?>" class="btn btn-secondary btn-danger" role="button">Supprimer</a>
            </div>
        </div>
    </div>
    <a href="home.php" class="btn btn-primary" role="button">Retour</a>
</div>

<?php include('common/footer.php') ?>