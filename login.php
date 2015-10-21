<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="loginBox">
    	
        <form action="checklogin.php" method="post" id="login_form">
        <table>
            <tr><td colspan="2">log in</td></tr>
            <tr class="errorRow"><td colspan="2">
            	<?php
				if(isset($_GET['error'])){
					if($_GET['error'] == 0){
						echo 'Username or password incorrect. Try again!';
					}else if($_GET['error'] == 1){
						echo 'Please make sure you fill out all fields!';
					}else if($_GET['error'] == 2){
						echo 'A user with this username already exists!';
					}else if($_GET['error'] == 3){
						echo 'There seems to be an error with this log it!';
					}else if($_GET['error'] == 4){
						echo 'You must log in to access that page!';
					}
				}
				?>
            </td></tr>
            <tr>
            	<td>username</td>
                <td><input type="text" name="username" /></td>
            </tr>
            <tr>
            	<td>password</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
            	<td></td>
                <td><input type="submit" value="go" /></td>
            </tr>           
        
        <tr><td colspan="2"><hr /></td></tr>
        </table>
        </form>
        <form action="register.php" method="post" id="reg_form">
        <table>
            <tr><td colspan="2">register</td></tr>
            <tr>
            	<td>username</td>
                <td><input type="text" name="username" /></td>
            </tr>
            <tr>
            	<td>password</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
            	<td></td>
                <td><input type="submit" value="go" /></td>
            </tr>
        
        </table>
        </form>
    </div>
</body>
</html>

