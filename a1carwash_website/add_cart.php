<?php # Script 10 - add_cart.php
// This page adds products to the shopping cart.
// Set the page title and include the HTML header:

$page_title = 'Add to Cart';
session_start();
include ('includes/header2.html');
//include ('includes/config_inc.php');

echo '<div id = "allPhp_content">';
if (isset ($_GET['pid']) && filter_var($_GET['pid'],
FILTER_VALIDATE_INT, array('min_range' => 1))		) { // Check for a product ID.

$pid = $_GET['pid'];

// Check if the cart already contains one of these products;
// If so, increment the quantity:
if (isset($_SESSION['cart'][$pid])) {


$_SESSION['cart'][$pid]
['quantity']++; // Add another

//Display a message
echo '<p>Another item
has been added to your
shopping cart.</p>';

} else { // New product to the cart.

// Get the products price from the database:
require ('includes/mysqli_connect.php');
// Connect to the database.
$q = "SELECT product_price FROM products
WHERE product_id=$pid";
$r = mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid print ID


// Fetch the information.
list($price) = mysqli_fetch_array ($r, MYSQLI_NUM);

// Add to the cart:
$_SESSION['cart'][$pid] = array
('quantity' => 1, 'price' => $price);

// Display a message:
echo '<p>The item has been
added to your shopping cart.</p>';

} else { // Not a valid product ID.
echo '<div align="center">This
page has been accessed in error!</div>';
}

mysqli_close($dbc);

} // End of isset($_SESSION['cart'] [$pid] conditional.

} else { // No product ID.
echo '<div align="center">This page has been accessed in error!</div>';
}
echo '</div>';
include ('includes/footer.html');
?>

