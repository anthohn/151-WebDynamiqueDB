<?php 
require "header.php";
$id = $_GET["idTeacher"];
$teachers = $db->getOneTeacher($id);
$OneSections = $db->getOneTeacherSection($id);
$sections = $db->getAllSections(); 
?> 

<?php if(isLogged() && (isAdmin())): ?>
<?php foreach($teachers as $teacher): ?> 
<form method="POST" action="editTeacher.php?idTeacher=<?= $teacher["idTeacher"]; ?>"> 
    <h2>Modifications d'un enseignant</h2>
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
                <label for="name">____Nom :</label>
                <input type="text" name="name" id="name" value="<?= $teacher["teaName"] ?>">
            </li>
            <li>
                <label for="surname">_Prénom :</label>
                <input type="text" name="surname" id="surname" value="<?= $teacher["teaFirstname"] ?>">
            </li>
            <li>
                <label for="nickname">_Surnom :</label>
                <input type="text" name="nickname" id="nickname" value="<?= $teacher["teaNickname"] ?>">
            </li>
        </div>    
        <li>
        <label for="origin">Origine :</label>
        <textarea id="origin" name="origin"><?= $teacher["teaOrigin"] ?></textarea>
        </li>
        <li>
        <select name="section" id="section">
            <?php foreach($sections as $section) : ?>
                <option name="section" value="<?= $section["idSection"]; ?>"><?= $section["secName"]; ?></option>
            <?php endforeach; ?>
           
    </select>
        </li>        
        <li>
           <div class="btnAdding">
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Modifier" />
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

if(isset($_POST["btnSubmit"]))
{
    if(empty($_POST["gender"]) || empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["nickname"]) || empty($_POST["origin"]) || empty($_POST["section"]))
    {
        echo "<h1 style='background-color:red; border-radius: 20px; text-align:center; height: 40px; width: 650px;'>Veuillez renseigner tous les champs !</h1>";
    } 
    else {
        $teachers = $db->getAllTeachers();

        $db->updateTeacher($id, $_POST['name'], $_POST['surname'], $_POST['gender'], $_POST['nickname'], $_POST['origin']);
        // $db->updateSectionTeacher($section['idSection'], max($teachers['idTeachers']) + 1);
        echo "<h1 style='background-color:green; border-radius: 20px; text-align:center; height: 40px; width: 650px; color: white;'>L'enseigant a bien été modifié !</h1>";
    }
}
?>
            <?php endif; ?>

<?php require "footer.php";?>
