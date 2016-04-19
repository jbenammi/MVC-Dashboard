<?php
$errors = $this->session->flashdata('errors');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title>Dashboard-register</title>
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
</head>
<body>
	<nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><div class="logo"><a id="logo-container" href="<?= base_url(); ?>" class="brand-logo"></a></div>
            <ul class="right hide-on-med-and-down">
                <li><a href="/signin">Sign In</a></li>
            </ul>
        </div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row">
                <h5 class="header col s12 light">Register</h5>
                <form class="form col s6" action="/Dashboards/signin" method="post">
                    <?php if(isset($errors['first_name'])){ ?>
                        <p class="warning"><?= $errors['first_name']; ?></p>
                    <?php  } ?>
                    <label for="reg_first_name">Frist Name:</label>
                    <input id="reg_first_name" class="input-field" type="text" placeholder="Your First Name" name="first_name" />                    
                    <?php if(isset($errors['last_name'])){ ?>
                        <p class="warning"><?= $errors['last_name']; ?></p>
                    <?php  } ?>
                    <label for="reg_last_name">Last Name:</label>
                    <input id="reg_last_name" class="input-field" type="text" placeholder="Your Last Name" name="last_name" />                
                    <?php if(isset($errors['email'])){ ?>
                        <p class="warning"><?= $errors['email']; ?></p>
                    <?php  } ?>
                    <label for="reg_email">Email Address:</label>
                    <input id="reg_email" class="input-field" type="text" placeholder="something@something.com" name="email" />
                    <?php if(isset($errors['password'])){ ?>
                        <p class="warning"><?= $errors['password']; ?></p>
                    <?php  } ?>
                    <label for="reg_password">Password:</label>
                    <input id="reg_password" class="input-field" type="password" placeholder="password ********" name="password" />
                    <?php if(isset($errors['confirmpass'])){ ?>
                        <p class="warning"><?= $errors['confirmpass']; ?></p>
                    <?php  } ?>                    
                    <label for="reg_confirmpass">Confirm Password:</label>
                    <input id="reg_confirmpass" class="input-field" type="password" placeholder="password ********" name="confirmpass" />
                    <input class="waves-effect waves-light green white-text" type="submit" value="Register" />
                </form>
            </div>
            <div class="row left">
                <a href="/signin">Already have an account? Sign In</a>
            </div>
        </div>
      </div>


   	<!-- JS Script -->
	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/materialize.js"></script>
  
</body>
</html>