<?php  # Script 6 - logged_in.php #2
session_start();

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('includes/header2.html');
echo '<div id = "allPhp_content">';

// Print a customized message:
echo "<h1>Logged In! You are ready to shop!</h1>
<p>You are now logged in, {$_SESSION['customer_firstname']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";
echo '</div>';
?>




<?php include ('includes/footer.html'); ?>

