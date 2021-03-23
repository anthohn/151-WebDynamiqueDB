<?php 
require "database.php";
$db = new Database();
require "header.php";?>
<form method="POST" action="addTeacher.php">
    <h2>Ajout d'un enseignant</h2>
    <ul>
        <li>
            <input type="radio" name="gender" id="man" value="M">Homme 
            <input type="radio" name="gender" id="woman" value="W">Femme
            <input type="radio" name="gender" id="other" value="O">Autre
        </li>
        <div class="aeratext">
            <li>            
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name">
            </li>
            <li>
                <label for="surname">Prénom :</label>
                <input type="text" name="surname" id="surname">
            </li>
            <li>
                <label for="nickname">Surnom :</label>
                <input type="nickname" name="nickname" id="nickname">
            </li>
        </div>    
        <li>
        <label for="origin">Origine :</label>
        <textarea id="origin" name="origin"> 
        </textarea>
        </li>
        <li>
            <select name="section">
                <option value="section">Section</option>
                <option value="informatique">Informatique</option>
                <option value="theorie">Théorie</option>
            </select>
        </li>        
        <li>
            <input type="submit" name="submit" id="submit" value="submit">
            <button type="reset" id="" name="">Effacer</button>
        </li>
    </ul>
</form>
<div class="test">
    <a href="index.php"><img width="100px" src="userContent/backArrow.svg"></img></a>
</div>
<?php

if(isset($_POST["submit"]))
{
    if(empty($_POST["gender"]) || empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["nickname"]) || empty($_POST["origin"]))
    {
        echo "Veuillez renseignez tous les champs.";
    } 
    else {
        $teachers = $db->getAllTeachers();

        $db->addTeacher($_POST['gender'], $_POST['name'], $_POST['surname'], $_POST['nickname'], $_POST['origin']);
        // $db->addTeacherSection($section['idSection'], max($teachers['idTeachers']) + 1);
        echo "<h1>Enseigant bien ajouté</h1>";
        header('Location: index.php');
    }
}





?>
<?php require "footer.php";?>
