<?php
$errors = $this->session->flashdata('errors');
$logged_info = $this->session->userdata('logged_info');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title>Dashboard-add new user</title>
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
    <link href="/assets/css/materialize_icons.css" rel="stylesheet">
</head>
<body>
	<nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container">
        <a id="logo-container" href="<?= base_url(); ?>" class="brand-logo center"></a>
             <ul class="left hide-on-med-and-down">
                <?php if($logged_info['admin_rights'] == '1'){ ?>
                <li><a href="/admin_dashboard"><i class="material-icons left">supervisor_account</i>Admin Dashboard</a></li>
                <?php }
                else { ?>
                <li><a href="/user_dashboard"><i class="material-icons left">contacts</i>Dashboard</a></li>
                <?php } ?>
                <li class="active"><a href="/profile/<?= $logged_info['id']; ?>"><i class="material-icons left">assignment_ind</i>Profile</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="/logoff">Log off</a></li>
            </ul>
        </div>
    </nav>



    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row">
                <h5 class="header col s12 light">Edit Profile</h5>



                <form class="form col s6" action="/edit_profile_info" method="post">
                    <fieldset>
                        <legend>Edit information</legend>             
                    <?php if(isset($errors['first_name'])){ ?>
                        <p class="warning"><?= $errors['first_name']; ?></p>
                    <?php  } ?>
                    <label for="reg_first_name">Frist Name:</label>
                    <input id="reg_first_name" class="input-field" type="text" placeholder="Your First Name" name="first_name" value="<?= $logged_info['first_name']; ?>" />                    
                    <?php if(isset($errors['last_name'])){ ?>
                        <p class="warning"><?= $errors['last_name']; ?></p>
                    <?php  } ?>
                    <label for="reg_last_name">Last Name:</label>
                    <input id="reg_last_name" class="input-field" type="text" placeholder="Your Last Name" name="last_name" value="<?= $logged_info['last_name']; ?>"/>                
                    <?php if(isset($errors['email'])){ ?>
                        <p class="warning"><?= $errors['email']; ?></p>
                    <?php  } ?>
                    <label for="reg_email">Email Address:</label>
                    <input id="reg_email" class="input-field" type="text" placeholder="something@something.com" name="email" value="<?= $logged_info['email']; ?>"/>
                    <input type="hidden" value="<?= $logged_info['id']; ?>" name="id" />
                    <button class="btn waves-effect waves-light right" type="submit" name="action">Save<i class="material-icons right">send</i></button>
                    </fieldset>
                </form>



                 <form class="form col s6" action="/Dashboards/edit_password" method="post">
                    <fieldset>
                        <legend>Change password</legend>
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
                    <input type="hidden" value="<?= $logged_info['id'];?>" name="id" />
                    <button class="btn waves-effect waves-light right" type="submit">Update Password<i class="material-icons right">send</i></button>
                    </fieldset>
                </form>



                <form class="form col s12" action="/Dashboards/edit_profile_desc" method="post">
                    <fieldset>
                        <legend>Edit Description</legend>
                            <textarea name="description"><?= $logged_info['description']; ?></textarea>
                    <input type="hidden" value="<?= $logged_info['id']; ?>" name="id"/>
                    <button class="btn waves-effect waves-light right" type="submit">Save<i class="material-icons right">send</i></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


   	<!-- JS Script -->
	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/materialize.js"></script>
  
</body>
</html>