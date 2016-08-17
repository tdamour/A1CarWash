<?php # Script 3 - login_functions.inc.php
// This page defines two functions used by the login/logout process.

/* This function determines an absolute
URL and redirects the user there.
* The function takes one argument: the page to be redirected to.
* The argument defaults to index.php.
*/

function redirect_user ($page = 'index.html') {

$url =  BASE_URL . '/' . $page;

// Redirect the user:
header("Location: $url");
exit(); // Quit the script.

}

function redirect_user2 ($page = 'login.php') {

$url =  BASE_URL . '/' . $page;

// Redirect the user:
header("Location: $url");
exit(); // Quit the script.

}

function check_login($dbc, $email = '',
$pass = '') {

$errors = array( ); // Initialize error array.

// Validate the email address:
if (empty($email)) {
$errors[] = 'You forgot to enter your email address.';
} else {
$e = mysqli_real_escape_string($dbc, trim($email));
}

// Validate the password:
if (empty($pass)) {
$errors[] = 'You forgot to enter your password.';
} else {
$p = mysqli_real_escape_string($dbc, trim($pass));
}

if (empty($errors)) { // If everything's OK

// Retrieve the user_id and first_name for that
// email/password combination:
$q = "SELECT user_id, first_name
FROM users WHERE email='$e' AND
pass=SHA1('$p')";
$r = @mysqli_query ($dbc, $q);
// Run the query.

// Check the result:
if (mysqli_num_rows($r) == 1) {

// Fetch the record:
$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

// Return true and the record:
return array(true, $row);

} else { // Not a match!
$errors[] = 'The email address
and password entered do not
match those on file.';
}

} // End of empty($errors) IF.

// Return false and the errors:
return array(false, $errors);

} // End of check_login( ) function.
