<?php include("include/config.php");?>
<?php $currentBtnAdmin=3; $currentBtn=7; // Mark current page in <nav> (see c-nav.php)
// Redirect to login page if not logged in and set Session error message to be shown there
checkLoginOrRedirect();

// Is Logged in AND Clicked on a "Radera inlägg" link?
if(clickedG('deleteid')){
    // Get integer value from clicked "Radera inlägg" link
    $blogpost = intval(setGet('deleteid'));
    // Try delete correct chosen blogpost by correct username
    if($DB->deleteDBRow($_SESSION['username'],"blogposts",$blogpost)){

        // If true, meaning it could delete, prepare success message
        $_SESSION['delete-post-success'] = 1;
        unset($_GET['deleteid']); // and unset the value of deleteid
    }
    // When failed to delete (trying to delete a post that does not exist)
    else { 
        // Prepare fail message and unset value of deleteid
        $_SESSION['delete-post-fail'] = 1; unset($_GET['deleteid']);}
}

 // Is Logged in AND Clicked on Publicera successfully?
 if(clickedP('post-blogpost')){
    // Now check several stuff before publishing
    if(strlen($_POST['newBlogTitle']) != 0  // Blog title not zero characters long
    && Validate::isLeastLength($_POST['newBlogTitle'],15) // Blog title at least 15 characters long
    && Validate::isMaxAllowedLength($_POST['newBlogTitle'],64) // Blog title at most 64 characters long
    && strlen($_POST['newBlogText']) != 0 // Blog text not zero characters long
    && Validate::isMaxAllowedLength($_POST['newBlogText'],4000) // Blog text at most 4000 characters long
    )
    // When ALL above is TRUE then publish
    {
        // Store $_POST variables and current user for easier SQLing
        $title = $_POST['newBlogTitle']; // blog title
        $text = $_POST['newBlogText']; // blog text
        $user = $_SESSION['username']; // current logged in user

        // Insert into Database using insertDB function which first takes name of table (blogposts) and then an infinite amount of 
        // arguments. It takes the columns and then the values for them. So first send name of columns and then the values which
        // would be variables $title, $text and $user in this case!
        if($DB->insertDB("blogposts","blogpost_title","blogpost_text","blogpost_created_by",$title,$text,$user)){
            // If succeeds then prepare session to show success message further down and not showing errors when emptying filled out fields
            $_SESSION['blogpost-success'] = 1;

            // Because we successfully published a blog post we can erase the otherwise filled out fields
            $_POST['newBlogTitle'] = ""; // Such as "Titel"
            $_POST['newBlogText'] = ""; // And "Innehåll"
        }
        else{ // Otherwise prepare failure message to show
            $_SESSION['blogpost-failure'] = 1;
        }
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
    // Show success message when blogpost with deleteid=X could be deleted!
    showSessionSuccess('delete-post-success','Blogginlägget har raderats!');

    // Show failure message when blogpost with deleteid=X could NOT be deleted!
    showSessionError('delete-post-fail','Blogginlägg saknas eller du saknar tillstånd att radera!');

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

<?php showSessionError('id-error','Du kan inte visa inget inlägg!');?>

<hr>
<h3 style="margin-top:10px;">Hantera inlägg - Skriva inlägg</h3>

<h4 style="margin-top:10px;">Skriv nytt blogginlägg</h4>

<form id="form3" action="p-moment4-manage-blogposts.php" method="POST">
<div class="login-rows2">
    <div class="login-parts">
       <input id="newblogTitle" class="login-fields fieldListen" type="text" name="newBlogTitle" value="<?= previousFieldvalueP('post-blogpost','newBlogTitle'); ?>">
        
         <label for="newblogTitle">Titel</label>
         <?php 
         // Demand filling out empty field ONLY if not succesfully published blogpost
         if(!isset($_SESSION['blogpost-success'])){
         fillOutEmptyFieldP("post-blogpost","newBlogTitle","Ange en titel för blogginlägget!");}

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
        <textarea id="newblogText" style="resize: none;" class="login-fields fieldListen textarea" name="newBlogText"><?= previousFieldvalueP('post-blogpost','newBlogText');?></textarea>
        <label for="newblogText">Innehåll</label>
        <?php // VERY IMPORTANT: <textarea> above must be on a single line of code or whitespace will appear despite otherwise being empty!!!
        // This is why I could not separate it with ENTER to write a comment there

        // Demand filling out empty field ONLY if not succesfully published blogpost
        if(!isset($_SESSION['blogpost-success'])){
        fillOutEmptyFieldP("post-blogpost","newBlogText","Skriv textinnehåll för blogginlägget!");}
         
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
 <input type="submit" name="post-blogpost" value="Publicera inlägg" id="publishBtn">
 <?php 
 // Did we manage to post a blog bost? Then show success message and unset $_SESSION
 showSessionSuccess('blogpost-success',"Du har publicerat blogginlägget!");
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
             <p style="font-size:0.9rem; font-weight:bold;">[<?=blogPublishDateShort($blogpost['blogpost_created'])?>]: <?= htmlspecialchars($blogpost['blogpost_title'], ENT_QUOTES, 'UTF-8');?> </p>
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