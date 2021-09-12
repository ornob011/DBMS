<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
include "storescripts/connect_to_mysql.php";
$cartOutput = "";
$cartTotal = 0;
if (isset($_SESSION["id"])) {
    $cid = $_SESSION["id"];
    $sql = mysqli_query($conn, "SELECT * FROM customer_cart WHERE customerid='$cid'") or die(mysqli_error($conn));
    $count = mysqli_num_rows($sql);
    if ($count == 0) {
        $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
    } else {
        $i = 0;
        while ($lists = mysqli_fetch_array($sql)) {
            $item_id = $lists["productid"];
            $sqls = mysqli_query($conn, "SELECT * FROM products WHERE id='$item_id' LIMIT 1") or die(mysqli_error($conn));
            $list = mysqli_fetch_array($sqls);
            $product_name = $list["product_name"];
            $price = $list["price"];
            $details = $list["details"];
            $quantity = $lists["quantity"];
            $pricetotal = $price * $quantity;
            $cartTotal = $pricetotal + $cartTotal;

            $cartOutput .= '<p>Item ID: ' . $item_id . ', Product Name: ' . $product_name . ', Quantity : ' . $quantity . ', Total price of this item: ' . $pricetotal . '</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" language="javascript">
        function validateMyForm() {
            var isValid = true;


            // var pay_date = new Date(document.paymentForm.cardExpiry.value);
            // pay_date = moment(pay_date).format('MM-DD-YYYY');

            // var now = new Date();
            // now = moment(now).format('MM-DD-YYYY');



            if (document.paymentForm.amount.value == "") {
                alert("Amount can't be null");
                isValid = false;
            } else if (document.paymentForm.cardnumber.value != "4242424242424242") {
                alert("Please type Stripe Test Visa Card Number");
                isValid = false;
            // } else if (pay_date.getTime() - now.getTime() > 0) {
            //     alert("Your card is expired");
            //     isValid = false;
            } else if (document.paymentForm.cvc.value == "") {
                alert("Please confirm Your CVC code");
                isValid = false;
            } else if (document.paymentForm.postal.value == "") {
                alert("Please provide zip code");
                isValid = false;
            }
            return isValid;
        }
    </script>
</head>

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("template_header.php"); ?>
        <div id="pageContent">

            <?php if ($count > 0) : ?>
                <h3>Pay <?php echo '$' . $cartTotal; ?></h3>
            <?php endif; ?>
            <?php echo $cartOutput; ?>
        </div>

        <?php if ($count > 0) : ?>
            <div id="pageContent" class="panel-body">
                <!-- Display errors returned by createToken -->
                <div id="paymentResponse"></div>

                <!-- Payment form -->
                <form action="process.php" method="POST" name="paymentForm" id="paymentForm">
                    <table width="90%" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                            <td width="20%" align="right">Amount</td>
                            <td width="80%"><label>
                                    <input type="text" name="amount" readonly value="<?php echo htmlspecialchars($cartTotal); ?>" />
                                </label></td>
                        </tr>

                        <tr>
                            <td width="20%" align="right">Card Number</td>
                            <td width="80%"><label>
                                    <input type="text" name="cardnumber" class="field" placeholder="Enter card number" required="">
                                </label></td>
                        </tr>


                        <!-- <tr>
                            <td width="20%" align="right">Expiry Date</td>
                            <td width="80%"><label>
                                    <input type="date" name="cardExpiry" class="field" placeholder="Enter expiry date" required="">
                                </label></td>
                        </tr> -->

                        <tr>
                            <td width="20%" align="right">CVC Code</td>
                            <td width="80%"><label>
                                    <input type="text" name="cvc" class="field" placeholder="Enter CVC code" required="">
                                </label></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">Zip Code</td>
                            <td width="80%"><label>
                                    <input type="text" name="postal" class="field" placeholder="Enter ZIP code" required="">
                                </label></td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" id="checkout-button" value="Checkout" onclick="javascript:return validateMyForm();"></input></td>
                        </tr>
                    </table>

                </form>
            </div>
            <?php include_once("template_footer.php"); ?>
    </div>

    <script src="card.js"></script>

<?php endif; ?>

</body>

</html>