<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=5;
    ?>
<title><?= pageTitle("5. Filinläsning"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 2 - 5. Filinläsning</h2>
<div class="uppgifts-div" id="special1">
    <h3>Inläsning av extern textfil</h3>
    <?php

    // Om filen ej existerar.
    if(!file_exists('courses.txt')){
        echo "Filen kunde inte hittas!";
    }

    // Öppnna annars för inläsning ('r')
    else{
       echo "Filen finns. Öppnar den nu och skriver ut som en punktlista...<br><br>";
       $fp = fopen('courses.txt','r');

       // Skriver ut <ul>-element
       echo "<ul style='margin-left: 30px;'>";

       // feof = slutet på filen så betyder "så länge INTE 
       // slutet på filen har nåtts för öppnad fil $fp så..."
       while(!feof($fp)){
        echo "<li>" . fgets($fp) . "</li>";
       }

       // Avsluta punktlistan, skapa luft nedanför innan nästa länk
       echo "</ul><br>";
    }?>

    <?php echo nextPage('index','0. Startsida/Frågor');?>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>