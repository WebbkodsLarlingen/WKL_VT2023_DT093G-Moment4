<?php include("include/config.php");?>
    <?php 
    // Markera nuvarande sida med Box-shadow under dess Menyknapp (se c-nav.php)
    $currentBtn=6;

     // Initierar klass "Todo" (se även tillagd autoinkludering i config.php) och dess konstruktör med:
     // 1 textsträng "todolist.json", alltså filnamnet för JSON-filen ifråga
     $letsTodo = new Todo('todolist.json');
        
    ?>
<title><?= pageTitle("Startsida"); ?></title>
<?php include("include/c-header.php");?>
<?php include("include/c-nav.php");?>

<h2 id="specialh2">Moment 3 - Att göra lista med PHP</h2>
<div class="uppgifts-div" id="special1">
    <h3>En "Att göra"-lista med objektorienterad PHP</h3>

    <form id="form3" action="p-moment3.php" method="POST">
        <label for="todoInput">Ange och lägg till ny sak att göra:</label>
        <input id="todoInput" type="text" name="todoItem" style="padding-left: 10px; font-weight:bold;"placeholder="Sak att göra...">

        <?php 
         
        // PHP-KOD som körs mellan inmatningsfält och "Lägg till"-knappen
            // Klickat på "Lägg till" ?
            if(isset($_POST['addTodo'])){

                // Är det sant att minst 5 tecken har matats in?
                if($letsTodo->setTodo($_POST['todoItem'])){

                    // Lagra då "Att göra"-strängen med hjälp av klassmetod addTodo i klassen
                    $letsTodo->addTodo($_POST['todoItem']);
                }
                // Om färre än 5 tecken, skriv ut felmeddelande
                else{
                    echo "<p id='todoErrorMsg'>Du måste ange minst fem tecken för att lägga till i listan nedan.</p>";
                }
            }
        
        ?>
        
        <div id="todoButtons">
        <input type="submit" name="addTodo" value="Lägg till" id="todoBtn">
        <input type="submit" name="clearTodos" value="Rensa" id="clearBtn">
        </div>
    </form>

    <div class="todoList">
        <h3>Saker att göra</h3>
        <?php
        // PHP-KOD som körs nedanför inmatningsfältet och knapparna, här visas "Saker att göra"-listan
        $key_plus_one = 0; // Används för att numrera aktiviteterna innan de skrivs ut

        // Kontrollera om "Rensa" klickats på och anropa då klassmetod som tömmer hela arrayen innan den skrivs ut
        if(isset($_POST['clearTodos'])){
            $letsTodo->clearTodos();
            $key_plus_one = 0; // Allt togs bort så nollställ index
        }
        // Kontrollera om någon "Klar" klickats på
        if(isset($_POST['delete'])){
            // Skicka med arrayIndex (omvandlat till heltal) för 
            // vald aktivitet & ta bort med removeTodo()-klassmetoden
            $letsTodo->removeTodo(intval($_POST['delete']));
            $key_plus_one = 0; // Något togs bort så nollställ index
        }
        // Här skrivs Att göra-listan ut och klickad "Klar" via GET tas bort.        
        // Anropa getTodos() som returnar en array från JSON-filen
        // DETTA ÄR DET SISTA SOM SKA SKE PÅ SIDAN EFTERSOM DEN SKRIVER UT DET SLUTGILTIGA SOM FINNS!
        $Alltodos = $letsTodo->getTodos();
        if(!$Alltodos){
            echo "<p style='text-align:center; margin-bottom:10px;'>Lägg till en sak att göra först så hamnar den här...</p>";
        }

            // Skriv ut alla "Saker att göra" från erhållna arrayen
            foreach ($Alltodos as $key=>$todo){
                    $key_plus_one += 1;
                
                // Med hjälp av $key så kan varje Klar-knapp tilldelas unikt ID när 'POST'-metoden används
                // som då också är säkrare än 'GET'. 
                echo "<div class='todo-line'>$key_plus_one. " .  htmlspecialchars($todo) . " <form action='p-moment3.php' method='POST'>
                <input type='hidden' value=$key name=delete><button class='deleteButtons'>Klar</button></form></div>";
            }
        ?>
        <a class="backA" style="display: block; text-align: center;" href="todolist.json">Länk till JSON-fil</a>
    </div>
</div>
<?php include("include/secret.php")?>
<?php include("include/c-footer.php");?>