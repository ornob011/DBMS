<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
include "storescripts/connect_to_mysql.php";
if (isset($_POST['login'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login']);
	$security = mysqli_real_escape_string($conn, $_POST['security']);
	$securityanswer = mysqli_real_escape_string($conn, $_POST['ganswer']);
	$newpassword = mysqli_real_escape_string($conn, $_POST['password']);
	$newcpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
	$sql = mysqli_query($conn, "SELECT * FROM customer WHERE login='$login' LIMIT 1");
	$userMatch = mysqli_num_rows($sql); 
	$list = mysqli_fetch_array($sql);
	$oldpassword = $list['password'];
	$correctsecurity = $list['security'];
	$correctsecurityanswer = $list['securityanswer'];
	if($security==$correctsecurity && $securityanswer==$correctsecurityanswer){
			if($newpassword != $newcpassword){
				echo 'Password Mismatch, <a href="forgetpass.php">Retry here</a>';
				exit();
			}
			else if($newpassword==$oldpassword){
				echo 'Same as old password, <a href="user_login.php">Login here</a>';
				exit();
			}
			else {
				$upd = mysqli_query($conn, "UPDATE customer SET password='$newpassword' WHERE login='$login'");
			}
	}
	else {
		echo 'You have entered wrong details. In case you forget your details, <a href="contact.php">click here</a>';
		exit();
	}
	header("location: index.php?resetsuccess"); 
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recover Password</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<script type="text/javascript" language="javascript"> 

function validateMyForm ( ) { 
    var isValid = true;
	if ( document.forget.login.value == "" ) { 
	    alert ( "Please enter login name" ); 
	    isValid = false;
    } else if ( document.forget.security.value == "" ) { 
	    alert ( "Please select security question" ); 
	    isValid = false;
    } else if ( document.forget.ganswer.value == "" ) { 
	    alert ( "Please answer the security question" ); 
	    isValid = false;
    } else if ( document.forget.password.value == "" ) { 
	    alert ( "Please enter password" ); 
	    isValid = false;
    } else if ( document.forget.cpassword.value == "" ) { 
	    alert ( "Please confirm password" ); 
	    isValid = false;
    }
    return isValid;
}
</script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php"); ?>
  <div id="pageContent"></p>
<a name="ForgetPassword" id="ForgetPassword"></a>
    <h3>
    &darr; Reset Password &darr;
    </h3>
    <form action="" enctype="multipart/form-data" name="forget" id="forget" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="37%" align="right">Login Name</td>
        <td width="63%"><label>
          <input name="login" type="text" id="login" size="40" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Security Question</td>
        <td><label>
          <select name="security" id="security">
          <option value=""></option>
          <option value="What is your school name?">What is your school name?</option>
          <option value="What is your mother's first maiden name?">What is your mother's first maiden name?</option>
          <option value="What is your favorite hobby?">What is your favorite hobby?</option>
          <option value="What is your nick name?">What is your nick name?</option>
          <option value="What is your pet name?">What is your pet name?</option>
          <option value="What is your favorite game?">What is your favorite game?</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td width="37%" align="right">Answer</td>
        <td width="63%"><label>
          <input name="ganswer" type="text" id="ganswer" size="40" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Password</td>
        <td width="80%"><label>
          <input name="password" type="password" id="password" size="20" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Confirm Password</td>
        <td width="80%"><label>
          <input name="cpassword" type="password" id="cpassword" size="20" />
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
            <input type="submit" name="button" id="button" value="Check Now"  onclick="javascript:return validateMyForm();"/>
        </label></td>
      </tr>
    </table>
    </form>
  </div>
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>