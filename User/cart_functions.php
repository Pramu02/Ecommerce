<?php
// Handle delete action
if (isset($_GET['delete_product'])) {
    deleteFromCart(intval($_GET['delete_product']));
}

if (isset($_GET['id']) && isset($_GET['qty'])) {
    $idItem = intval($_GET['id']);
    $idQty = intval($_GET['qty']);
    // echo $idItem;
    // echo $idQty;
    // print_r($_SESSION['cart'][$idItem]);
    $_SESSION['cart'][$idItem]['quantity'] = $idQty;
}

// Function to add product to the cart (you can implement other cart operations as well)
function addToCart($productDetails)
{
    // Check if the cart exists in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product already exists in the cart
    foreach ($_SESSION['cart'] as $productId => &$cartItem) {
        if ($productId === $productDetails['id']) {
            // If the product exists, update the quantity
            $cartItem['quantity'] += $productDetails['quantity'];
            return; // Exit the function
        }
    }

    // If the product is not found in the cart, add it
    $_SESSION['cart'][$productDetails['id']] = $productDetails;
}

function deleteFromCart($productId)
{
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        header('location: cart.php');
    }
}

// Check if the cookie exists and has cart data
if (isset($_COOKIE['cartData'])) {
    $cartData = json_decode($_COOKIE['cartData'], true); // Decode the JSON string to an associative array
    addToCart($cartData);

    // Remove the cartData cookie after it's been processed
    setcookie('cartData', '', time() - 3600, "/");
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



// Function to render the cart table
function renderCartTable()
{
    global $conn;
    $i = 1;
    ?>
    <table class="table table-hover">
        <caption></caption>
        <thead>
            <tr>
                <th class="text-center">S.N.</th>
                <th class="text-center">Product Image</th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Total Price</th>
                <th scope='col'>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $productId => $cartItem) {
                $id = $cartItem['id'];
                $ret = mysqli_query($conn, "select * from `product` where PID='$id'");
                $row = mysqli_fetch_array($ret);
                ?>
                <tr>
                    <td>
                        <center>
                            <?php echo $i++ ?>
                        </center>
                    </td>
                    <td>
                        <center><img id="imageDesign" src="../Admin/<?php echo $row['Image']; ?>" alt="#"></center>
                    </td>
                    <td>
                        <center>
                            <?php echo $cartItem['name']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $cartItem['price']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <div class="form-outline">
                                <input type="number" class="form-control" value="<?php echo $cartItem['quantity']; ?>"
                                    name="quantity_<?php echo $productId; ?>" style="text-align:center;" min=1>
                            </div>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $cartItem['price'] * $cartItem['quantity']; ?>
                        </center>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item"
                                        onclick="update_product(<?php echo intval($productId); ?>, <?php echo $productId; ?>)">
                                        Update
                                    </button>
                                </li>
                                <li><a class="dropdown-item" href="?delete_product=<?php echo $productId; ?>">Delete</a></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            <?php } ?>
            <tr>
                <td><strong>Total</strong></td>
                <td colspan="4"></td>
                <td>
                    <center>
                        <?php echo calculateTotalPrice(); ?>
                    </center>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php
}
?>