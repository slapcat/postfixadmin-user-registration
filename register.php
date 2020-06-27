<?php
$domain = "{ENTER DOMAIN HERE}";
?>

<!doctype html>
<html lang="">

	<head>
        <meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Postfix Admin - Create Account</title>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	</head>

<body class="lang- page-login ">

	<div id="container">
	<div id="login_header">
	<a href='main.php'><img id="login_header_logo" src="../images/logo-default.png" alt="Logo" /></a>
	</div>

<br clear="all" /><!-- flash_error.tpl -->
<br clear="all"/><br />

<div id="login">
	<form name="register" method="post" action="">

	<table id="login_table" cellspacing="10"><tr><th colspan="4"><h1>Create a New Email Account</h1><br /><br /><br /></th></tr>

	<tr><td class="label">Username</td><td><input class="flat" type="text" name="user" value="" /> <?php printf("@" . $domain) ?></td><td></td><td class="error_msg"></td></tr>	
	<tr><td class="label">Password</td><td><input class="flat" type="password" name="pass" /><br />Must contain at least 5 characters and 2 numbers.</td><td></td><td class="error_msg"></td></tr>
	<tr><td class="label">Password (again)</td><td><input class="flat" type="password" name="pass2" /></td><td></td><td class="error_msg"></td></tr>
	<tr><td class="label">Full Name</td><td><input class="flat" type="text" name="fullname" value="" /></td><td></td><td class="error_msg"></td></tr>
	<tr><td class="label">Other e-mail</td><td><input class="flat" type="text" name="email_other" value="" /><br />Used if the password is forgotten</td><td></td><td class="error_msg"></td></tr>
	<tr><td>&nbsp;</td><td colspan="3"><input class="button" type="submit" name="submit" value="Submit" /></td></tr>

	</table>
	</form>
</div>
<br /><br /> <br />

<?php

$user = $_POST['user'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
$fullname = $_POST['fullname'];
$email_other = $_POST['email_other'];

if (empty($user) && empty($pass) && empty($pass2) && empty($fullname) && empty($email_other)) {

	// fresh form

} elseif (empty($user) || empty($pass) || empty($pass2) || empty($fullname) || empty($email_other)) {

	echo '<b><font color="red">ERROR: Please enter all information!</b></font><BR><BR>';

} elseif ($pass != $pass2) {

	echo '<b><font color="red">ERROR: Passwords do not match!</b></font><BR><BR>';

} else {

	$cmd = "postfixadmin-cli mailbox add " . $user . "@" . $domain . " --password " . $pass . " --password2 " . $pass2 . " --name \"" . $fullname . "\" --email-other " . $email_other . " --quota 0 2>&1";

	// Ensure that no funny business goes on with shell injection
	// escapeshellcmd() can also be used, but then all escaped characters must be banned from the password
	$and = strpos($cmd, " & ");
	$and2 = strpos($cmd, " && ");
	$pipe = strpos($cmd, " | ");
	$semi = strpos($cmd, ";");
	$tick = strpos($cmd, "`");

	if ($and === false && $and2 === false && $pipe === false && $semi === false && $tick === false) {

		$output = shell_exec($cmd);
		printf("<b>" . $output);
		echo '</b><br /><br />Congratulations! If the message above <b>explicitly</b> states that your account was created successfully, you can now login to your email account.';

	} else {

		echo '<b><font color="red">ERROR: You have entered a banned character!</b></font><BR><BR>';

	}
}
?>
</center>
</body>
</html>
