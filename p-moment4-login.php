<?php include("include/config.php");?>
<?php $currentBtn=7;
// Mark current page in <nav> (see c-nav.php)
        // Clicked on login?
        if(clickedP('login') && !Validate::isEmpty($_POST['dataLoginName']) && !Validate::isEmpty($_POST['dataLoginPass'])){
            // Store Användarnamn och Lösenord in $_POST variables
            $user = setPost('dataLoginName');
            $pass = setPost('dataLoginPass');

            // Here we assume login succeeeded
            if($DB->loginUser($user,$pass)){
                // So go straight to admin panel
                $_SESSION['loginSuccess'] = 1; // Indicate what success message should be shown
                header("Location: p-moment4.php"); // Redirect
            }}

// Redirect if is logged in ($_SESSION exists) already and navigated to p-moment4.php
if(isLoggedIn()){header("Location: p-moment4.php");}
    // This is the redirected Login page so no need for CheckLoginOrRedirect() here
    ?>
<title><?= pageTitle("Moment 4 - Ej inloggad"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 4 - Dataanslutningar med PHP | Inloggning</h2>
<div class="uppgifts-div" id="special1">
    <h3 style="text-align: left;">Logga in</h3>
    <form id="form3" action="p-moment4-login.php" method="POST">
        <div class="login-rows">
            <div class="login-parts">
                <input id="dataLoginName" class="login-fields fieldListen" type="text" name="dataLoginName">
                <label for="dataLoginName">Användarnamn</label>
            </div>
            <div class="login-parts">
                <input id="dataLoginPass" class="login-fields fieldListen" type="password" name="dataLoginPass" autocomplete="off">
                <label for="dataLoginPass">Lösenord</label>
            </div>
            
            <div style="display: flex; flex-direction: row; gap: 10px; justify-content: space-between; width: 100%;">
                <input type="submit" name="login" value="Logga in" id="loginBtn">
                <p><a style="display:inline-block; line-height: 3;" class="backA" href="p-moment4-register.php">Registrera</a></p>
            </div>
            
        </div>
        <?php 
        // Clicked on Login button?
        if(isset($_POST['login'])){
            // Are one of the login fields empty?
            if(Validate::isEmpty($_POST['dataLoginName']) || Validate::isEmpty($_POST['dataLoginPass'])){
                // Demand both fields being filled out
                echo showError("Ange både användarnamn och lösenord först!<br>");
            }
        }

        // Clicked on login?
        if(clickedP('login') && !Validate::isEmpty($_POST['dataLoginName']) && !Validate::isEmpty($_POST['dataLoginPass'])){
            // Store Användarnamn och Lösenord in $_POST variables
            $user = setPost('dataLoginName');
            $pass = setPost('dataLoginPass');

            // Here we assume failed login due to wrong username/password
            if(!$DB->loginUser($user,$pass)){
                // Thus show error on how to fix
                echo showError("Fel användarnamn och/eller lösenord!");}
        }
        // Arrived on page through redirect?
        showSessionError('redirected','Du måste logga in först!<br>');

        // Arrived on page after logging out?
        showSessionSuccess('loggedOut','Du har loggats ut!<br>');

        // Arrived by trying to log out without logout button when not logged in
        showSessionError('wrongLogout','Du kan inte logga in utan att vara inloggad!<br>');

       // Arrived after successfully registering blog account
       showSessionSuccess('registerSuccess','Du kan nu logga in med registrerat användarnamn och lösenord!<br>');

        ?>
    </form>  
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>