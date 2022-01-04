<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 29.09.2021
Filename    : modifyUser.php
Description : Page for modify existing users
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}
include("common/dbConnect.php");

$user = $password = $isActive = $isAdmin = "";

//Query for modify
if(isset($_POST['modifyUser'])){
    if(!empty($_POST['password'])){
        $pdo->query("UPDATE User SET password=\"".$_POST['password']."\" WHERE username=\"".$_SESSION['username']."\"");
    }
    $pdo->query("UPDATE User SET isValid=".$_POST['isActive']." WHERE username=".'"'.$_SESSION['username'].'"');
    $pdo->query("UPDATE User SET isAdmin=".$_POST['isAdmin']." WHERE username=".'"'.$_SESSION['username'].'"');
    unset($_SESSION['user']);
    $_SESSION['userModified'] = true;
    header("location: usersManager.php");
}

//Query for upload info of the user
if(isset($_GET['username'])){
    $userInfo = $pdo->query("SELECT idUser, isValid, isAdmin FROM User WHERE username=\"".$_GET['username']."\"")->fetch();
    $user = $_GET['username'];
    $isActive = $userInfo['isValid'];
    $isAdmin = $userInfo['isAdmin'];
}

include('common/header.php');
?>
<br>
<div class="text-center">
    <form class="mx-5 px-2">
        <div class="form-row">
            <label for="username"><strong>Nom d'utilisateur : </strong><?php echo $user; $_SESSION['username'] = $user;?></label>
        </div>
        <div class="form-row">
            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
        </div>
        <div class="form-row">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="inactiveUser" name="isActive" value="0" <?php if($isActive == 0) echo "checked"?>>
                <label class="form-check-label" for="inactiveUser">Compte inactif </label><br>
                <input type="radio" class="form-check-input" id="activeUser" name="isActive" value="1" <?php if($isActive == 1) echo "checked"?>>
                <label class="form-check-label" for="activeUser">Compte actif </label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="roleCollaborateur" name="isAdmin" value="0" <?php if($isAdmin == 0) echo "checked"?>>
                <label class="form-check-label" for="roleCollaborateur">Collaborateur</label>
                <input type="radio" class="form-check-input" id="roleAdministrateur" name="isAdmin" value="1" <?php if($isAdmin == 1) echo "checked"?>>
                <label class="form-check-label" for="roleAdministrateur">Administrateur</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" formmethod="post" name="modifyUser">Modifier l'utilisateur</button>
        <a href="usersManager.php" class="btn btn-primary" role="button">Annuler</a>
    </form>
</div>

<?php include("common/footer.php");?>