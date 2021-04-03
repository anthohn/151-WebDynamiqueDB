<?php require "lib/database.php";
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
                   
                    <form method="post" action="">
                    <label>Surnom des enseignants</label>
                    

                        <input type="text" placeholder="Login" name="login">

                        <input type="text" placeholder="Mot de passe" name="psw">

                        <button type="submit" name="forminscription">Se Connecter</button>
                    </form>
                </div>
            </div>
            <nav class="navBar">
                <ul>
                    <li>Zone pour le menu</li>
                </ul>
            </nav>
            <?php

if(isset($_POST["forminscription"]))
{
    if(!empty($_POST["login"]) || (!empty($_POST["psw"])))
    {
        $user = $db->connectUser($_POST['login'], $_POST['psw']);
    }
    else
    {
        $erreur = "Veuillez renseignez tous les champs !";
        echo $erreur;
    }
}

?>