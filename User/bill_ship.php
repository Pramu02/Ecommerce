<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="./css/bill_ship_Style.css">
</head>

<body>
    <div id="head_modal">
        <h4 id="title">Billing/Shipping Details</h4>
        <span class='close' onclick='closeModal()'>&times;</span>
    </div>

    <div id="body_modal">
        <form action="checkout_process.php" id="modal_form" method="POST">
            <div class="item">
                <p>Email</p>
                <div class="name-item">
                    <input type="email" name="email" placeholder="Email Here..." id="inp" required />
                </div>
            </div>
            <div class="item">
                <p>Billing Address</p>
                <input type="text" name="bill" id="inp" required />
            </div>
            <div class="item">
                <p>Shipping Address</p>
                <textarea rows="3" name="ship" id="modal_ship" required></textarea>
            </div>
            <div class="btn-block">
                <button type="submit" name="submit" id="modal_button">PROCEED</button>
            </div>
        </form>
    </div>
</body>

</html>