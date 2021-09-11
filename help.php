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

        ?>
        <div id="pageContent">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                    <td width="94%" valign="top">
                        <h3>Help Section</h3>
                        <p>Magento mall serves customers by online. Instead of physically shopping, customers can register with us and get an account through which they can shop online. All the items we provide are displayed in our website. Customers can select items they want, their quantity which they want and they can choose credit card for the payment instantly or as their wishlist when they visit us next time.</p>
                        <p>Each user who has registered is given a virtual cart that displays all the items he has chosen. Few items are offered discounts that are automatically added to items in cart. Net price is displayed at the bottom.</p>
                        <p>With our user-friendly website one can easily order items.</p>
                        <p>
                        <ul>
                            <li>Clicking on products, one can start with choosing items.</li>
                            <li> All the items are displayed in grid view. Clicking on an
                                item, directs to page with details about the product.</li>
                            <li>Clicking on add to cart, adds that item to cart and user can choose quantity of the product any available discount is automatically added to that item and net price is evaluated, which is shown at the bottom.</li>
                            <li>Clicking on checkout, user can choose address to which the items in cart are to be delivered. </li>

                        </ul>
                        </p>
                        <p><br />
                    </td>
                    <td width="3%" align="top">
                        <p><br />
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </td>
                    <?php
                    error_reporting(E_ERROR | E_WARNING | E_PARSE);

                    session_start();
                    if (!isset($_SESSION['user'])) {
                    ?>
                        <td width="3%" align="top">
                            <h3>&nbsp;</h3>
                            <p></p>
                        </td>
                    <?php } ?>

                </tr>
            </table>

        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>

</html>