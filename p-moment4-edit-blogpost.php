<?php include("include/config.php");?>
<?php $currentBtnAdmin=3; $currentBtn=7; // Mark current page in <nav> (see c-nav.php)
// Redirect to login page if not logged in and set Session error message to be shown there
checkLoginOrRedirect();

// Clicked on a "Ändra inlägg" link with an editid value? or just wrote it manually in address field?
$postExist=false; // Prepare postExist boolean that controls echo outputs for input fields and which blog is being edited
if(!clickedP('post-blogpost')){
if(clickedG('editid')){
    // Convert to an integer
    $id = intval($_GET['editid']);

    // Try reading in chosen blogpost from database from currently logged in user
    $editPost = $DB->getBlogPostById($id,$_SESSION['username']);

    // If blogpost does not exist (due to access denied or wrong/invalid 
    // 'editid' value), it will return zero rows so check for that first
    if(count($editPost) == 0){
        // Prepare error message to show on same page, define postExist as false and unset 'editid'
        $_SESSION['edit-post-fail'] = 1;
        $postExist = false;
    }
    // If blogpost does exist, then the user has access to it also so store values from it and output
     else {
        $postExist = true; // set postExist to true helping if statements to dynamically output
     } 
}
}

// Actually clicked on "Ändra inlägg" button?
if(clickedP('post-blogpost')){
    // Then check at least and at most lengths for the two fields
    if(
    strlen($_POST['newBlogTitle']) != 0  // Not zero length
    && strlen($_POST['newBlogText']) != 0 // Not zero length
    && Validate::isLeastLength($_POST['newBlogTitle'],15) // At least 15 characters
    && Validate::isMaxAllowedLength($_POST['newBlogTitle'],64) // At most 64 characters
    && Validate::isMaxAllowedLength($_POST['newBlogText'],4000) // At most 4000 characters
    )
    // If all OK, update in database and prepare success message
    {
        // Store variables for easier use
        $title = $_POST['newBlogTitle']; // Blog title
        $text =  $_POST['newBlogText']; // Blog text
        $id = $_GET['editid'];          // Blog id

        // Try update blogpost in database
        if($DB->updateBlogPost($title,$text,$id))
        { // Prepare success message if success
            $_SESSION['edit-post-success'] = 1;

            // Also get the updated data to dynamically replace text fields and heading "Ändra blogginlägg"
            $editPost = $DB->getBlogPostById($id,$_SESSION['username']);
            $postExist = true; // Thus that the post exists is true
        }
        // Or failure message if fail
        else {$_SESSION['edit-post-fail2'] =1;}
    }
}


?>
<title><?php
if(isLoggedIn()){
    echo pageTitle("Moment 4 - " . strval($_SESSION['username']) . " inloggad");
}else {
    echo pageTitle("Moment 4 - Ej inloggad");}?>
  </title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 4 - Dataanslutningar med PHP | <?php echo isLoggedIn() ? strval($_SESSION['username']) . " inloggad" : " Ej inloggad" ?></h2>
<div class="uppgifts-div" id="special1">

<form action="p-moment4-logout.php" method="POST" id="logoutBtnSection">
    <?php

    // Show failure when a blog post failed to load (cause access denied or does not exist) or failed to update
    showSessionError('edit-post-fail','Blogginlägg saknas eller du saknar tillstånd att ändra!');
    // Show failure when failed to update for other reason than empty fields or access denied
    showSessionError('edit-post-fail2','Blogginlägget lyckades ej att uppdateras!');

    // Show failure message when trying to logout without using log out button
    showSessionError('logOutWithoutBtn','Logga ut med Logga ut-knappen!');
    
     ?>
     <span style="font-size: 0.8rem;"><?php 
     if(isLoggedin()){
        echo "Inloggad: " . strval($_SESSION['username']);
     } else {
        echo "Ej inloggad";
     }
     ?> </span>
     <?php if(isLoggedIn()){ ?>
    <input type="submit" name="loginOut" value="Logga ut" id="logoutBtn">
    <?php } else {
        ?>
        <a class="backA" style="color: #1bbb85;" href="p-moment4-login.php">Inloggning</a>
        <a class="backA" style="color: #1bbb85;" href="p-moment4-register.php">Registrera</a>
    <?php }?>
</form>

 <ul id="nav-ul2">
 <li class="menu-btn2 <?php echo setCurrentBtnAdmin(1);?>">
 <a href="p-moment4.php">Startsida</a></li>
 <li class="menu-btn2 <?php echo setCurrentBtnAdmin(2);?>">
 <a href="p-moment4-new-blogposts.php">Nya inlägg</a></li>

 <?php if(isLoggedin()){ ?>
 <li class="menu-btn2 <?php echo setCurrentBtnAdmin(3);?>">
 <a href="p-moment4-manage-blogposts.php">Hantera inlägg</a>
</li>
<?php }?>
</ul>


