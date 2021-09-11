<?php
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php");
    exit();
}
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]);
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);

include "../storescripts/connect_to_mysql.php";
$sql = mysqli_query($conn, "SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");

$existCount = mysqli_num_rows($sql);
if ($existCount == 0) {
    echo "Your login session data is not on record in the database.";
    exit();
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
if (isset($_GET['deleteid'])) {
    echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
    exit();
}
if (isset($_GET['yesdelete'])) {
    $id_to_delete = $_GET['yesdelete'];
    $sql = mysqli_query($conn, "DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die(mysqli_error($conn));
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
        unlink($pictodelete);
    }
    header("location: inventory_list.php");
    exit();
}
?>
<?php
if (isset($_POST['product_name'])) {

    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $sql = mysqli_query($conn, "SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
    $productMatch = mysqli_num_rows($sql);
    if ($productMatch > 0) {
        echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
        exit();
    }
    $sql = mysqli_query($conn, "INSERT INTO products (product_name, price, details, category, subcategory, date_added) 
        VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die(mysqli_error($conn));
    $pid = mysqli_insert_id($conn);
    $newname = "$pid.jpg";
    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
    header("location: inventory_list.php");
    exit();
}
?>
<?php
$product_list = "";
$sql = mysqli_query($conn, "SELECT * FROM products ORDER BY date_added DESC");
$productCount = mysqli_num_rows($sql);
if ($productCount > 0) {
    while ($row = mysqli_fetch_array($sql)) {
        $id = $row["id"];
        $product_name = $row["product_name"];
        $price = $row["price"];
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $product_list .= "Product ID: $id - <strong>$product_name</strong> - $$price - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory_list.php?deleteid=$id'>delete</a><br />";
    }
} else {
    $product_list = "You have no products listed in your store yet";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory list</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
    <script type="text/javascript" language="javascript">
        function validateMyForm() {
            var isValid = true;
            if (document.myForm.product_name.value == "") {
                alert("Please type Product Name");
                isValid = false;
            } else if (document.myForm.price.value == "") {
                alert("Please enter price");
                isValid = false;
            } else if (document.myForm.details.value == "") {
                alert("Please provide details");
                isValid = false;
            } else if (document.myForm.fileField.value == "") {
                alert("Please provide picture");
                isValid = false;
            }
            return isValid;
        }
    </script>
</head>

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("../template_header.php"); ?>
        <div id="pageContent"><br />
            <div align="right" style="margin-right:32px"> <a href="http://localhost/dbms/storeadmin/logout.php">Logout</a> &middot;
                <a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a>
            </div>
            <div align="left" style="margin-left:24px;">
                <h2>Inventory List</h2>
                <?php echo $product_list; ?>
            </div>
            <a name="inventoryForm" id="inventoryForm"></a>
            <h3>
                &darr; Add New Inventory Item Form &darr;
            </h3>
            <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
                <table width="90%" border="0" cellspacing="0" cellpadding="6">
                    <tr>
                        <td width="20%" align="right">Product Name</td>
                        <td width="80%"><label>
                                <input name="product_name" type="text" id="product_name" size="64" />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Product Price</td>
                        <td><label>
                                $
                                <input name="price" type="text" id="price" size="12" />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Category</td>
                        <td><label>
                                <select name="category" id="category">
                                    <option value=""></option>
                                    <option value="Footwear">Footwear</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Watches">Watches</option>
                                    <option value="HandBag">HandBag</option>
                                    <option value="Perfumes">Perfumes</option>
                                    <option value="Jewellery">Jewellery</option>
                                    <option value="Sunglasses">Sunglasses</option>
                                    <option value="EBooks">EBooks</option>
                                    <option value="DVD">DVD's</option>
                                    <option value="Gaming">Gaming</option>
                                </select>
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Product Details</td>
                        <td><label>
                                <textarea name="details" id="details" cols="64" rows="5"></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Product Image</td>
                        <td><label>
                                <input type="file" name="fileField" id="fileField" />
                            </label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label>
                                <input type="submit" name="button" id="button" value="Add This Item Now" onclick="javascript:return validateMyForm();" />
                            </label></td>
                    </tr>
                </table>
            </form>
            <p><br />
                <br />
            </p>
        </div>
        <?php include_once("../template_footer.php"); ?>
    </div>
</body>

</html>