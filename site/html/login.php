<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Modified by : Lucas Gianinetti & Christian Zaccaria on 12.01.2022
Date        : 23.09.2021
Filename    : login.php
Description : Login page
*/

session_start();
//Scénario 5
if(empty($_SESSION['token'])){
    //Openssl works for PHP 5.6 (Because random_bytes() or random_int() works only for with PHP 7.0+
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['token'];
//End Scénario 5

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

    // Verification of captcha
    $recaptcha = $_POST['g-recaptcha-response'];
    $secretKey = "6Lfk2CYaAAAAAMs0fgQ_vPNbRplYfD9skt9tnmHn";
    // Request (post) to google server to check recaptcha
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($recaptcha);
    $response = file_get_contents($url);
    // If true -> json
    $responseKey = json_decode($response,true);

    //Check if form is empty
    if (!empty($username) && !empty($password) && $responseKey['success']) {
        try {
            //Execute query to get account's informations
            $query = $pdo->prepare('SELECT * FROM User WHERE username = ?');
            $query->execute(array($username));
            $loginResult = $query->fetchAll();

            //Check if there is an existing account
            if (!empty($loginResult)) {
                if(password_verify($password, $loginResult[0]['password'])){
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
                    $message = "Erreur : Nom, mot de passe ou captcha incorrect !";
                }
            }
            else{
                $message = "Erreur : Nom, mot de passe ou captcha incorrect !";
            }
        } catch (PDOException $e){
            echo "Error : " . $e->getMessage();
        }
    }
    else{
        $message = "Erreur : Nom, mot de passe ou captcha incorrect !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <!-- RECAPTCHA SCENARIO -->
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        <title>Login Mailbox STI</title>
    </head>
    <body class="text-center">
        <img src="resources/image.jpg">
        <form class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Login MailBox STI</h1>
            <div class="form-group">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" maxlength="50" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit" class="btn btn-primary" formmethod="post" name="login">Login</button>
            </div>
            <!-- RECAPTCHA SCENARIO -->
            <div class="g-recaptcha" data-sitekey="6Lfk2CYaAAAAACI75fZJ1yKa5AlqwZMny85v0jUc"></div>
        </form>
        <div class="errorMsg"><?php echo $message;?></div>

<?php include ('location: footer.php');?>
