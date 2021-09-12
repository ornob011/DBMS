<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "storescripts/connect_to_mysql.php";

if (isset($_POST['amount'])) {
    $cid = $_SESSION["id"];
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $cardnumber = mysqli_real_escape_string($conn, $_POST['cardnumber']);
    $txnID = mysqli_real_escape_string($conn, uniqid(mt_rand(), true));
    $cvc = mysqli_real_escape_string($conn, $_POST['cvc']);
    $postal = mysqli_real_escape_string($conn, $_POST['postal']);
    $payment_time = mysqli_real_escape_string($conn, date("m/d/Y"));

    $sql = mysqli_query($conn, "INSERT INTO payment (cid, amount, cardnumber, txnID, cvc, postal, payment_time) 
        VALUES('$cid', '$amount', '$cardnumber', '$txnID','$cvc','$postal','$payment_time')") or die(mysqli_error($conn));
    $pid = mysqli_insert_id($conn);

    header("location: cart.php?success");

    $sql = mysqli_query($conn, "DELETE FROM customer_cart WHERE customerid='$cid'") or die(mysqli_error($conn));

    exit();
} else {
    echo '<script>alert("Failed to pay.")</script>';
    exit();
}
