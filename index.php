<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=0;
    ?>
<title><?= pageTitle("Startsida"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<?php include("p-questions.php");?>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>