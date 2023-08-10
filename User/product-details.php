<?php
include 'includes/header.php';
$id = $_REQUEST['id'];
$query = "SELECT * FROM product WHERE PID='" . $id . "'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);

//Do not delete cookies below
setcookie("amp_6e403e", "", time() - 3600, "/");
ob_start();

function formatDescription($description)
{
    return nl2br($description);
}

function getAvailabilityText($quantity)
{
    if ($quantity == 0) {
        return "<p class='text-danger'>Out of stock</p>";
    } elseif ($quantity <= 10) {
        return '<p class="text-danger">Limited stock</p>';
    } else {
        return "<p class='text-success'>Available</p>";
    }
}

function cookieCheck($productId)
{
    $arrRec = [];
    if (isset($_COOKIE['recently_viewed']) && !empty($_COOKIE['recently_viewed'])) {
        $arrRec = unserialize($_COOKIE['recently_viewed']);

        // Add an additional check to ensure that $arrRec is always an array
        if (!is_array($arrRec)) {
            $arrRec = [];
        }
    }
    if (!in_array($productId, $arrRec)) {
        $arrRec[] = $productId;
    } else {
        $key = array_search($productId, $arrRec);
        $before = array_slice($arrRec, 0, $key);
        $after = array_slice($arrRec, $key + 1);
        $newArr = array_merge(array($productId), $before, $after);
        $arrRec = $newArr;
    }
    setCookie('recently_viewed', serialize($arrRec), time() + 60 * 60);
    print_r($arrRec);

}

$productId = $row['PID'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<style>


</style>

<body>
    <section>
        <?php
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
        }
        $ret = mysqli_query($conn, "select * from product where PID='$id'");
        $row = mysqli_fetch_array($ret);

        ?>
        <div class="container mt-3">
            <div class='row'>
                <div class="col-md-4 ">
                    <a data-lightbox="image-1" data-title="<?php echo htmlentities($row['Name']); ?>"
                        href="../Admin/<?php echo htmlentities($row['Image']); ?>">
                        <img class="img-responsive" alt="" src="../Admin/<?php echo htmlentities($row['Image']); ?>"
                            width="370" height="350" />
                    </a>
                </div>

                <div class="col-md-8">
                    <h1 class="fw-bold">
                        <?php echo htmlentities($row['Name']); ?>
                    </h1>
                    <hr>
                    <p class="description">
                        <?php echo htmlentities($row['Description']); ?>
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="stock-box">
                                <span class="label">Product Brand :</span>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="stock-box">
                                <?php
                                $arr = explode(' ', trim(htmlentities($row['Name'])));
                                ?>
                                <span class="value">
                                    <?php echo $arr[0]; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="stock-box">
                                <span class="label">Shipping Charge :</span>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="stock-box">
                                <span class="value">
                                    <?php echo 'Rs. 100'; ?>
                                </span>
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="price-box">
                                <span class="price">Rs.
                                    <?php echo htmlentities($row['Price']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="quantity-container info-container">
                        <div class="row">

                            <div class="col-sm-2">
                                <span class="label">Quantity :</span>
                            </div>

                            <div class="col-sm-2">
                                <div class="quant-input">
                                    <input type="number" id="quantityInput" value="1" min="1">
                                </div>
                                <!--quant-input-->
                            </div>
                            <!--col-sm-2-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button
                                    onclick="addToCart('<?php echo htmlspecialchars($row["PID"], ENT_QUOTES); ?>','<?php echo htmlspecialchars($row["Name"], ENT_QUOTES); ?>','<?php echo htmlspecialchars($row["Price"], ENT_QUOTES); ?>')"
                                    class="add">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!--  row -->
            </div>

    </section><!-- /.section -->
</body>
<?php
cookieCheck($productId);
include 'includes/footer.php';
ob_end_flush();
?>
<script>

    function addToCart(productId, productName, productPrice) {
        const quant = parseInt(document.getElementById('quantityInput').value);
        prod = parseInt(productId);
        price = parseInt(productPrice);// Sanitize the input to prevent SQL injection

        console.log(quant);
        // Create a JSON object representing the product details
        var productDetails = {
            id: prod,
            name: productName,
            price: price,
            quantity: quant
        };
        // Convert the JSON object to a string
        var productDetailsString = JSON.stringify(productDetails);

        // Store the product details in a cookie
        document.cookie = "cartData=" + encodeURIComponent(productDetailsString) + "; path=/";
        // Show a confirmation message (optional)
        alert('Product has been added to the cart');
    }
</script>

</html>