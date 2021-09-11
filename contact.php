<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
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
                    <td width="86%" align="top">
                        <h3>Contact us at:</h3>
                        <p>Magento Mall,<br />
                            Baluchor, Sylhet <br />
                            <br />
                        </p>
                        <p>Email us at - <a href="mailto:gourab@gmail.com">gourab@gmail.com</a></p>
                        <p>Gourab Roy<br />
                            <a href="mailto:gourab@gmail.com">gourab@gmail.com</a>
                            <br />
                            01751531456
                        </p>
                        <p>Ornob Rahman<br />
                            <a href="ornob@gmail.com">ornob@gmail.com</a>
                            <br />
                            01778747556<br />
                        </p>
                    </td>
                    <!-- <td width="4%" align="top">
                        <p><br />
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </td> -->
                    <?php
                        error_reporting(E_ERROR | E_WARNING | E_PARSE);

                        session_start();
                        if (!isset($_SESSION['user'])) {
                        ?>
                        <!-- <td width="10%" align="top">
                            <h3>&nbsp;</h3>
                            <p></p>
                        </td> -->
                    <?php } ?> 
                </tr>
            </table>
        </div>
        <?php include_once("template_footer.php"); ?>
    </div>
</body>

</html>