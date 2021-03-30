<?php
require "header.php";
$id = $_GET["idTeacher"];
$teachers = $db->deleteOneTeacher($id);
header('Location: index.php');  
?>