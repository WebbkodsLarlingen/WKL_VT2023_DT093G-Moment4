<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=4;
    ?>
<title><?= pageTitle("4. Formulär"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 2 - 4. Formulär</h2>
<div class="uppgifts-div" id="special1">
    <h3>Del 1 - Skicka data med GET</h3>
    <?php
    // Kolla att Skicka knapp klickats
    if(isset($_GET['skicka1'])){

        // Kolla att BÅDA fält matats in
    if(!empty($_GET['fname']) && !empty($_GET['ename'])){
        
        // Ta bort kodtaggar först
        $_GET['fname'] = strip_tags($_GET['fname']);
        $_GET['ename'] = strip_tags($_GET['ename']);

        // Skriv sedan ut för -& efternamn
        echo "Hej " . htmlspecialchars($_GET['fname']) . " " . htmlspecialchars($_GET['ename']);
       
    }
    // Annars skriv ut uppmaning om att mata in båda fält.
    else{
        echo "<span style='color: red; font-size:1rem;'>Du måste ange både för- och efternamn!</span>";
    }
}
    ?>
    <form id="form" action="p-forms.php" method="GET">
        <div>
        <label for="fnamn">Förnamn:</label>
        <input id="fnamn" type="text" name="fname">
        </div>
        <div>
        <label for="enamn">Efternamn:</label>
        <input id="enamn" type="text" name="ename">
        
        </div>
        <input type="submit" name="skicka1" value="Skicka" id="send">
    </form>
    <h3>Del 2 - Skicka data med POST</h3>
    <form id="form2" action="p-calculate.php" method="POST">
    <div>
        <p style="font-size: 1rem; margin-bottom: 5px;">Beräkna arean på en yta genom att ange längd och bredd.</p>
        <label for="langd">Längd:</label>
        <input id="langd" type="number" name="langd">
        </div>
        <div>
        <label for="bredd">Bredd:</label>
        <input id="bredd" type="number" name="bredd">
        </div>
        <input type="submit" value="Skicka" name="skicka2" id="send2">
    </form>

    <?php echo nextPage('p-fileread','5. Filinläsning');?>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>