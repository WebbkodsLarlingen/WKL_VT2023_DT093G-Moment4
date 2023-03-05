<?php include("include/config.php");
                // WHEN REGISTER SUCCEEDS!
                    // Clicked on Registrera?
                    if(clickedP('register')){
                        // Check the following first, all must be TRUE
                        if(
                            // Valid Username Length    
                            Validate::validUsernameLength($_POST['RegisterUsername']) 
                            // Valid Username Type
                            && Validate::validUsernameType($_POST['RegisterUsername']) 
                            // Valid Email
                            && Validate::isEmail($_POST['RegisterEmail'])
                            // Both Password Fields are same
                            && Validate::IsTwoSame($_POST['RegisterPass'],$_POST['RegisterPassCheck'])
                            // Both Password Fields are valid
                            && Validate::validPassword($_POST['RegisterPass'])
                            && Validate::validPassword($_POST['RegisterPassCheck'])
                            // Username doesn't already exist
                            && !$DB->userAlreadyExist($_POST['RegisterUsername'])
                            // Email doesn't already exist
                            && !$DB->emailAlreadyExist($_POST['RegisterEmail'])
                        ) // Iff All of  Above is TRUE then and only then...
                        { // Register new user in database
                            if($DB->registerUser($_POST['RegisterUsername'],$_POST['RegisterEmail'],$_POST['RegisterPass'])){
      // Set Session so user is taken to login page after registration
      $_SESSION['registerSuccess'] = 1;}}}
// Check if user registered and then send them to login page
if(isset($_SESSION['registerSuccess'])){ header("Location: p-moment4-login.php");}?>
<?php $currentBtn=7; // Mark current page in <nav> (see c-nav.php)?>
<title><?= pageTitle("Moment 4 - Registrera dig först!"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 4 - Dataanslutningar med PHP | Registrering</h2>
<div class="uppgifts-div" id="special1">
<h3 style="text-align: left;">Registrera dig</h3>
<form id="form3" action="p-moment4-register.php" method="POST">
        <div class="login-rows2">
            <div class="login-parts">
                <input id="dataRegisterName" class="login-fields fieldListen" type="text" 
                name="RegisterUsername" value="<?php echo previousFieldvalueP('register','RegisterUsername'); ?>">
                <label for="dataRegisterName">Användarnamn</label>
                <?php 
                // Demanding to fill out empty field
                fillOutEmptyFieldP("register","RegisterUsername","Ange ett användarnamn");

                // Clicked on Registrera?
                if(clickedP('register')){

                // If string length of Username is not zero but is not at least 6 characters long or more than 21 characters
                if(strlen($_POST['RegisterUsername']) != 0 && !Validate::validUsernameLength($_POST['RegisterUsername'])){
                        // Then show error on how to fix
                        echo showError("Användarnamn ska vara mellan 6 och 21 tecken långt.");
                    }
               // If string of username is not zero but contains forbidden characters
               if(strlen($_POST['RegisterUsername']) != 0 && !Validate::validUsernameType($_POST['RegisterUsername'])){
                        // Then show error on how to fix
                        echo showError("Användarnamn får endast innehålla små bokstäver av a-z.");
                    }

                    // If Username is already in use in database
                    if(strlen($_POST['RegisterUsername']) != 0 && $DB->userAlreadyExist($_POST['RegisterUsername'])){
                        // Then show error on how to fix
                        echo showError("Användarnamnet används redan. Välj ett annat!");
                    }

                if(Validate::validUsernameLength($_POST['RegisterUsername']) && Validate::validUsernameType($_POST['RegisterUsername']) && !$DB->userAlreadyExist($_POST['RegisterUsername'])){
                    echo showSuccess("Användarnamn är ledigt och giltigt.");
                }

            }
                ?>
                
            </div>
            <div class="login-parts">
                <input id="dataRegisterEmail" class="login-fields fieldListen" type="text" 
                name="RegisterEmail" value="<?php echo previousFieldvalueP('register','RegisterEmail'); ?>">
                <label for="dataRegisterEmail">E-post</label>
                <?php 
                // Demanding to fill out empty field
                fillOutEmptyFieldP("register","RegisterEmail","Ange en giltig e-postadress först");

                // Clicked on Registrera?
                if(clickedP('register')){

                    // If string length of email is not 0 but is still invalid
                    if(strlen($_POST['RegisterEmail']) != 0 && !Validate::isEmail($_POST['RegisterEmail'])){
                        // Then show error on how to fix
                        echo showError("E-post ska vara i stil med: exempel@domän.se");
                    }

                    
                    // If Email is already in use in database
                    if(strlen($_POST['RegisterEmail']) != 0 && $DB->emailAlreadyExist($_POST['RegisterEmail'])){
                        // Then show error on how to fix
                        echo showError("E-postadressen används redan. Ange en annan!");
                    }

                    if(strlen($_POST['RegisterEmail']) != 0 && Validate::isEmail($_POST['RegisterEmail']) && !$DB->emailAlreadyExist($_POST['RegisterEmail'])){
                        echo showSuccess("E-postadressen är ledig och giltig.");
                    }
                }
                ?>
            </div>
            <div class="login-parts">
                <input id="dataLoginPass" class="login-fields fieldListen" type="password" 
                name="RegisterPass">
                <label for="dataLoginPass">Lösenord</label>
                <?php 
                // Demanding to fill out empty field
                fillOutEmptyFieldP("register","RegisterPass","Ange ett giltigt lösenord först");

                // Clicked on Registrera?
                if(clickedP('register')){

                    // If string length of Password (first field) is not zero but still invalid
                    if(strlen($_POST['RegisterPass']) != 0 && !Validate::validPassword($_POST['RegisterPass'])){

                        // Then show error on how to fix
                        echo showError("Lösenord ska vara mellan 12-24 tecken långt.<br>- Minst en siffra<br>- Minst en stor bokstav<br>- Minst en liten bokstav<br>- Minst ett specialtecken<br>- A-Z, 0-9 och specialtecknen _?!- får användas!");
                    }
                }
                ?>
            </div>
            <div class="login-parts">
                <input id="dataRegisterPassCheck" class="login-fields fieldListen" type="password" 
                name="RegisterPassCheck">
                <label for="dataRegisterPassCheck">Upprepa lösenord</label>
                <?php 
                // Demanding to fill out empty field
                fillOutEmptyFieldP("register","RegisterPassCheck","Ange ett upprepat giltigt lösenord först");

                // Clicked on Registrera?
                if(clickedP('register')){

                    // If both Passwords fields are not empty then...
                    if($_POST['RegisterPass'] != "" && $_POST['RegisterPassCheck'] != ""){
                    // ... check if both Password Fields do NOT contain same values...
                    if(!Validate::IsTwoSame($_POST['RegisterPass'],$_POST['RegisterPassCheck'])){
                        // And Then show error on how to fix
                        echo showError("Både lösenordsfältet och upprepning ska vara lika.");
                    }} else if ($_POST['RegisterPassCheck'] != ""){
                        echo showError("Mata in samma giltiga lösenord här som ovan.");
                    }

                }


                ?>
            </div>

            <div style="display: flex; flex-direction: row; justify-content: space-between; width: 100%;">
            
                <input type="submit" name="register" value="Registrera" id="registerBtn">
                <p><a style="display:inline-block; line-height: 3;" class="backA" href="p-moment4.php">Logga in</a></p>
            </div>
            
        </div>
        <?php 
             
?>

    </form>
    
</div>

<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>