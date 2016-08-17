<?php # Script 5 - login.php
// This is the login for this site

$page_title = 'Login';

include ('includes/header.html');
require ('includes/config.inc.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
require ('includes/mysqli_connect.php');

// Validate the email address:
if (!empty($_POST['customer_email'])) {
$e = mysqli_real_escape_string
($dbc, $_POST['customer_email']);
} else {
$e = FALSE;
echo '<p class="error">You forgot
to enter your email address!</p >';
}

// Validate the password:
if (!empty($_POST['customer_pass'])) {
$p = mysqli_real_escape_string
($dbc, $_POST['customer_pass']);
} else {
$p = FALSE;
echo '<p class="error">You forgot
to enter your password!</p>';
}

if ($e && $p) { // If everything's Ok.

// Query the database:
$q = "SELECT customer_id, customer_firstname,
customer_type FROM customers WHERE
(customer_email='$e' AND customer_pass=SHA1('$p')) AND
customer_type='customer'";
$r = mysqli_query ($dbc, $q)
or trigger_error("Query: $q\
n<br />MySQL Error: " .
mysqli_error($dbc));

if (@mysqli_num_rows($r) == 1) {
// A match was made.

// Register the values:
$_SESSION = mysqli_fetch_array
($r, MYSQLI_ASSOC);
mysqli_free_result($r);
mysqli_close($dbc);

// Redirect the user:
$url = BASE_URL . 'logged_in.php';
// Define the URL.
ob_end_clean( ); // Delete the buffer.
header("Location: $url");
exit( ); // Quit the script.

} else { // No match was made.
echo '<p class="error">Either
the email address and password
entered do not match those
on file or you have not yet
activated your account.</p>';
}

} else { // If everything wasn't OK.
echo '<p class="error">Please try
again.</p>';
}

mysqli_close($dbc);

} // End of SUBMIT conditional.
?>
<div id = "allPhp_content">
<div id = "login_header">
<h1>Login</h1>
<p>Your browser must allow cookies in
order to log in.</p>
</div>
<form action="login.php" method="post">
<fieldset>
<p><b>Email Address:</b> <input
type="text" name="customer_email" size="20"
maxlength="60" /></p>
<p><b>Password:</b> <input
type="password" name="customer_pass" size="20"
maxlength="20" /></p>
</fieldset>

<div align="center"><input
type="submit" name="submit"
value="Login" /></div>

</form>
</div>

<?php include ('includes/footer.html');