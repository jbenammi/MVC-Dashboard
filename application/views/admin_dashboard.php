<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Jonathan Ben-Ammi">
	<title>Admin Dashboard</title>
	<meta name="description" content="">
	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
</head>
<body>
	<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><div class="logo"><a id="logo-container" href="<?= base_url(); ?>" class="brand-logo"></a></div>
        <ul class="left hide-on-med-and-down">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a href="/logoff">Log off</a></li>
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
      <h1 class="header center green-text">Welcome <?= $user_info['firstname']; ?></h1>
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