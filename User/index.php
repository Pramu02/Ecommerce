<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Shopping Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>
<style>
    /* Styles for the carousel container */
    .carousel-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;

        overflow: hidden;
    }

    /* Center the images in the carousel */
    .carousel-item img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        height: 60%;
    }

    /* Styles for the carousel item info (name and description) */
    .carousel-item-info {
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 10px;
        position: absolute;
        top: 0;
        right: 0;
        max-width: 50%;
        /* Adjust the width as needed */
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .carousel-item-info h4 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .carousel-item-info p {
        font-size: 14px;
        margin-bottom: 0;
    }

    /* Carousel control buttons */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        color: #000;
        border: none;
        padding: 5px;
        font-size: 24px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>

<body>

    <?php

    if (isset($_COOKIE['recently_viewed'])) {
        $arrRecentView = unserialize($_COOKIE['recently_viewed']);

        // print_r($arrRecentView);
        // Count the number of recently viewed items
        $countRecentView = count($arrRecentView);

        // If there are more than 4 recently viewed items, slice the array to only keep the last 4 items
    
        $arrRecentView = array_slice($arrRecentView, 0, 4);

        // Create a comma-separated string of the recently viewed item IDs
        $recentViewId = array_reverse($arrRecentView);
        $recentViewId = implode(",", $arrRecentView);

        // Fetch the product details for the recently viewed items from the database
        // ORDER BY FIELD(id, $recentViewId):
        // This part specifies the order in which the selected rows should be sorted.
        // It uses the "FIELD" function to sort the rows based on the order of the ids in
        // the "$recentViewId" variable.
    
        $res = mysqli_query($conn, "SELECT * FROM product WHERE PID IN ($recentViewId)
            ORDER BY FIELD(PID, $recentViewId)");

        // print_r($recentViewId);
    
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <div class="carousel-container">
                <div id="carouselExampleFade" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Carousel items with images and descriptions -->
                        <?php
                        $active = true;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $imageSrc = "../Admin/" . $row["Image"];
                            ?>
                            <div class="carousel-item <?php echo $active ? 'active' : ''; ?>" data-bs-interval="5000">
                                <div class="item-content">
                                    <a href="product-details.php?id=<?php echo htmlentities($row['PID']); ?>">
                                        <img src="<?php echo $imageSrc; ?>" alt="" id="imagedisp">
                                    </a>
                                    <div class="carousel-item-info">
                                        <h4>
                                            <?php echo $row["Name"]; ?>
                                        </h4>
                                        <p>
                                            <?php echo $row["Description"]; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $active = false;
                        }
                        ?>
                        <!-- Add more carousel items here if needed -->
                    </div>
                    <!-- Carousel controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <?php
        }
        ?>
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
            $res = mysqli_query($conn, "SELECT * FROM product WHERE PID IN ($recentViewId)
            ORDER BY FIELD(PID, $recentViewId)");
            while ($row = mysqli_fetch_assoc($res)) {
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
                    <button
                        onclick="addToCart('<?php echo htmlspecialchars($row["PID"], ENT_QUOTES); ?>','<?php echo htmlspecialchars($row["Name"], ENT_QUOTES); ?>','<?php echo htmlspecialchars($row["Price"], ENT_QUOTES); ?>')"
                        class="add">
                        Add to Cart
                    </button>

                </div>
                <?php
            }

    } else {
        $arrRandom = [2, 16, 4, 8];
        $recentViewId = implode(",", $arrRandom);

        $resRandom = mysqli_query($conn, "SELECT * FROM product WHERE PID IN ($recentViewId)
            ORDER BY FIELD(PID, $recentViewId)");

        while ($row = mysqli_fetch_assoc($resRandom)) {
            ?>
                <div class="carousel-container">
                    <div id="carouselExampleFade" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Carousel items with images and descriptions -->
                            <?php
                            $active = true;
                            while ($row = mysqli_fetch_assoc($resRandom)) {
                                $imageSrc = "../Admin/" . $row["Image"];
                                ?>
                                <div class="carousel-item <?php echo $active ? 'active' : ''; ?>" data-bs-interval="5000">
                                    <div class="item-content">
                                        <a href="product-details.php?id=<?php echo htmlentities($row['PID']); ?>">
                                            <img src="<?php echo $imageSrc; ?>" alt="" id="imagedisp">
                                        </a>
                                        <div class="carousel-item-info">
                                            <h4>
                                                <?php echo $row["Name"]; ?>
                                            </h4>
                                            <p>
                                                <?php echo $row["Description"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $active = false;
                            }
                            ?>
                            <!-- Add more carousel items here if needed -->
                        </div>
                        <!-- Carousel controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <?php
        }
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