# About

Postfixadmin User Registration is a simple php script that allows users to create their own email accounts in postfixadmin.

<p align="center">
<img src="https://github.com/jnabasny/Very-Secure-Database/blob/master/head.png">
</p>

## Configuration and Installation

Configuration is done in three simple steps:

1. Edit the top of _register.php_ so that ```$domain = "{ENTER DOMAIN HERE}";``` includes your email domain. For example:

```$domain = "@example.com";```

2. Place _register.php_ in /usr/share/postfixadmin/public/users/. Make sure it is owned by root.

3. Add a register link to the login page by placing this code in /usr/share/postfixadmin/templates/login.tpl:

```
<tr>
	<td class="label">&nbsp;</td>
	<td><a href="https://your.postfixadmin.domain.com/users/register.php">Register for an Account</a></td>
</tr>
```

IMPORTANT: You must use the absolute path to _register.php_ or else the link will not work on both admin and user login pages. 

A sample login.tpl file is included in this repository.

## Contact

Feel free to [email me](mailto:jnabasny@gmail.com) with any questions or comments!
