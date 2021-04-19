<?php 
session_start();
require "lib/database.php";
require "util.php";
$db = new Database();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--
		ETML
		Auteur      : Anthony Höhn
		Date        : 22.03.2021
		Description : 
		-->
        <meta charset="UTF-8">
        <link href="../../resources/css/style.css" rel="stylesheet" type="text/css" />
        <title>Surnom</title>
    </head>
    <body>
    <main>
        <table>
        <div class="topnav">
                <div class="login-container">
                    <?php if(!isLogged()): ?>
                    <form method="post" action="">
                    <label>Surnom des enseignants</label>
                    

                        <input type="text" placeholder="Login" name="login">

                        <input type="password" placeholder="Mot de passe" name="psw">

                        <button type="submit" name="forminscription">Se Connecter</button>
                    </form>
                    <?php else: ?>
                        <a href="index.php?auth=logout">Se deconnecter</a>
                    <?php endif; ?>
                </div>
            </div>
            <nav class="navBar">
                <ul>
                    <li>Zone pour le menu</li>
                </ul>
            </nav>
            <?php

if(isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] == "logout") {
    session_unset();
    session_destroy();
    header("Location:index.php");
}

if(isset($_POST["forminscription"]))
{
    if(!empty($_POST["login"]) || (!empty($_POST["psw"])))
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        $users = $db->connectUser();
        foreach($users as $user)
        {
            if($user['useLogin'] == $_POST['login'])
            {
                if(password_verify($_POST['psw'], $user['usePassword']))
                {
                    echo '<pre>';
                    print_r($_SESSION);
                    echo '</pre>';
                    $_SESSION['username'] = $user['useLogin'];
                    $_SESSION['isAdmin'] = $user['useIsAdmin'];
                    header("Location:index.php");
                }
            }
        }
    }
    else
    {
        $erreur = "Veuillez renseignez tous les champs !";
        echo $erreur;
    }
}

?>