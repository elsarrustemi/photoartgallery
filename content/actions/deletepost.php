<?php
    require_once("../../database/database.php");
    $db = new Database();
    $id = $_GET['id'];
    $db -> execQuery("delete from gallery where id='$id'", "$id doest not exist in database or database internal error");
    header("Location: ../../template/fourthwebsite.php", TRUE, 303);
    die();
?>