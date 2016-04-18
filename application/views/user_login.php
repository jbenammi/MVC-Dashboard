<?php 
$reg_errors = $this->session->flashdata('reg_errors');
$errors = $this->session->flashdata('errors');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title>Login and Registration</title>
	<meta name="description" content="This is an MVC assignment for Coding Dojo">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

</head>
<body>

	<form action="/Login/login_process" method="post">
		<fieldset>
			<legend>Log In</legend>
			<?php if(isset($errors['email'])){ ?>
				<p class="warning"><?= $errors['email']; ?></p>
			<?php } ?>
			<label>Email:</label>
			<input type="text" placeholder="Something@gmail.com" name="email" />
			<?php if(isset($errors['password'])){ ?>
				<p class="warning"><?= $errors['password']; ?></p>
			<?php } ?>
			<?php if($this->session->flashdata('login_errors')){ ?>
				<p class="warning"><?= $this->session->flashdata('login_errors'); ?></p>
			<?php } ?>			
			<label>Password:</label>
			<input type="password" name="password" />
			<input class="button" type="submit" value="Login" />
		</fieldset>
	</form>
	<form action="/Login/register" method="post">
			<fieldset>
			<legend>Or Register</legend>
			<?php if($this->session->flashdata('login_error2')){ ?>
				<p class="warning"><?= $this->session->flashdata('login_error2'); ?></p>
			<?php } ?>				
			<?php if(isset($reg_errors['first_name'])){ ?>
				<p class="warning"><?= $reg_errors['first_name']; ?></p>
			<?php } ?>
			<label>First Name:</label>
			<input type="text" placeholder="First Name" name="first_name"  />
			<?php if(isset($reg_errors['last_name'])){ ?>
				<p class="warning"><?= $reg_errors['last_name']; ?></p>
			<?php } ?>
			<label>Last Name:</label>
			<input type="text" placeholder="Last Name" name="last_name"  />
			<?php if(isset($reg_errors['email2'])){ ?>
				<p class="warning"><?= $reg_errors['email2']; ?></p>
			<?php } ?>
			<label>Email:</label>
			<input type="text" placeholder="Something@gmail.com" name="email2" />
			<?php if(isset($reg_errors['password2'])){ ?>
				<p class="warning"><?= $reg_errors['password2']; ?></p>
			<?php } ?>
			<label>Password:</label>
			<input type="password" name="password2" />
			<?php if(isset($reg_errors['confirmpass'])){ ?>
				<p class="warning"><?= $reg_errors['confirmpass']; ?></p>
			<?php } ?>
			<label>Confirm Password:</label>
			<input type="password" name="confirmpass"  />
			<input class="button" type="submit" value="Register" />
		</fieldset>
	</form>
</body>
</html>