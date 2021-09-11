<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
include "storescripts/connect_to_mysql.php";
$dynamicList = "";
$sql = mysqli_query($conn, "SELECT * FROM products ORDER BY date_added DESC LIMIT 5");
$productCount = mysqli_num_rows($sql);
if ($productCount > 0) {
    while ($row = mysqli_fetch_array($sql)) {
        $id = $row["id"];
        $product_name = $row["product_name"];
        $price = $row["price"];
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td width="17%" align="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
          <td width="83%" align="top">' . $product_name . '<br />
            $' . $price . '<br />
            <a href="product.php?id=' . $id . '">View Product Details</a></td>
        </tr>
      </table>';
    }
} else {
    $dynamicList = "We have no products listed in our store yet";
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Home Page</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("template_header.php");
        if (isset($_GET['success'])) {
            echo "Successful Registration.";
        }
        if (isset($_GET['userloginsuccess'])) {
            echo "Successful Login.";
        }
        if (isset($_GET['resetsuccess'])) {
            echo "Password Successfully Changed.";
        }
        ?>

        <div id="pageContent">
            <h3>About Magento</h3>
            <p>This is a big shopping mall with over 150 shops and three levels of parking space and moreover 5,000 employees including shop owners, staff members and mall owners. It has thousands of satisfied customers.<br />
        </div>

        <div id="pageContent">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
                <td width="50%" align="top">
                    <h3>Latest Designer Fashions</h3>
                    <p><?php echo $dynamicList; ?><br />
                    </p>
                    <p><br />
                    </p>
                </td>
                <?php
                error_reporting(E_ERROR | E_WARNING | E_PARSE);

                session_start();
                if (!isset($_SESSION['user'])) {
                ?>
                    <td width="50%" align="top">
                        <h3><a href="http://localhost/dbms/user_registration.php">New User? Register Here!!</a></h3>
                        <p>Already a Customer? Welcome!! </p>
                        <p><a href="http://localhost/dbms/user_login.php">Login</a> and shop from our exclusive products.</p>
                        <a href="http://localhost/dbms/user_login.php" class="myButton">Login Now</a>
                    </td>
                <?php } ?>
                </tr>
            </table>

        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>

</html>