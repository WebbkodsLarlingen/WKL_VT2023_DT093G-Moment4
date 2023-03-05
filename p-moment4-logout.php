<?php
// Start session to find logged in user 
session_start();

// Log out user only if they clicked on log out button
if(isset($_POST['loginOut']) && isset($_SESSION['username'])){
    // and unset session for Username which keeps user logged in
    unset($_SESSION['username']);
    // Then destroy entire session
    session_destroy();
    // Start new session and store session loggedOut so logged
    // out message can be shown on login page after logging out
    session_start();
    $_SESSION['loggedOut'] = 1;
    // Redirect to login page
    header("Location: p-moment4-login.php");
}
// User did not click log out but is logged in
if(!isset($_POST['loginOut']) && isset($_SESSION['username'])){
    $_SESSION['logOutWithoutBtn'] = 1;

    // Set session to show error message on admin page
    header("Location: p-moment4.php");
}
// User did not click log out and is not logged in
if(!isset($_POST['loginOut']) && !isset($_SESSION['username'])){
    header("Location: p-moment4.php");
    // Set session to show error message on login page
    $_SESSION['wrongLogout'] = 1;
}
 ?>