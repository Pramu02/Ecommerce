<?php
include 'includes/header.php';
session_start();

// Function to add product to the cart (you can implement other cart operations as well)
function addToCart($productDetails)
{
    // Check if the cart exists in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add the product details to the cart
    $_SESSION['cart'][] = $productDetails;
}

// Check if the cookie exists and has cart data
if (isset($_COOKIE['cartData'])) {
    $cartData = json_decode($_COOKIE['cartData'], true); // Decode the JSON string to an associative array
    addToCart($cartData);
}

// Function to calculate the total cart price
function calculateTotalPrice()
{
    $totalPrice = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $totalPrice += $product['price'];
        }
    }
    return $totalPrice;
}
?>

<!-- Your cart display section -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
</head>

<body>
    <h1>Shopping Cart</h1>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $product) { ?>
                <tr>
                    <td>
                        <?php echo $product['name']; ?>
                    </td>
                    <td>
                        <?php echo $product['price']; ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><strong>Total</strong></td>
                <td>
                    <?php echo calculateTotalPrice(); ?>
                </td>
            </tr>
        </table>
        <a href="checkout.php">Proceed to Checkout</a>
    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>
</body>

</html>

<?php include 'includes/footer.php'; ?>