<hr>
<h3 style="margin-top:10px;">Ändra blogginlägg<?php
  // Output blog title when it exists.
 if($postExist){echo " - " . htmlspecialchars($editPost[0]['blogpost_title'], ENT_QUOTES, 'UTF-8');}?></h3>

<form id="form3" action="p-moment4-edit-blogpost.php?editid=<?= $_GET['editid'];?>" method="POST">
<div class="login-rows2">
    <div class="login-parts">
       <input id="newblogTitle" class="login-fields fieldListen" type="text" 
         name="newBlogTitle" value="<?php if($postExist){echo htmlspecialchars($editPost[0]['blogpost_title'], ENT_QUOTES, 'UTF-8');} else{echo previousFieldvalueP('post-blogpost','newBlogTitle');}?>">
         <label for="newblogTitle">Titel</label>
         <?php 
         // Demand filling out empty field ONLY if not succesfully published blogpost
         if(!isset($_SESSION['blogpost-success'])){
         fillOutEmptyFieldP("post-blogpost","newBlogTitle","Du får ej lämna blogginläggets titelfält tomt!");}

         // Clicked on Publicera?
         if(clickedP('post-blogpost')){
            // Check length for between 15 and 64 characters using static public methods from Validate class.
            if(strlen($_POST['newBlogTitle']) != 0 && (!Validate::isLeastLength($_POST['newBlogTitle'],15)) || !Validate::isMaxAllowedLength($_POST['newBlogTitle'],64)){
                // And show error on how to fix when not following it
                echo showError("Blogginläggets titel ska vara mellan 15-64 tecken.");
            }
         }
         ?>
 </div>
     <div class="login-parts">
        <textarea id="newblogText" style="resize: none;" class="login-fields fieldListen textarea" name="newBlogText"><?php if($postExist){echo htmlspecialchars($editPost[0]['blogpost_text'], ENT_QUOTES, 'UTF-8');} else{echo previousFieldvalueP('post-blogpost','newBlogText');}?></textarea>
        <label for="newblogText">Innehåll</label>
        <?php // VERY IMPORTANT: <textarea> above must be on a single line of code or whitespace will appear despite otherwise being empty!!!
        // This is why I could not separate it with ENTER to write a comment there
        // Demand filling out empty field ONLY if not succesfully published blogpost
        if(!isset($_SESSION['blogpost-success'])){
        fillOutEmptyFieldP("post-blogpost","newBlogText","Du får ej lämna blogginläggets textinnehåll tomt!");}
         
         // Clicked on Publicera?
         if(clickedP('post-blogpost')){
            // Only allow up to 4000 characters in the text of blog article
            if(strlen($_POST['newBlogText']) != 0 && !Validate::isMaxAllowedLength($_POST['newBlogText'],4000)){
                // And show error on how to fix when not following it
                echo showError("Textinnehållet får vara max 4000 tecken (motsvarar cirka 500 ord) långt.");
            }
         }
         ?>
    </div>
</div>
 <input type="submit" name="post-blogpost" value="Ändra inlägg" id="publishBtn">
 <?php 
    // Show success message when blogpost has been changed successfully!
    showSessionSuccess('edit-post-success','Blogginläggets ändringar har sparats!');

 ?>
 <?php 
 
 ?>
 </form>

<hr>
<h4 style="margin-top:10px;">Befintliga blogginlägg av <?= $_SESSION['username']; ?></h4>
<?php
// Retrieve the two latest published blog posts
$currentBlogposts = $DB->getAllBlogPosts($_SESSION['username']);
// and check if 0 blog posts exist by checking length of array
if(count($currentBlogposts) == 0){
    // If zero blog posts exist, echo info about that
    echo showError('Inga blogginlägg finns. Publicera ett först!');
} 
    // If blogposts do exist, output them with foreach()
    // substr() is used to only show YYYY-MM-DD HH:MM by removing :SS(seconds)
    // mb_substr() only shows first 200 characters of each blog post
else {
    foreach($currentBlogposts as $blogpost){
        ?> 
        <div class="blogpostChangeDeleteRows">
            <div>
             <p style="font-size:0.9rem; font-weight:bold;">[<?=blogPublishDateShort($blogpost['blogpost_created'])?>]: <?= htmlspecialchars($blogpost['blogpost_title'],ENT_QUOTES, 'utf-8');?> </p>
            </div>
        <div>
        <p style="text-align:right;">
        <a class="backA" style="color: #1bbb85; font-size:0.9rem;" href="p-moment4-edit-blogpost.php?editid=<?=$blogpost['id'];?>">Ändra inlägg</a>
        <a class="backA" style="color: #1bbb85; font-size:0.9rem;" href="p-moment4-manage-blogposts.php?deleteid=<?=$blogpost['id'];?>">Radera inlägg</a>
        </p>
        </div>
        </div>
        <?php
    }
}
 ?>
<hr>

</div>

<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>