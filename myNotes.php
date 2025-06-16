<?php
session_start();
include('db.php');


$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
if (!$user_id) {
  header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
  $title =  trim(htmlspecialchars($_POST["note-title"]));
  $content = trim(htmlspecialchars($_POST["note-content"]));
  $note_id = $_POST['note_id'];
$is_pinned = isset($_POST["checkbox"]) && $_POST["checkbox"] == "1" ? 1 : 0;

  echo "<h1> does this wprd$is_pinned</h1>";
  // Insert data into the database
  $sql = "UPDATE notes 
           SET title = '$title', 
               content = '$content', is_pinned = '$is_pinned',
               date_edited = current_timestamp() 
         WHERE user_id = '$user_id' AND note_id = '$note_id'";

  $conn->query($sql);
  header("Location: myNotes.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/myNotes.css">


  <title>myNotes</title>
</head>

<body id="body">



  <!-- BODY -->
  <div class="body-content">

    <!-- HEADER -->
    <header>
      

    
        <input type="text" name="search" value="Search" autocomplete="off">

        
    
        <a href="logout.php">Logout</a>
      
    </header>
    <!-- HEADER -->





    <!-- MAIN BOX -->
    <div class="notes-container">


      <!-- CREATE NOTE CONTAINER -->
      <div class="create-note-container">
        <div style="flex:1;"></div>




        <!-- CREATE NOTE BOX -->
        <div id="create-note-box" class="create-note-box">

          <!-- CREATE NOTE form -->
          <form method="post" action="create_note.php" class="create-note-form inactive-note-content" id="create-note-form" enctype="multipart/form-data">

            <textarea data-autogrower id="create-note-title" maxlength="150" class="hide" name="note-title" placeholder="Title" ></textarea>
            <textarea data-autogrow id="create-note-content" row="1" name="note-content" placeholder="What's on your mind, <?php echo "$username" ?>?" ></textarea>

            <div class="hide" id="create-note-options">
              <label for="pinned-checkbox">
                <input hidden type="checkbox" id="pinned-checkbox" name="pinned" value="1" onclick="togglePin()">
               
                  <img src="img/unpinned.svg" id="create-unpinned-icon" class="" alt="unpinned icon">
                   <img src="img/pinned.svg" id="create-pinned-icon" alt="pinned icon" class="hide">
              </label>
            </div>

          </form>
       <!-- /CREATE NOTE form -->

        </div>
          <!-- /CREATE NOTE BOX -->



        <div style="flex:1;"></div>
      </div>



      <!-- CREATED NOTES CONATAINER -->

      <div class="created-notes-container">
              <h4>Pinned</h4>
        <div class="pinned-notes"> 
        
  <?php
        // getting pinned notes
        $displayNotes = "SELECT * FROM notes WHERE user_id = $user_id AND is_pinned = 1 ORDER BY note_id DESC;";
        $userCreatedNotes = $conn->query($displayNotes);


        if ($userCreatedNotes->num_rows > 0): ?>
          <?php while ($row = $userCreatedNotes->fetch_assoc()): ?>
            <div class="display-created-note"  onclick="openNote('<?php echo $row['note_id']; ?>')"  data-id="div<?= $row['note_id'] ?>">
              <div>
                <form data-id="form<?= $row['note_id'] ?>" method="post">
                 <input type="hidden" name="note_id" value="<?= $row['note_id'] ?>">
                  <fieldset>
  
                 <textarea maxlength="60" class="display-note-title"  name="note-title" data-id="title<?= $row['note_id'] ?>"><?= $row['title'] ?></textarea>

                  <textarea name="note-content" class="display-note-content" data-id="content<?= $row['note_id'] ?>"><?= $row['content']  ?> </textarea>
                    

                  </fieldset>
                  <fieldset class="display-note-buttons-container"  data-id="display_note_buttons<?= $row['note_id'] ?>">
  

<!-- PIN PART -->  
 <input type="checkbox" hidden value="1" name="checkbox" class="delete-note-link" 
 data-id="<?= $row['note_id'] ?>" <?= $row['is_pinned'] == 1 ? 'checked' : '' ?>>
<?php 
if($row['is_pinned'] == 1):?>
<img class="pin-icon delete-note-link" src="img/pinned.svg" id="pinned-icon" alt="pinned icon" onclick="unpin('<?php echo $row['note_id'];?>')">

<?php
else:?>
  <img class="pin-icon delete-note-link" src="img/unpinned.svg" id="unpinned-icon" alt="unpinned icon" onclick="pin('<?php echo $row['note_id'];?>')">

  <?php endif; ?>
  <!-- /PIN PART -->  
                    <a  href="delete_note.php?note_id=<?= $row['note_id'] ?>&user_id=<?= $user_id ?>" class="delete-note-link"><img src="img/bin.png" alt="Delete Button"></a>

                  </fieldset>
                </form>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>




        </div>


    
               <h4>Others</h4>
        <div class="normal-notes">
              

        <?php
        // getting normal notes
        $displayNotes = "SELECT * FROM notes WHERE user_id = $user_id AND is_pinned = 0 ORDER BY note_id DESC;";
        $userCreatedNotes = $conn->query($displayNotes);


        if ($userCreatedNotes->num_rows > 0): ?>
          <?php while ($row = $userCreatedNotes->fetch_assoc()): ?>
    <div class="display-created-note"  onclick="openNote('<?php echo $row['note_id']; ?>')"  data-id="div<?= $row['note_id'] ?>">
              <div>
                <form data-id="form<?= $row['note_id'] ?>" method="post">
                 <input type="hidden" name="note_id" value="<?= $row['note_id'] ?>">
                  <fieldset>
  
                 <textarea maxlength="60" class="display-note-title"  name="note-title" data-id="title<?= $row['note_id'] ?>"><?= $row['title'] ?></textarea>

                  <textarea name="note-content" class="display-note-content" data-id="content<?= $row['note_id'] ?>"><?= $row['content']  ?> </textarea>
                    

                  </fieldset>
                  <fieldset class="display-note-buttons-container"  data-id="display_note_buttons<?= $row['note_id'] ?>">
  

<!-- PIN PART -->  
 <input type="checkbox" hidden value="1" name="checkbox" class="delete-note-link" 
 data-id="<?= $row['note_id'] ?>" <?= $row['is_pinned'] == 1 ? 'checked' : '' ?>>
<?php 
if($row['is_pinned'] == 1):?>
<img class="pin-icon delete-note-link" src="img/pinned.svg" id="pinned-icon" alt="pinned icon" onclick="unpin('<?php echo $row['note_id'];?>')">

<?php
else:?>
  <img class="pin-icon delete-note-link" src="img/unpinned.svg" id="unpinned-icon" alt="unpinned icon" onclick="pin('<?php echo $row['note_id'];?>')">

  <?php endif; ?>
  <!-- /PIN PART -->  
                    <a  href="delete_note.php?note_id=<?= $row['note_id'] ?>&user_id=<?= $user_id ?>" class="delete-note-link"><img src="img/bin.png" alt="Delete Button"></a>

                  </fieldset>
                </form>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>




        </div>

      </div>
    </div>

  </div>
  <div id="capsule" class="show-background hide"></div>
  <script src="scripts/script.js"></script>
  <script src="scripts/create_note.js"></script>
    <script src="scripts/select_note.js"></script>
</body>

</html>