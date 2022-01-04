<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 24.09.2021
Filename    : home.php
Description : Homepage for user, display received messages
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}

include("common/dbConnect.php");

try {
    //Execute query to get messages
    $query = $pdo->prepare('SELECT * FROM Message WHERE receiver = ? ORDER BY dateReception DESC, sender');
    $query->execute(array($_SESSION['username']));
    $messageList = $query->fetchAll();
} catch(PDOException $e){
    echo $e->getMessage();
}

include('common/header.php');

//Here for message when you delete a email
if (isset($_SESSION['emailDeleted']) && $_SESSION['emailDeleted'] == true)
    echo '<div class="alert alert-success" role="alert">Message supprimé ! </div>';
else if (isset($_SESSION['emailDeleted']) && $_SESSION['emailDeleted'] == false)
    echo '<div class="alert alert-danger" role="alert"><strong>Erreur: </strong> le message n' . "'" . 'a pas pu être supprimé ! Veuillez réessayer plus tard.</div>';
unset($_SESSION['emailDeleted'])
?>

<table class="table text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Expediteur</th>
            <th scope="col">Sujet</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($messageList as $message){
        echo "<tr>";
        echo "<td>".$message['dateReception']."</td>";
        echo "<td>".$message['sender']."</td>";
        echo "<td>".$message['subject']."</td>";
        echo "<td>";
        echo '<div class="btn-group-vertical btn-group-sm pt-1">
                <a href="email.php?id='.$message['idMessage'].'" class="btn btn-primary" role="button">Details</a>
                <a href="newEmail.php?id='.$message['idMessage'].'" class="btn btn-secondary btn-warning" role="button">Repondre</a>
                <a href="deleteEmail.php?id='.$message['idMessage'].'" class="btn btn-secondary btn-danger" role="button">Supprimer</a>
            </div>';
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php include('common/footer.php');?>