<?php
include("include/config.php");

// PHP Code to "install" Blog locally
    // "Reset" tables by dropping them if they exist
    echo "<br>OM TABELL MISSLYCKAS INSTALLERAS:<br>---------------------------------------------
    <br>/!\- Skapa först en databas som heter moment4_maka2207 och kör skriptet igen!<br>
    <br>/!\- Se till att databasanslutningen är korrekt konfigurerad (se under \$devmode i config.php för mer):
    <br>****** \$devmode = true;
    <br>******  Host: localhost
    <br>****** Username: root
    <br>****** Database: moment4
    <br>****** Password: localhost<br><br><br>...RADERAR GAMLA OCH SKAPAR NYA TABELLER...<br><br>";

$sql = "USE moment4;"; // Select database
$sql .= "SET foreign_key_checks = 0;";  // Disable foreign key checks so tables can be deleted
$sql .= "DROP TABLE IF EXISTS blogposts;";   // Table for blog posts
$sql .= "DROP TABLE IF EXISTS users;";       // Table for users 

// Create the actual tables after "resetting" them
     // Users = to register, and login with
$sql .="CREATE TABLE users(
    username VARCHAR(21) PRIMARY KEY,
    email VARCHAR(128) NOT NULL UNIQUE,
    hashed_password VARCHAR(256) NOT NULL,
    account_activated INT (1) NOT NULL DEFAULT 0,
    registered_date timestamp NOT NULL DEFAULT current_timestamp);";

    // Blogposts = to post blog posts with users
$sql .= "CREATE TABLE blogposts(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    blogpost_title VARCHAR(64) NOT NULL,
    blogpost_text TEXT NOT NULL,
    blogpost_created timestamp NOT NULL DEFAULT current_timestamp,
    blogpost_created_by VARCHAR(21), FOREIGN KEY (blogpost_created_by) REFERENCES users(username));";
    // Enable foreign key checks again after created all tables
$sql .= "SET foreign_key_checks = 1;"; 

echo "<pre>$sql</pre>";

if($DB->mysqli->multi_query($sql)){
    echo "<br>TABELLEN LYCKADES INSTALLERAS!<br>MYCKET NÖJE! :-)<br>";
}else {echo "<br>Tabellerna misslyckades installeras!<br>Skapa först en databas som heter \"moment4\" och prova igen!";}

?>