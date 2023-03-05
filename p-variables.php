<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=1;
    ?>
<title><?= pageTitle("1. Variabler"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 2 - 1. Variabler</h2>
<div class="uppgifts-div" id="special1">
    <h3>Enskilda</h3>
    <?php 
    // Skapar variabler
    $name = "WebbKodsLärlingen";
    $age = "34";
    $email = "Sheeshuz@student.miun.se";
    
    echo "<ul class='variabel-ul'><li>$name</li><li>$age</li><li>$email</li></ul><br>";
    ?>
    <h3>Kombinerade</h3>
    <?php
    echo "<p class='variabelP'>Hej! Jag heter $name" 
    . ", är " . $age . " år gammal och nås på följande e-post: " 
    . "<a href='mailto:$email'>$email</a>.</p><br>";
    echo nextPage('p-conditions','2. Villkor');
    ?>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>