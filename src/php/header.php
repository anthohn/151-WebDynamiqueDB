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
                    <label>Surnom des enseignants</label>
                    <input type="text" placeholder="Login" name="login">
                    <input type="text" placeholder="Mot de passe" name="psw">
                    <button type="submit" formaction="/action_page2.php">Se Connecter</button>
                </div>
            </div>
            <nav class="navBar">
                <ul>
                    <li>Zone pour le menu</li>
                </ul>
            </nav>