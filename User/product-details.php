<?php include 'includes/header.php'; ?>
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
                                    <input type="number" value="1" min="1">
                                    <!-- <div class="arrows">
                        <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                        <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                    </div> -->
                                </div>
                                <!--quant-input-->
                            </div>
                            <!--col-sm-2-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="button_cart"><a href="cart.php?id=<?php echo $row['PID']; ?>"><i
                                            class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a></button>
                            </div>
                        </div>
                    </div>
                </div><!--  row -->
            </div>

    </section><!-- /.section -->
</body>
<script>
    $(document).ready(function () {
        // Increase quantity
        $('.arrow.plus').click(function () {
            var inputField = $(this).parent().parent().siblings('input');
            var currentValue = parseInt(inputField.val());
            inputField.val(currentValue + 1);
        });

        // Decrease quantity
        $('.arrow.minus').click(function () {
            var inputField = $(this).parent().parent().siblings('input');
            var currentValue = parseInt(inputField.val());
            if (currentValue > 1) {
                inputField.val(currentValue - 1);
            }
        });
    });
</script>

</html>

<?php include 'includes/footer.php'; ?>