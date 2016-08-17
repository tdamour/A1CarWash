<?php # Script 4 - register.php
// This is the registration page for this site.
require ('includes/config.inc.php');
$page_title = 'Register';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

// Need the database connection:
require ('includes/mysqli_connect.php');

// Trim all the incoming data:
$trimmed = array_map('trim', $_POST);

// Assume invalid values:
$fn = $ln = $e = $p = FALSE;

// Check for a first name:
if (preg_match ('/^[A-Z \'.-]{2,20}$/i',
$trimmed['first_name'])) {
$fn = mysqli_real_escape_string
($dbc, $trimmed['first_name']);
} else {
echo '<p class="error">Please enter
your first name!</p>';
}

// Check for last name:
if (preg_match ('/^[A-Z \'.-]{2,40}$/i',
$trimmed['last_name'])) {
$ln = mysqli_real_escape_string
($dbc, $trimmed['last_name']);
} else {
echo '<p class="error">Please enter
your last name!</p>';
}

// Check for an email address:
if (filter_var($trimmed['email'],
FILTER_VALIDATE_EMAIL)) {
$e = mysqli_real_escape_string
($dbc, $trimmed['email']);
} else {
echo '<p class="error">Please enter
a valid email address!</p>';
}

// Check for a password and match it against the confirmed password:
if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
if ($trimmed['password1'] == $trimmed['password2']) {
$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
} else {
echo '<p class="error">Your password did not match the confirmed password!</p>';
}
} else {
echo '<p class="error">Please enter a valid password!</p>';
}

if ($fn && $ln && $e && $p) { // If everything is OK...

// Make sure the email address is available
$q = "SELECT customer_id FROM customers WHERE customer_email='$e'";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .
mysqli_error($dbc));

if (mysqli_num_rows($r) == 0) { // Available.


// Add the user to the database:
$q = "INSERT INTO customers (customer_email, customer_pass, customer_firstname, customer_lastname, customer_type)
VALUES ('$e', SHA1('$p'), '$fn', '$ln', 'customer' )";
$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " .
mysqli_error($dbc));

if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

// Use header function to send to log in page
header ('Location: ' . BASE_URL . '/login.php');
exit(); // Stop the page.

} else { // If it did not run OK.

echo '<p class="error">You could not be registered due to a system error. We
apologize for any inconvenience.</p>';
}
}  else { // The email address is not available
echo '<p class="error">That email address has already been registered. If you have
forgotten your password, use the link below to have your password sent to you.
</p>';
}

} else {
echo '<p class="error">Please try again.</p>';
}

mysqli_close($dbc);

} // End of main Submit conditional
?>
<div id = "allPhp_content">
<h1>Register</h1>
<form action="register.php" method="post">
<fieldset>

<p><b>First Name:</b> <input type="text" name="first_name" size="20" maxlength="20"
value="<?php if (isset($trimmed['customer_firstname'])) echo $trimmed['customer_firstname']; ?>" /></p>

<p><b>Last Name:</b> <input type="text" name="last_name" size="20" maxlength="40" value="<?php
if (isset($trimmed['customer_lastname'])) echo $trimmed['customer_lastname']; ?>" /></p>

<p><b>Email Address:</b> <input type="text" name="email" size="30" maxlength="60" value="<?php
if (isset($trimmed['customer_email'])) echo $trimmed['customer_email']; ?>" /> </p>

<p><b>Password:</b> <input type="password" name="password1" size="20" maxlength="20"
value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" /> <small>Use
only letters, numbers, and the underscore. Must be between 4 and 20 characters long.
</small></p>

<p><b>Confirm Password:</b> <input type="password" name="password2" size="20" maxlength="20"
value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" /></p>

<input type="checkbox" name="mail_list" value="Yes" id='checkbox'>Check if you wish to
be added to our <b>Mailing List</b>.</input>
</fieldset>

<div align="center"><input type="submit" name="submit" value="Register" /></div>

</form>
</div>



<?php include ('includes/footer.html'); ?>

