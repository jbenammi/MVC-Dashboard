<?php 

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title></title>
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>
	<h2>Welcome <?= $this->session->userdata('first_name'); ?></h2>
	<a href="/Logoff">log off</a>
	<fieldset>
		<legend>User Information</legend>
		<table>
			<tr>
				<td>First Name:</td>
				<td><?= $this->session->userdata('first_name'); ?></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><?= $this->session->userdata('last_name'); ?></td>
			</tr>
			<tr>
				<td>E-Mail Address:</td>
				<td><?= $this->session->userdata('email'); ?></td>
			</tr>
		</table>
	</fieldset>
</body>
</html>