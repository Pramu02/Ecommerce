<?php
include 'conn/config.php'
    ?>
<!DOCTYPE HTML>
<html>

<head>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <nav class="header">
        <div class="header-top">
            <div class="wrap">
                <a href="index.php" style="text-decoration: none;"><img id="head_logo" src="images/pmLogo.png"
                        alt="Logo Image Here" style="margin-top: 1%;" />
                    <h2 id="logohead">&nbspMaharjan Website</h2>
                </a>

                <div class="nav-wrap">
                    <ul class="group" id="example-one">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">Products</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="product.php">Check</a></li>
                        <li><a href="product.php">Order Confirmation</a></li>

                </div>
                <div class="clear"></div>

            </div>

        </div>
        <div class="clear"></div>

        <div class="block">

            <div class="wrap">


                <form action="process_search.php" id="reservation-form" method="post" onsubmit="myFunction()">
                    <fieldset>
                        <div class="field">


                            <input type="text" placeholder="Enter A Product Name" style="height:30px;width:300px"
                                required id="search111" name="search">

                            <input type="submit" value="Search" style="height:34px;padding-top:3px" id="button111">
                        </div>

                    </fieldset>
                </form>
                <div class="clear"></div>
            </div>
    </nav>
    <script>
        function myFunction() {
            if ($('#search111').val() == "") {
                alert("Please enter product name...");
                return false;
            }
            else {
                return true;
            }
        }
    </script>
</body>

</html>