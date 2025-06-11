<?php
include "db.php";
$user_id = $_GET['user_id'];
$note_id = $_GET['note_id'];
$conn->query("DELETE FROM notes WHERE user_id=$user_id AND note_id=$note_id");
header("Location: myNotes.php");
?>