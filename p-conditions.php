<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=2;
    ?>
<title><?= pageTitle("Villkor"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 2 - 2. Villkor</h2>
<div class="uppgifts-div" id="special1">

    <h3>Datum/klockslag: ÅÅÅÅ-MM-DD:TT.MM</h3>
    <?php 
    $dateNow = date('Y-m-d') . ':' . date('H.i');

    echo "<p style='text-align: center;'>Datum/klockslag: $dateNow<br><br></p>";
    ?>

    <h3>Idag är det (inte) söndag</h3>
    <p style='text-align: center;'>Idag är det 
    <?php 
    $isSunday = date('D');
    echo $isSunday === 'Sun' ? ' söndag' : ' inte söndag';     
    ?>.<br><br></p>

    <h3>Det är morgon/förmiddag/eftermiddag eller kväll/natt</h3>
    <p style='text-align: center;'>Det är 
    <?php

    // Gammalt variabelnamn från JS-Intro-kursen - gammal favorit!
    $getHM = date('H:i');

    if($getHM >= '06:00' && $getHM <= '08:59'){
        echo 'morgon';
    }
    else if($getHM >= "09:00" && $getHM <= '11:59'){
        echo 'förmiddag';
    }
    else if($getHM >= '12:00' && $getHM <= '17:59'){
        echo 'eftermiddag';
    }
    else if($getHM >= '18:00' && $getHM <= '23:59' || ($getHM >= '00:00' && $getHM <= '05:59')){
        echo 'kväll/natt';
    }
    ?>.</p>
    <h3>Idag är det <i>Veckodag</i></h3>
    <p style='text-align: center;'>Idag är det  
    <?php 
    $weekDay = date('D');

    switch($weekDay){
        case 'Mon':
            echo 'måndag';
            break;
        case 'Tue':
             echo 'tisdag';
              break;
         case 'Wed':
          echo 'onsdag';
                break;
            case 'Thu':
                 echo 'torsdag';
                  break;
            case 'Fri':
                    echo 'fredag';
                     break;
                     case 'Sat':
                        echo 'lördag';
                         break;
                         case 'Sun':
                            echo 'söndag';
                             break;
    }?>.</p><br>
    <?php echo nextPage('p-iterations','3. Upprepningar');?>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>