<?php # Script 12 - checkout.php
// This page inserts the order information into the table.
// This page would come after the
// This page assumes that the billing process worked (the money has been taken).
include ('includes/config.inc.php');
require ('includes/login_functions.inc.php');

if(!isset($_SESSION['cart'])){
	redirect_user('view_cart.php'); 
}

if (!isset($_SESSION['customer_id'])) {

redirect_user('login.php');

}
// Set the page title and include the HTML header:
$page_title = 'Order Confirmation';
include ('includes/header2.html');

echo '<div id = "allPhp_content">';

// Assume that the customer is logged in and that this page has access to the customer's ID:

$cid = $_SESSION['customer_id'];

// Assume that this page receives the order total:
$total = 178.93; // Temporary.

// Or perhaps we could go back to what we used in view_cart file
$total = 0; // Total cost of the order.
// Calculate the total and sub-totals.
foreach(array_keys($_SESSION['cart']) as $row){
$subtotal = $_SESSION['cart'][$row]['quantity'] * $_SESSION['cart'][$row]['price'];
$total += $subtotal;
}

require ('includes/mysqli_connect.php'); //Connect to the database.

// Turn autocommit off:
mysqli_autocommit($dbc, FALSE);

// Add the order to the orders table...
$q = "INSERT INTO orders (customer_id, order_totalprice) VALUES ($cid, $total)";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {

// Need the order ID:
$oid = mysqli_insert_id($dbc);

// Insert the specific order contents into the database...

// Prepare the query:
$q = "INSERT INTO orderitem
(order_id, product_id, orderitem_quantityordered, orderitem_priceperunit)
VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($dbc, $q);
mysqli_stmt_bind_param($stmt, 'iiid',
$oid, $pid, $qty, $price);

// Execute the query; count the total affected:
$affected = 0;
foreach ($_SESSION['cart'] as $pid
=> $item) {
$qty = $item['quantity'];
$price = $item['price'];
mysqli_stmt_execute($stmt);
$affected += mysqli_stmt_affected_rows($stmt);
}

// Close this prepared statement
mysqli_stmt_close($stmt);

// Report on the success
if ($affected == count($_SESSION['cart'])) { // Good

// Commit the transaction
mysqli_commit($dbc);

// Clear the cart
unset($_SESSION['cart']);

echo "<h1>Checkout Complete!</h1>
<p>You are logged in, {$_SESSION['customer_firstname']}!</p>
<p><a href=\"logout.php\">Logout</a></p>
<p>\n</p>";

// Message to customer
echo '<p>Thank you for your
order. You will be notified
when the items ship.</p>';

} else { // Report problems

mysqli_rollback($dbc);

echo '<p>Your order could
not be processed due to a
system error. You will be
contacted in order to have
the problem fixed. We
apologize for the
inconvenience.</p>';
}

} else {

mysqli_rollback($dbc);

echo '<p>Your order could
not be processed due to a
system error. You will be
contacted in order to have
the problem fixed. We
apologize for the
inconvenience.</p>';
}

mysqli_close($dbc);
echo '</div>';

include ('includes/footer.html');
?>
