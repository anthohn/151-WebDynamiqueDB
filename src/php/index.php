<?php 
require "header.php";
$teachers = $db->getAllTeachers();
?>
        
        <table>
            <tr>
                <h3>Liste des enseignants <div class="add"><a href="addTeacher.php"><img src="../../userContent/add.svg" height="50"></img></a></div> </h3>       
                <th>Nom</th>
                <th>Surnom</th>
                <th>Actions</th>
            </tr>
            <?php foreach($teachers as $teacher): ?>
            <tr>
                <td><?= $teacher["teaName"] ?><?= " ";?><?= $teacher["teaFirstname"] ?></td>
                <td><?= $teacher["teaNickname"] ?></td>
                <td>
                    <a href="detail.php?idTeacher=<?= $teacher["idTeacher"]; ?>"><img src="../../userContent/edit.svg"></img></a>
                    <button onclick="myFunction()"><img src="../../userContent/trash.svg"></img><?= $teacher["idTeacher"]; ?></a></button>
                    <a href="detail.php?idTeacher=<?= $teacher["idTeacher"]; ?>"><img src="../../userContent/search.svg"></img></a>
                    <script>
                        function myFunction()
                        {
                            var msg = confirm("Êtes-vous sûr de vouloir supprimer l'enseignant ?");
                            if (msg == true) {
                                
                            } else {
                                alert("Action annulée");
                            }
                        }
                    </script>
                    </div>
                </td>
                
            </tr>   
            <?php endforeach; ?>    
        </table>    
<?php require "footer.php";