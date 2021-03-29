<?php
require "header.php";
$id = $_GET["idTeacher"];
$teachers = $db->deleteOneTeacher($id);
header('Location: index.php');
?>
<!-- <html>
<div class="back">
                <a href="index.php"><img width="100px" src="../../userContent/backArrow.svg"></img></a>
            </div></html> -->