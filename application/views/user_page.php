<?php
$errors = $this->session->flashdata('errors');
$logged_info = $this->session->userdata('logged_info');
$user_profile = $profile_info;
var_dump($user_profile);
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
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="/logoff">Log off</a></li>
                <?php if($logged_info['admin_rights'] == '1'){ ?>
                <li><a href="/admin_dashboard">Admin Dashboard</a></li>
                <?php }
                else { ?>
                <li><a href="/user_dashboard">Dashboard</a></li>
                <?php } ?>
                <li><a href="/profile/<?= $logged_info['id']; ?>">Profile</a></li>
            </ul>
        </div>
    </nav>
   <div class="container">
        <div class="row">
        <table class="responsive-table">
            <tr>
                <td>Registerd on:</td>
                <td><?= $user_profile['created_on']; ?></td>
            </tr>
            <tr>
                <td>User ID:</td>
                <td><?= $user_profile['id']; ?></td>
            </tr>
            <tr>
                <td>E-Mail Address:</td>
                <td><?= $user_profile['email']; ?></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><?= $user_profile['description']; ?></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h5 class="header col s12 light">Leave a message for </h5>
            <form action="/post_message/<?= $logged_info['id']; ?>" method="post">
                <textarea name="message"></textarea>
                <button class="btn waves-effect waves-light right" type="submit">Save<i class="material-icons right">send</i></button>
            </form>
        
        </div>

    <div id="messageMain" class="row col s12">
            <?php   
                for ($i = 0; $i < count($user_profile); $i++){ 
                $d = strtotime($user_profile[$i]["created_on"]); ?>
        <div class="message">
                        <h3><?= $user_profile[$i]['author'];?></h3><p><?= date('g:ia F jS, Y', $d); ?></p>
                        <div><?= $user_profile[$i]['message'];?></div>
                        <?php } ?>
        </div>
    </div>

  


   	<!-- JS Script -->
	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/materialize.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

        $(".button-collapse").sideNav();
            
        })

    </script>    
</body>
</html>