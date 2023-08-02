<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Shopping Site</title>

</head>


<body>
    <div class="info-boxes wow fadeInUp">
        <div class="info-boxes-inner">
            <div class="row">
                <div class="col-md-6 col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="icon fa fa-dollar"></i>
                            </div>
                            <div class="col-xs-10">
                                <h4 class="info-box-heading green">money back</h4>
                            </div>
                        </div>
                        <h6 class="text">30 Day Money Back Guarantee.</h6>
                    </div>
                </div><!-- .col -->

                <div class="hidden-md col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="icon fa fa-truck"></i>
                            </div>
                            <div class="col-xs-10">
                                <h4 class="info-box-heading orange">free shipping</h4>
                            </div>
                        </div>
                        <h6 class="text">free ship-on order over Rs. 60000</h6>
                    </div>
                </div><!-- .col -->

                <div class="col-md-6 col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="icon fa fa-gift"></i>
                            </div>
                            <div class="col-xs-10">
                                <h4 class="info-box-heading red">Special Sale</h4>
                            </div>
                        </div>
                        <h6 class="text">All items-sale up to 10% off </h6>
                    </div>
                </div><!-- .col -->
            </div><!-- /.row -->
        </div><!-- /.info-boxes-inner -->

    </div><!-- /.info-boxes -->


    <main>


        <?php
        $sql = "SELECT * from product";
        $all_product = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($all_product)) {
            ?>
            <div class="card">
                <div class="image">
                    <a href="product-details.php?id=<?php echo htmlentities($row['PID']); ?>">
                        <img src="../Admin/<?php echo $row["Image"]; ?>" alt="" id="imagedisp">
                    </a>
                </div>
                <div class="caption">
                    <p class="product_name"><b>
                            <?php echo $row["Name"]; ?>
                        </b></p>
                    <p class="price"><b> RS.
                            <?php echo $row["Price"]; ?>
                        </b></p>
                </div>
                <!-- <button onclick="addToCart(<?php echo $row["PID"]; ?>)" class=" add"> Add to Cart</button> -->

                <button
                    onclick="addToCart('<?php echo htmlspecialchars($row["PID"], ENT_QUOTES); ?>','<?php echo htmlspecialchars($row["Name"], ENT_QUOTES); ?>','<?php echo htmlspecialchars($row["Price"], ENT_QUOTES); ?>')"
                    class="add">
                    Add to Cart
                </button>

            </div>
            <?php
        }
        ?>
    </main>


</body>

<script>

    function addToCart(productId, productName, productPrice) {

        prod = parseInt(productId);
        price = parseInt(productPrice);// Sanitize the input to prevent SQL injection

        console.log(price);
        // Create a JSON object representing the product details
        var productDetails = {
            id: prod,
            name: productName,
            price: price,
            quantity: 1
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

<?php include 'includes/footer.php';