<?php
session_start();
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Order History</title>

    <script language="javascript" type="text/javascript">
        var popUpWin = 0;
        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }

    </script>

</head>

<body class="cnt-home">



    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <?php include('includes/header.php'); ?>
    </header>
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Shopping Cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row inner-bottom-sm">
                <div class="shopping-cart">
                    <div class="col-md-12 col-sm-12 shopping-cart-table ">
                        <div class="table-responsive">
                            <form name="cart" method="post">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th> Ordered Id </th>
                                            <th>Image</th>
                                            <th> Product Name</th>

                                            <th>Quantity</th>
                                            <th>Price Per unit</th>
                                            <th>Grandtotal</th>
                                            <th>Order Date</th>
                                            <th>Billing Address</th>
                                            <th>Shipping Address</th>


                                        </tr>
                                    </thead><!-- /thead -->

                                    <tbody>

                                        <?php

                                        $query = mysqli_query($conn, "
                                        SELECT 
                                            product.Image AS pimg1,
                                            product.Name AS pname,
                                            product.PID AS proid,
                                            ordered_product.PId AS opid,
                                            ordered_product.quantity AS qty,
                                            product.Price AS pprice,
                                            ordered_product.ordered_date AS odate,
                                            ordered_product.OID AS orderid,
                                            shipping.address AS sadd,
                                            billing.Address AS badd
                                        FROM 
                                            ordered_product
                                        JOIN 
                                            product ON ordered_product.PID = product.PID
                                        JOIN 
                                            shipping ON ordered_product.OID = shipping.OID
                                        JOIN 
                                            billing ON ordered_product.OID = billing.OID
                                        WHERE 
                                            ordered_product.OID = '" . $_SESSION['orderid'] . "'
                                    ");

                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $cnt; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['orderid']; ?>
                                                </td>
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail" href="detail.html">
                                                        <img src="../Admin/<?php echo $row['pimg1']; ?>" alt="" width="84"
                                                            height="146">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'><a
                                                            href="product-details.php?id=<?php echo $row['proid']; ?>">
                                                            <?php echo $row['pname']; ?></a></h4>


                                                </td>
                                                <td class="cart-product-quantity">
                                                    <?php echo $qty = $row['qty']; ?>
                                                </td>
                                                <td class="cart-product-sub-total">
                                                    <?php echo $price = $row['pprice']; ?>
                                                </td>

                                                <td class="cart-product-grand-total">
                                                    <?php echo (($qty * $price)); ?>
                                                </td>

                                                <td class="cart-product-sub-total">
                                                    <?php echo $row['odate']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['badd']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sadd']; ?>
                                                </td>

                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        } ?>

                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->

                        </div>
                    </div>

                </div><!-- /.shopping-cart -->
            </div> <!-- /.row -->
            </form>
            ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
    <?php include('includes/footer.php'); ?>


    <script>
        $(document).ready(function () {
            $(".changecolor").switchstylesheet({ seperator: "color" });
            $('.show-theme-options').click(function () {
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function () {
            $('.show-theme-options').delay(2000).trigger('click');
        });
    </script>
    <!-- For demo purposes – can be removed on production : End -->
</body>

</html>