<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 23.09.2021
Filename    : login.php
Description : Login page
*/

session_start();
include("common/dbConnect.php");

if(isset($_SESSION['logged']) && $_SESSION['logged'] === true){
    header('location: index.php');
    exit;
}

//Variable for error message
$message = "";

if(isset($_POST["login"])) {
    //Get informations from login form
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    //Check if form is empty
    if (!empty($username) && !empty($password)) {
        try {
            //Execute query to get account's informations
            $query = $pdo->prepare('SELECT * FROM User WHERE username = ? AND password = ?');
            $query->execute(array($username,$password));
            $loginResult = $query->fetchAll();

            //Check if there is an existing account
            if (!empty($loginResult)) {
                //Check if account is active
                if($loginResult[0]['isValid'] == 0){
                    $message = "Erreur : Ce compte est inactif, veuillez contacter un administrateur";
                }
                else{
                    //Put user infos in sessions variables
                    $_SESSION['idUser']   = $loginResult[0]['idUser'];
                    $_SESSION['username'] = $loginResult[0]['username'];
                    $_SESSION['password'] = $loginResult[0]['password'];
                    $_SESSION['isValid']  = $loginResult[0]['isValid'];
                    $_SESSION['isAdmin']  = $loginResult[0]['isAdmin'];
                    $_SESSION['logged'] = true;

                    header('location: home.php');
                }
            }
            else{
                $message = "Erreur : Nom ou mot de passe incorrect !";
            }
        } catch (PDOException $e){
            echo "Error : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <title>Login Mailbox STI</title>
    </head>
    <body class="text-center">
        <img src="resources/image.jpg">
        <form class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Login MailBox STI</h1>
            <div class="form-group">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" required>

                <button type="submit" class="btn btn-primary" formmethod="post" name="login">Login</button>
            </div>
        </form>
        <div class="errorMsg"><?php echo $message;?></div>
<?php include ('location: footer.php');?>