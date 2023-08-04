<?php
include 'includes/header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">

    <style>
        h2 {
            text-align: center;
            margin-top: 15px;
        }

        .pic {
            margin-top: 30px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
        }

        .box-body {
            Width: 80%;
            margin: auto;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .btn-success {
            margin-top: 20px;
            text-align: center;
            display: flex;

        }

        textarea {
            width: 100%;
            height: 70px;
        }
    </style>
</head>

<body>
    <img src="news_images/add_product.png" class="pic" alt="pic">
    <h2> Add Product </h2>
    <div class="content-wrapper">

        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <form action="process_add.php" method="post" enctype="multipart/form-data" id="form1">
                        <div class="form-group">
                            <label class="control-label">Enter Product name</label>
                            <input type="text" name="name" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Enter Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Enter The Product Image</label>
                            <input type="file" name="attachment" class="form-control" placeholder="Images">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Enter The Product Description</label>
                            <textarea cols="30" rows="15" name="desc" id="desc"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>

</body>

</html>