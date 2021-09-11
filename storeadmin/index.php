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
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin Area</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("../template_header.php"); ?>
        <div id="pageContent"><br />
            <div align="left" style="margin-left:24px;">
                <h2>Hello store manager, what would you like to do today?</h2>
                <p><a href="inventory_list.php">Manage Inventory</a></br>
                    <a href="http://localhost/dbms/storeadmin/user_list.php">Manage Users</a>
                </p>
                <a href="http://localhost/dbms/storeadmin/logout.php">Logout</a> </p>
            </div>
            <br />
            <br />
            <br />
        </div>
        <?php include_once("../template_footer.php"); ?>
    </div>
</body>

</html>