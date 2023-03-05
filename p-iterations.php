<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=3;
    ?>
<title><?= pageTitle("3. Upprepningar"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 2 - 3. Upprepningar</h2>
<div class="uppgifts-div" id="special1">
    <h3>Del 1</h3>
    <p style='text-align: center;'>
    <?php 
    for($i = 10; $i>0; $i--){
        echo $i . '<br>';
    }
    ?>
    </p><br>

    <h3>Del 2</h3>
    <p style="margin-bottom: 10px; text-align: center;">Kurslistan i den ordning kurserna ges:</p>
    <?php
    $arrCourses = array(
        "Webbutveckling I","Introduktion till programmering med JavaScript",
        "Grafisk teknik för webb för webb","Webbanvändbarhet","Webbutveckling II","Databaser",
        "Webbdesign för CMS","Webbutveckling III"
    );
    
    // Skriv ut
    echo '<ul class="courseList">';
    foreach($arrCourses as $arrCourse){
        echo "<li>$arrCourse</li>";
    }
    echo '</ul>';
    ?><br>

    <h3>Del 3</h3>
    <p style="margin-bottom: 10px; text-align: center;">Kurslistan i bokstavsordning:</p>
    <?php
    // Sortera och skriv ut
    sort($arrCourses);
    echo '<ul class="courseList">';
    foreach($arrCourses as $arrCourse){
        echo "<li>$arrCourse</li>";
    }
    echo '</ul>';
    ?><br>

    <?php echo nextPage('p-forms','4. Formulär');?>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>