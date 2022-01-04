<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 29.09.2021
Filename    : usersManager.php
Description : Management users page for admins
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}
include("common/dbConnect.php");

try {
    //Execute query to catch all users
    $users = $pdo->query("SELECT username FROM User");
} catch(PDOException $e){
    echo $e->getMessage();
}

include('common/header.php');

if(isset($_SESSION['userModified']) && $_SESSION['userModified'] == true)
    echo '<div class="alert alert-success" role="alert">Utilisateur modifié !</div>';
else if(isset($_SESSION['userModified']) && $_SESSION['userModified'] == false)
    echo '<div class="alert alert-danger" role="alert"><strong>Erreur: </strong> l'."'".'utilisateur n'."'".'a pas pu être modifié. Veuillez réessayer plus tard.</div>';
unset($_SESSION['userModified']);

if(isset($_SESSION['userDeleted']) && $_SESSION['userDeleted'] == true)
    echo '<div class="alert alert-success" role="alert">Utilisateur supprimé !</div>';
else if(isset($_SESSION['userDeleted']) && $_SESSION['userDeleted'] == false)
    echo '<div class="alert alert-danger" role="alert"><strong>Erreur: </strong> l'."'".'utilisateur n'."'".'a pas pu être supprimé. Veuillez réessayer plus tard.</div>';
unset($_SESSION['userDeleted']);
if(isset($_SESSION['userAdded']) && $_SESSION['userAdded'] == true)
    echo '<div class="alert alert-success" role="alert">Nouvel Utilisateur ajouté !</div>';
else if(isset($_SESSION['userAdded']) && $_SESSION['userAdded'] == false)
    echo '<div class="alert alert-danger" role="alert"><strong>Erreur: </strong> l'."'".'utilisateur n'."'".'a pas pu être ajouté. Veuillez réessayer plus tard.</div>';
unset($_SESSION['userAdded']); ?>

<div class="text-center">
    <table class="table text-center">
        <thead class="thead-light">
        <tr>
            <th scope="col">Utilisateur</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($users as $user){
            echo "<tr>";
            echo "<td>".$user['username']."</td>";
            echo "<td>";
            echo '<div class="btn-group-vertical btn-group-sm pt-1">
                    <a href="modifyUser.php?username='.$user['username'].'" class="btn btn-secondary btn-warning" role="button">Modifier l'."'".'utilisateur</a>
                    <a href="deleteUser.php?username='.$user['username'].'" class="btn btn-secondary btn-danger" role="button">Supprimer l'."'".'utilisateur</a>
                </div>';
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <a href="addUser.php" class="btn btn-info" role="button">Créer un nouvel utilisateur</a>
    <a href="home.php" class="btn btn-primary" role="button">Retour</a>
</div>

<?php include('common/footer.php')?>