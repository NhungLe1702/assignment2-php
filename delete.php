<?php
    require "sql.php";

    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE ID = '$id' ";
    $conn -> exec($sql);
    header("location: index.php");
    // đây là comment
    // đây là comment ở máy của Vương
