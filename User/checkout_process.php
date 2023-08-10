<?php
session_start();
include 'includes/header.php';

// Check if the global order ID counter is already set in the session
if (!isset($_SESSION['oid_counter'])) {
    $_SESSION['oid_counter'] = 1; // Initialize the global order ID counter
}

if (isset($_POST['submit'])) {
    $oid = $_SESSION['oid_counter'];
    $email = $_POST['email'];
    $bill = $_POST['bill'];
    $ship = $_POST['ship'];

    date_default_timezone_set('Asia/Kathmandu');
    $ldate = date('Y-m-d H:i:s');

    foreach ($_SESSION['cart'] as $productId => &$cartItem) {
        $quantity = $cartItem['quantity'];
        $pid = $cartItem['id'];
        $price = $cartItem['price'];
        $result = mysqli_query($conn, "INSERT INTO ordered_product(PID,OID,Quantity,Price,ordered_date) VALUES( $pid, $oid,$quantity, $price, '$ldate')");
        if (!$result) {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    mysqli_query($conn, "INSERT INTO billing(Address,OID) VALUES('$bill', $oid)");
    $billingId = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO shipping(address,OID) VALUES('$ship', $oid)");
    $shippingId = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO final_order(OID, BillingID, ShippingID, Email) VALUES($oid, $billingId, $shippingId, '$email')");

    unset($_SESSION['cart']);
    $_SESSION['orderid'] = $oid;
    $_SESSION['oid_counter'] += 1; // Increment the global order ID counter
    header('location:order-details.php');
}
?>