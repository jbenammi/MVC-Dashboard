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
        <a id="logo-container" href="<?= base_url(); ?>" class="brand-logo center"></a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="left hide-on-med-and-down">
                <li class="active"><a href="/user_dashboard"><i class="material-icons left">contacts</i>Dashboard</a></li>
                <li><a href="/profile/<?= $logged_info['id']; ?>"><i class="material-icons left">assignment_ind</i>Profile</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="/logoff">Log off</a></li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="/logoff">Log off</a></li>
                <li class="active"><a href="/user_dashboard">Dashboard</a></li>
                <li><a href="/profile/<?= $logged_info['id']; ?>">Profile</a></li>
            </ul>
      
    </div>
  </nav>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h3 class="header green-text col s6">hello <?= $logged_info['first_name']; ?></h3>
            <div class="row center">
                <table class="striped col s12">
                    <thead>
                        <th data-field="id">ID</th>
                        <th data-field="full_name">Name</th>
                        <th data-field="email">E-Mail</th>
                        <th data-field="created_on">Registered on</th>
                        <th data-field="admin_rights">User Rights</th>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($all_users); $i++){ ?>
                        <tr>
                            <td><?= $all_users[$i]['id']; ?></td>
                            <td><a href="/show_user_page/<?= $all_users[$i]['id']; ?>"><?= $all_users[$i]['full_name']; ?></td>
                            <td><?= $all_users[$i]['email']; ?></td>
                            <td><?= date("l F jS, Y", strtotime($all_users[$i]['created_on'])); ?></td>
                            <td><?php if($all_users[$i]['admin_rights'] == 1){
                                echo "Admin";
                                }
                                else {
                                    echo "User";
                                    } ?></td>
                        </tr>
                     <?php   } ?>
                    </tbody>
                </table>
            </div>
      

    </div>
  </div>


    <div class="container">
        <div class="section">

 
        </div>
    </div>
 

    <div class="section">

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