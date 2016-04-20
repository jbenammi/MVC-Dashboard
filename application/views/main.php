<?php 
$logged_info = $this->session->userdata('logged_info');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title>Dashboard</title>
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
    <link href="/assets/css/materialize_icons.css" rel="stylesheet">
</head>
<body>
	  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"> 
    	<?php if($logged_info['id']){ ?>
    	<a id="logo-container" href="<?= base_url(); ?>" class="brand-logo center"></a>  
    	<?php } 
        else {  ?>
    	<a id="logo-container" href="<?= base_url(); ?>" class="brand-logo"></a>  
	    <?php } ?>
        <?php if($logged_info['id']){ ?>
    <ul class="left hide-on-med-and-down">
    	<?php if($logged_info['admin_rights'] == '1'){ ?>
        <li><a href="/admin_dashboard"><i class="material-icons left">supervisor_account</i>Admin Dashboard</a></li>
        <?php }
        else { ?>
        <li><a href="/user_dashboard"><i class="material-icons left">contacts</i>Dashboard</a></li>
        <?php } ?>
        <li><a href="/profile/<?= $logged_info['id']; ?>"><i class="material-icons left">assignment_ind</i>Profile</a></li>
    </ul>
	<ul class="right hide-on-med-and-down">
        <li><a href="/logoff">Log off</a></li>
        <?php } 
        else {  ?>
	<ul class="right hide-on-med-and-down">  
        <li><a href="/signin">Sign In</a></li>
        <?php } ?>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="/signin">Sign In</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center green-text">Welcome to the Dashboard</h1>
      <div class="row center">
        <h5 class="header col s12 light">A modern responsive application for communicating with others.</h5>
      </div>
      <div class="row center">
        <a href="/register" id="download-button" class="btn-large waves-effect waves-light green">Let's get started</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
             <h5 class="center">Manage Users</h5>

            <p class="light">Using this application, you'll learn how to add, remove, and edit users for the application.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h5 class="center">Leave Messages</h5>

            <p class="light">Users will be able to leave a message to another user using this application.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h5 class="center">Edit User Information</h5>

            <p class="light">Admins will be able to edit another user's information (email address, first name, last name, etc).</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>
  	<!-- JS Script -->
	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/materialize.js"></script>
  
</body>
</html>