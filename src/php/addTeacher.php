<?php 
require "header.php";
$sections = $db->getAllSections(); 
?>
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
                <input type="text" name="nickname" id="nickname">
            </li>
        </div>    
        <li>
        <label for="origin">Origine :</label>
        <textarea id="origin" name="origin"></textarea>
        </li>
        <li>
            <div class="selectSection input">
                <select name="section" id="section">
                    <option value="0">Section </option>
                    <?php foreach($sections as $section) : ?>
                        <option value="<?= $section["idSection"]; ?>"><?= $section["secName"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </li>        
        <li>
            <div class="button">
                <div class="btnAdding">
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Ajouter" />
                    <button type="reset" id="btnDelete" name="btnDelete">Effacer</button>
                </div>
            </div>
        </li>
    </ul>
</form>
<div class="test">
    <a href="index.php"><img width="100px" src="../../userContent/backArrow.svg"></img></a>
</div>
<?php

if(isset($_POST["btnSubmit"]))
{
    if(empty($_POST["gender"]) || empty($_POST["name"]) || empty($_POST["surname"]) || empty($_POST["nickname"]) || empty($_POST["origin"]) || $_POST["section"] == 0 )
    {
        echo "<h1 style='background-color:red; border-radius: 20px; text-align:center; height: 50px; width: 600px;'>Veuillez renseigner tous les champs !</h1>";
    } 
    else {
        $teachers = $db->getAllTeachers();
        $db->addTeacher( $_POST['name'], $_POST['surname'],$_POST['gender'], $_POST['nickname'], $_POST['origin']);
        $db->addTeacherSection($section['idSection']);
        echo "<h1 style='background-color:green; border-radius: 20px; text-align:center; height: 50px; width: 600px; color: white;'>L'enseigant a bien été ajouté !</h1>";
        
    }
}
?>
<?php require "footer.php";?>
