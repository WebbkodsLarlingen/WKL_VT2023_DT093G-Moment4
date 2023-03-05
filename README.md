# INSTALLATION LOKALT - PHP + SQL

Den är inställd med devmode = true så det bara ska vara att skapa databasnamn och köra install.php-filen.

1. Ladda hem lokalt med GIT: https://github.com/WebbkodsLarlingen/WKL_VT2023_DT093G-Moment4.git
2. Skapa en ny databas i lokal SQL-DBMS som heter "moment4"
3. Kör install.php lokalt (ligger i samma rotkatalog som index.php)

# INSTALLATION ONLINE - PHP + SQL

1. Ändra devmode = false i "config.php"-filen (rad 158)
2. Konfigurera databasinställnignarna (ange rätt databasnamn eller skapa ny databas i din online DBMS) i "config-filen" (raderna 173-176)
3. Ladda upp filerna till webbserver som stödjer PHP + MySQL/MariaDB
4. Besök webbplatsen online och kör sedan install.php i adressfältet

# UML- & ER-DIAGRAM FÖR DATABASTEKNIKER

![UML Diagram för projektet](https://github.com/Webbutvecklings-programmet/moment4_vt23-WebbkodsLarlingen/blob/f3d053503d58e94e20af3f0dafd9bd4eef9be727/UML_ER_Diagram_Moment4_maka2207.png)

Mvh,
WKL.
