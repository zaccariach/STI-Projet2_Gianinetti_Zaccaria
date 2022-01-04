<?php
/*
Author      : Dylan Canton & Christian Zaccaria
Date        : 28.09.2021
Filename    : newEmail.php
Description : Page for write a new email
*/

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
    header('location: login.php');
}
include("common/dbConnect.php");

$receiver = $subject = $content = "";
$receiver_err = $subject_err = $content_err = "";


if(isset($_GET['id'])){
    $emailDetails = $pdo->query("SELECT dateReception, sender, receiver,subject, text FROM Message WHERE idMessage=".$_GET['id'])->fetch();
    if($_SESSION['username'] == $emailDetails['receiver']){
        $receiver = $emailDetails['sender'];
        $subject = "RE: ".$emailDetails['subject'];
        $content = "\r\n------------------------------------------------------------\r\n De : ".$receiver."\r\nEnvoyé le : ".$emailDetails['dateReception']."\r\nSujet : ".$emailDetails['subject']."\r\nMessage : ".$emailDetails['text'];
    }
}

if(isset($_POST['submitEmail'])){
    if(!empty($_POST['receiver'])){
        $receiver = filter_var($_POST['receiver'], FILTER_SANITIZE_STRING);
    } else {
        $receiver_err = "Destinataire requis !";
    }

    if(!empty($_POST['subject'])){
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    } else {
        $subject_err = "Sujet requis !";
    }
    if(!empty($_POST['content'])){
        $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    } else {
        $content_err = "Message vide !";
    }

    if(empty($receiver_err) && empty($subject_err) && empty($content_err)){
        $checkreceiver = $pdo->query("SELECT * FROM User WHERE username=".'"'.$receiver.'"')->fetch();
        $receiverexist = !empty($checkreceiver);

        if($receiverexist){
            $_SESSION['newEmailreceiver'] = $receiver;
            $_SESSION['newEmailsubject'] = $subject;
            $_SESSION['newEmailcontent'] = $content;

            try{
                $pdo->query("INSERT INTO Message (sender, receiver, subject, text) VALUES ('".$_SESSION['username']."','".$_SESSION['newEmailreceiver']."',".'"'.$_SESSION['newEmailsubject'].'",'.'"'.$_SESSION['newEmailcontent'].'"'.")");
                $_SESSION['emailSent'] = true;
                unset($_SESSION['newEmailreceiver']);
                unset($_SESSION['newEmailsubject']);
                unset($_SESSION['newEmailcontent']);
                header('location: newEmail.php');
            } catch(PDOException $e){
                echo $e->getMessage();
            };
        } else {
            $receiver_err = "Destinataire inconnu !";
        }
    }
}
include("common/header.php");
?>
<div class="text-center">
    <br>
    <form method="post" id="newEmail">
        <strong>Destinataire: </strong><input type="text" name="receiver" value="<?php echo $receiver; ?>"><?php echo $receiver_err; ?><br>
        <strong>Sujet: </strong><input type="text" name="subject" value="<?php echo $subject; ?>"><?php echo $subject_err; ?><br>
        <strong>Message: </strong><textarea rows="6" cols="50" name="content" form="newEmail"><?php echo $content; ?></textarea><br/>
        <?php echo $content_err; ?>
        <input type="submit" name="submitEmail" class="btn btn-info" role="button" value="Envoyer">
    </form>
    <?php if(isset($_SESSION['emailSent']) && $_SESSION['emailSent'] === true){
        echo "<h4>Message envoye!</h4>";
        unset($_SESSION['emailSent']);
    } ?>
    <a href="home.php" class="btn btn-primary" role="button">Retour</a>
</div>

<?php include("common/footer.php");?>