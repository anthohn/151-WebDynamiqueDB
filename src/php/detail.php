<?php
require "header.php";
$id = $_GET["idTeacher"];
$teachers = $db->getOneTeacher($id);
$sections = $db->getOneTeacherSection($id);
?>
        <?php foreach($teachers as $teacher): ?> 
        <h3>Détails : <?= $teacher["teaName"] ?><?= " ";?><?= $teacher["teaFirstname"] ?><p>Sexe :
            <?php if($teacher["teaGender"] == "M")
            {
                echo '<img src="../../userContent/maleGender.png" width"22px" height="22px" alt="icons">';
            }
            else if ($teacher["teaGender"] == "W")
            {
                echo '<img src="../../userContent/femaleGender.png" width"22px" height="22px" alt="icons">';
            }
            else if ($teacher["teaGender"] == "O")
            {
                echo "Autre";
            }?></p> 
        <?php foreach($sections as $section): ?> 
        <p>Section : <?= $section["secName"] ?></p> 
        <?php endforeach; ?>   
        <a href="editTeacher.php?idTeacher=<?= $teacher["idTeacher"]; ?>"><img src="../../userContent/edit.svg"></img></a>
        <a href="deleteTeacher.php?idTeacher=<?= $teacher["idTeacher"]; ?>" onclick="return confirm('Êtes vous sûr de voiloir supprimer l\'enseignant ?')"><img src="../../userContent/trash.svg"></img></a>
        </h3>
        
        <h4>Surnom : <?= $teacher["teaNickname"] ?></h4>
        <h4>Origine : <?= $teacher["teaOrigin"] ?></h4>
        <?php endforeach; ?>  
        <div class="back">
            <a href="index.php"><img width="100px" src="../../userContent/backArrow.svg"></img></a>
        </div>
<?php require "footer.php";
