<!--<div id = "allPhp_content">-->
<?php # Script 8 - browse_products.php
// This page displays the available products.

// Set the page title and include the HTML header:
$page_title = 'Browse Products';
include ('includes/header2.html');
//include ('includes/config_inc.php');

session_start();


require ('includes/mysqli_connect.php');

// Query
$q = "Select product_id, product_name, product_availablequantity,
 CONCAT('$', product_price) As price From products Order By product_id";
echo '<div id = "allPhp_content">';
echo "<h1>Only The Finest Premium Products</h1>";


// Create the table head:
echo '<table border="20%" width="90%" cellspacing="3" cellpadding="3" align="center">
<tr>
<td align="left" width="20%"><b>Product Number</b></td>
<td align="left" width="20%"><b>Product Name</b></td>
<td align="left" width="40%"><b>Availability</b></td>
<td align="left" width="60"><b>Price</b></td>
</tr>';

// Display all the products, linked to URLs:
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

// Display each record:
echo "\t<tr>
<td align=\"left\">{$row['product_id']}</td>
<td align=\"left\"><a href=\"view_products.php?pid={$row['product_id']}\">{$row['product_name']}</a></td>
<td align=\"left\">{$row['product_availablequantity']}</td>
<td align=\"left\">{$row['price']}</td>
</tr>\n";

}

echo '</table>';
echo '</div>';
mysqli_close($dbc);

include ('includes/footer.html');

?>
<!--</div>-->

<!--<div id = "allPhp_content">
<form action="browse_products.php" method="post">
	
</form>
</div>-->
	

