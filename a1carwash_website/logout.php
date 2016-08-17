<?php # Script 7 - logout.php
// This is the logout page for the site.
require ('includes/config.inc.php');
$page_title = 'Logout';
include ('includes/header.html');
echo '<div id = "allPhp_content">';

//session_start(); // Start the session.

// If no session value is present, redirect the user:
if (!isset($_SESSION['customer_id'])) {

// Need the functions:
require ('includes/login_functions.inc.php');
redirect_user();



} else { // Log out the user.

$_SESSION = array( ); // Destroy the variables.
session_destroy( ); // Destroy the session itself.
setcookie (session_name( ), '',
time( )-3600); // Destroy the cookie.

}

// Print a customized message:
echo "<h1>You are now logged out.</h1>
<p>You are now logged out!</p>";

echo '</div>';

include ('includes/footer.html');
?>