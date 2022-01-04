<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 28.09.2021
Filename    : account.php
Description : Page of user account, keep info of user logged
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}

include("common/dbConnect.php");

try{
    if(isset($_POST['newPassword']) && !empty($_POST['password'])){
        $pdo->query("UPDATE User SET password=".'"'.$_POST['password'].'"'." WHERE username=".'"'.$_SESSION['username'].'"');
        $_SESSION['passwordEdited'] = true;
    }
    else if(!isset($_POST['newPassword'])){
        $_SESSION['passwordEdited'] = false;
    }
} catch(PDOException $e){
    echo $e->getMessage();
}

include("common/header.php");

?>
<div class="text-center">
    <br>
    <?php
    if(isset($_SESSION['passwordEdited']) && $_SESSION['passwordEdited'] == true)
        echo '<div class="alert alert-success" role="alert">Mot de passe modifié ! </div>';
    else if(!isset($_SESSION['passwordEdited']) && $_SESSION['passwordEdited'] == false)
        echo '<div class="alert alert-danger" role="alert">Impossible de modifier le mot de passe ! </div>';
    unset($_SESSION['passwordEdited']);
    ?>
    <h3><strong>Username : </strong><?php echo $_SESSION['username'];?></h3>
    <h3><strong>Role : </strong>
        <?php if($_SESSION['isAdmin'] == 0): echo "Collaborateur"; else : echo "Administrateur"; endif;?></h3>
    <br>
    <form>
        Changer mot de passe: <input type="password" name="password">
        <button type="submit" class="btn btn-primary" formmethod="post" name="newPassword">Changer le mot de passe</button>
    </form>
    <br>
    <a href="home.php" class="btn btn-danger" role="button">Retour aux messages</a>
</div>

<?php include("common/footer.php");?>