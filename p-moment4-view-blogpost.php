<?php include("include/config.php");?>
<?php $currentBtnAdmin=0; $currentBtn=7; // Mark current page in <nav> (see c-nav.php)
    // Check if logged in, otherwise redirect to login page
    
    // Trying to access view-blogpost without an id
    if(!isset($_GET['id'])){
        $_SESSION['id-error'] = 1; // Set error message
        header("Location: p-moment4.php"); // to be shown on admin page
    }
    
?>
<title><?= pageTitle("Moment 4 - " . strval($_SESSION['username']) . " inloggad"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 4 - Dataanslutningar med PHP | <?php echo isLoggedIn() ? strval($_SESSION['username']) . " inloggad" : " Ej inloggad" ?></h2>
<div class="uppgifts-div" id="special1">

<form action="p-moment4-logout.php" method="POST" id="logoutBtnSection">
    <?php
    showSessionSuccess('loginSuccess','Du är nu inloggad!');
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
<?php

// Retrieve blog post by id
$currentBlogpost = $DB->getBlogPostById($_GET['id'],"");

// and check if 0 blog posts exist by checking length of array
if(count($currentBlogpost) == 0){
    // If zero blog posts exist, echo info about that
    echo "<p>Blogginlägget finns inte!</p>";
} 
    // If blogposts do exist, output them with foreach()
    // substr() is used to only show YYYY-MM-DD HH:MM by removing :SS(seconds)
    // CSS class "blogpost-feature" uses line-clamp 
else {
    foreach($currentBlogpost as $blogpost){
        ?> 
        <h3 style="margin-top:20px;"><?= htmlspecialchars($blogpost['blogpost_title'], ENT_QUOTES, 'UTF-8');?></h3>
        <p style="font-size:0.9rem; font-weight:bold; margin-bottom:5px;"><?= "Postad: " . blogPublishDate($blogpost['blogpost_created']) . $blogpost['blogpost_created_by'];?></p>
        <p style="font-size:1rem;"><?= htmlspecialchars($blogpost['blogpost_text'], ENT_QUOTES, 'UTF-8') ?></p>
        <p style="text-align:right;">
        
        <?php 
        // Only show the ability to edit a blogpost if allow editing a blogpost if correct user is logged in! Thus checking with blogposted_created_by from database!
        if(isset($_SESSION['username']))
        { 
            if($_SESSION['username'] === $blogpost['blogpost_created_by']){?>
            <a class="backA" style="color: #1bbb85;" href="p-moment4-edit-blogpost.php?editid=<?=$blogpost['id'];?>">Ändra inlägg</a></p>
        <?php }}
        
    }
}
 ?>

<hr>
</div>

<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>