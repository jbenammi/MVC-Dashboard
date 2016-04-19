<?php
$errors = $this->session->flashdata('errors');
$login_error = $this->session->flashdata('login_error');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title>Dashboard-login</title>
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
    <link href="/assets/css/materialize_icons.css" rel="stylesheet">
</head>
<body>
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="<?= base_url(); ?>" class="brand-logo"></a>
            <ul class="right hide-on-med-and-down">
            <li><a href="/signin">Sign In</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
            <li><a href="/signin">Sign In</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row">
                <h5 class="header col s12 light">Sign In</h5>
                <form class="form col s6" action="/process_signin" method="post">
                <?php if(isset($login_error)){ ?>
                    <p class="warning"><?= $login_error; ?></p>
                <?php  } ?>
                <?php if(isset($errors['email'])){ ?>
                    <p class="warning"><?= $errors['email']; ?></p>
                <?php  } ?>
                <label for="signin_email">Email Address:</label>
                <input id="signin_email" class="input-field" type="text" placeholder="something@something.com" name="email" />
                <?php if(isset($errors['password'])){ ?>
                    <p class="warning"><?= $errors['password']; ?></p>
                <?php  } ?>
                <label for="signin_password">Password:</label>
                <input id="signin_password" class="input-field" type="password" placeholder="password ********" name="password" />
                <button class="btn waves-effect waves-light" type="submit" name="action">Sign In<i class="material-icons right">send</i></button>
                </form>
            </div>
            <div class="row col s12">
            <a href="/register">Don't have an account? Register</a>
            </div>
        </div>
    </div>


   	<!-- JS Script -->
	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/materialize.js"></script>
  
</body>
</html>