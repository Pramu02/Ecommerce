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

    // Check if the product already exists in the cart
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] === $productDetails['id']) {
            // If the product exists, update the quantity
            $cartItem['quantity'] += $productDetails['quantity'];
            return; // Exit the function
        }
    }

    // If the product is not found in the cart, add it
    $_SESSION['cart'][] = $productDetails;
}

// Check if the cookie exists and has cart data
if (isset($_COOKIE['cartData'])) {
    $cartData = json_decode($_COOKIE['cartData'], true); // Decode the JSON string to an associative array
    addToCart($cartData);

    // Remove the cartData cookie after it's been processed
    setcookie('cartData', '', time() - 3600, '/');
}


// Function to calculate the total cart price
function calculateTotalPrice()
{
    $totalPrice = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    div.container-fluid table img {
        width: 13vw;
        height: 30vh;
        margin: auto;
    }
</style>

<body>
    <h1>Shopping Cart</h1>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="card col-md-12 mt-3">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">S.N.</th>
                                    <th class="text-center">Product Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total Price</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                foreach ($_SESSION['cart'] as $product) {
                                    $id = $product['id'];
                                    $ret = mysqli_query($conn, "select * from product where PID='$id'");
                                    $row = mysqli_fetch_array($ret);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++ ?>
                                        </td>
                                        <td>
                                            <center><img src="../Admin/<?php echo $row['Image'] ?>" alt=""></center>
                                        </td>
                                        <td>
                                            <?php echo $product['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['quantity']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['price'] * $product['quantity']; ?>
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

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include 'includes/footer.php'; ?>