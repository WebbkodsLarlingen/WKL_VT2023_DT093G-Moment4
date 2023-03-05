<?php include("include/config.php");?>
<?php $currentBtnAdmin=2; $currentBtn=7; // Mark current page in <nav> (see c-nav.php) & Moment 4 nav 

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
    // Show success message after succeeding logging in
    showSessionSuccess('loginSuccess','Du är nu inloggad!');
    // Show failure message when trying to logout without using log out button
    showSessionError('logOutWithoutBtn','Logga ut med Logga ut-knappen!');
    
     ?>
     <span style="font-size: 0.8rem;"><?php 
     if(isLoggedIn()){ // Show username if logged in
        echo "Inloggad: " . strval($_SESSION['username']);
     } else { // Else show info that you are not logged in
        echo "Ej inloggad";
     }
     ?> </span>
     <?php  // If logged in then show button for log out
     if(isLoggedIn()){
         ?>
    <input type="submit" name="loginOut" value="Logga ut" id="logoutBtn">
    <?php } else { // Otherwise, show links to login or register
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

 <?php if(isLoggedIn()){ ?>
 <li class="menu-btn2 <?php echo setCurrentBtnAdmin(3);?>">
 <a href="p-moment4-manage-blogposts.php">Hantera inlägg</a>
</li>
<?php }?>
</ul>

<?php showSessionError('id-error','Du kan inte visa inget inlägg!');?>

<hr>
<h3 style="margin-top:10px;">Nya blogginlägg</h3>
<?php
// Retrieve the two latest published blog posts
$currentBlogposts = $DB->getAllBlogPosts("");
// and check if 0 blog posts exist by checking length of array
if(count($currentBlogposts) == 0){
    // If zero blog posts exist, echo info about that
    echo showError('Inga blogginlägg finns!');
} 
    // If blogposts do exist, output them with foreach()
    // substr() is used to only show YYYY-MM-DD HH:MM by removing :SS(seconds)
    // mb_substr() only shows first 200 characters of each blog post
else {
    foreach($currentBlogposts as $blogpost){
        ?> 
        <h4 style="margin-top:20px;"><?= htmlspecialchars($blogpost['blogpost_title'], ENT_QUOTES, 'UTF-8');?></h4>
        <p style="font-size:0.9rem; font-weight:bold; margin-bottom:5px;"><?= "Postad: " . blogPublishDate($blogpost['blogpost_created']) . $blogpost['blogpost_created_by'];?></p>
        <p style="font-size:1rem;"><?php 
        // Only cut length of blogpost and add ... when over 200 characters long
        if(mb_strlen(htmlspecialchars($blogpost['blogpost_text'],ENT_QUOTES, 'UTF-8')) > 200){
        echo mb_substr(htmlspecialchars($blogpost['blogpost_text'], ENT_QUOTES, 'UTF-8'),0,200) . "...";
        } else { echo htmlspecialchars($blogpost['blogpost_text'], ENT_QUOTES, 'UTF-8');} ?></p>
        <p style="text-align:right;">
            <a class="backA" style="color: #1bbb85;" href="p-moment4-view-blogpost.php?id=<?=$blogpost['id'];?>">Läs mer</a></p>            
        <?php
    }
}
 ?>
<hr>

</div>

<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>