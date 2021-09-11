<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: user_login.php");
    exit();
}
$userID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]);
$user = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["user"]);
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);

include "storescripts/connect_to_mysql.php";
$sql = mysqli_query($conn, "SELECT * FROM customer WHERE id='$userID' AND login='$user' AND password='$password' LIMIT 1");

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

if (isset($_POST['name'])) {

    $pid = mysqli_real_escape_string($conn, $_POST['thisID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);

    $sql = mysqli_query($conn, "UPDATE customer SET name='$name',email='$email',address='$address',city='$city', state='$state',pin='$pin' WHERE id='$pid'");
    header("location: index.php");
    exit();
}
?>
<?php

if (isset($_SESSION["id"])) {
    $targetID = $_SESSION["id"];
    $sql = mysqli_query($conn, "SELECT * FROM customer WHERE id='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql);
    if ($productCount > 0) {
        while ($row = mysqli_fetch_array($sql)) {

            $name = $row['name'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $pin = $row['pin'];
        }
    } else {
        echo "Sorry that doesnt exist.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
    <script type="text/javascript" language="javascript">
        function validateMyForm() {
            var isValid = true;
            if (document.userForm.name.value == "") {
                alert("Please type Your Name");
                isValid = false;
            } else if (document.userForm.mobile.value == "") {
                alert("Please enter your Mobile Number");
                isValid = false;
            } else if (document.userForm.email.value == "") {
                alert("Please provide your Email");
                isValid = false;
            } else if (document.userForm.address.value == "") {
                alert("Please provide your address");
                isValid = false;
            } else if (document.userForm.city.value == "") {
                alert("Please provide your city");
                isValid = false;
            } else if (document.userForm.state.value == "") {
                alert("Please provide your state");
                isValid = false;
            } else if (document.userForm.pin.value == "") {
                alert("Please provide your pin");
                isValid = false;
            }
            return isValid;
        }
    </script>
</head>

<body>
    <div align="center" id="mainWrapper">
        <?php include_once("template_header.php"); ?>
        <div id="pageContent"><br />
            <div align="left" style="margin-left:24px;">
            </div>
            <a name="UserRegistration" id="UserRegistration"></a>
            <h3>Edit Your profile</h3>
            <form action="" enctype="multipart/form-data" name="userForm" id="userForm" method="post">
                <table width="90%" border="0" cellspacing="0" cellpadding="6">
                    <tr>
                        <td width="20%" align="right">Full Name</td>
                        <td width="80%"><label>
                                <input name="name" type="text" id="name" size="40" value=<?php echo $name; ?> />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Mobile</td>
                        <td><label>
                                <?php echo $mobile; ?>
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Email Id</td>
                        <td><label>
                                <input name="email" type="text" id="email" size="50" value=<?php echo $email; ?> />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">Address</td>
                        <td><label>
                                <textarea name="address" id="address" cols="64" rows="5"><?php echo $address; ?></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right">City</td>
                        <td width="80%"><label>
                                <input name="city" type="text" id="city" size="20" value=<?php echo $city; ?> />
                            </label></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right">State</td>
                        <td width="80%"><label>
                                <input name="state" type="text" id="state" size="20" value=<?php echo $state ?> />
                            </label></td>
                    </tr>
                    <tr>
                        <td align="right">PinCode</td>
                        <td><label>
                                <input name="pin" type="text" id="pin" size="6" value=<?php echo $pin; ?> />
                            </label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label>
                                <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                                <input type="submit" name="button" id="button" value="Change Now" onclick="javascript:return validateMyForm();" />
                            </label></td>
                    </tr>
                </table>
            </form>
            <br />
            <br />
        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>

</html>