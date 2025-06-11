<?php 

session_start();
include('db.php');
$user_id = $_SESSION['user_id'];

//uploading notes
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $title =  trim(htmlspecialchars($_POST["note-title"]));
  $content = trim(htmlspecialchars($_POST["note-content"]));
    $is_pinned = isset($_POST["pinned"]) && $_POST["pinned"] == "1" ? 1 : 0;



  // Insert data into the database
  $sql = "INSERT INTO notes (user_id, title, content, is_pinned,  date_created, date_edited) 
                         VALUES ('$user_id', '$title', '$content', '$is_pinned', current_timestamp(), current_timestamp());";

  $conn->query($sql);
  header("Location: myNotes.php");
}





?>