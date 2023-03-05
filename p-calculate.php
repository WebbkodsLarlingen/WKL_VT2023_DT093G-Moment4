<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=4;
    ?>
<title><?= pageTitle("Startsida"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<div class="uppgifts-div" id="special1">
<h3 id="specialh2">Beräkna arean</h3>
<?php

// Kolla att Skicka knapp klickats
if(isset($_POST['skicka2'])){
         // Kolla att BÅDA fält matats in
         if(!empty($_POST['langd']) && !empty($_POST['bredd'])){
            echo "Längden " . $_POST['langd'] . " meter" . " och bredden " . $_POST['bredd'] . " meter ger arean: " . $_POST['langd']*$_POST['bredd'] . " &#13217;";
        }
        // Annars skriv ut uppmaning om att mata in båda fält.
        else{
            echo "<span style='color: red; font-size:1rem;'>Både längd och bredd måste anges!</span>";
        }
        echo "<br><br><a href='p-forms.php' class='backA' style='display:block; text-align:center;'>Gå tillbaks till föregående sida</a>";
}
?>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>