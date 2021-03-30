<?php 
require "header.php";
$id = $_GET["idTeacher"];
$teachers = $db->getOneTeacher($id);
?>
<?php foreach($teachers as $teacher): ?> 
<form method="POST" action="addTeacher.php">
    <h2>Ajout d'un enseignant</h2>
    <ul>
        <li>
        <?php
            if ($teacher["teaGender"] == "M")
            {
                echo '<input type="radio" name="gender" id="man" value="M" checked>Homme';
                echo '<input type="radio" name="gender" id="woman" value="W">Femme';
                echo  '<input type="radio" name="gender" id="other" value="O">Autre';
            }
            else if ($teacher["teaGender"] == "W")
            {
                echo '<input type="radio" name="gender" id="man" value="M">Homme';
                echo '<input type="radio" name="gender" id="woman" value="W"checked>Femme';
                echo  '<input type="radio" name="gender" id="other" value="O">Autre';
            }
            else if ($teacher["teaGender"] == "O")
            {
                echo '<input type="radio" name="gender" id="man" value="M">Homme';
                echo '<input type="radio" name="gender" id="woman" value="W">Femme';
                echo  '<input type="radio" name="gender" id="other" value="O" checked>Autre';
            }?>
        </li>
        <div class="aeratext">
            <li>            
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" value="<?= $teacher["teaName"] ?>">
            </li>
            <li>
                <label for="surname">Prénom :</label>
                <input type="text" name="surname" id="surname" value="<?= $teacher["teaFirstname"] ?>">
            </li>
            <li>
                <label for="nickname">Surnom :</label>
                <input type="text" name="nickname" id="nickname" value="<?= $teacher["teaNickname"] ?>">
            </li>
        </div>    
        <li>
        <label for="origin">Origine :</label>
        <textarea id="origin" name="origin"><?= $teacher["teaOrigin"] ?></textarea>
        </li>
        <li>
            <select name="section">
            <?php
        

                ?>
            </select>
        </li>        
        <li>
           <div class="btnAdding">
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Ajouter" />
                <button type="reset" id="btnDelete" name="btnDelete">Effacer</button>
            </div>
        </li>
    </ul>
</form>
<?php endforeach; ?> 
<div class="test">
    <a href="index.php"><img width="100px" src="../../userContent/backArrow.svg"></img></a>
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
        echo "<h1>L'enseigant a bien été ajouté</h1>";
        // header('Location: index.php');
    }
}
?>
<?php require "footer.php";?>
