<?php
$errors = $this->session->flashdata('errors');
$logged_info = $this->session->userdata('logged_info');
// $message_info $comment_info and $wall_info being passed in
// var_dump($message_info);
// var_dump($wall_info);
// var_dump($comment_info);
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
                <li><a href="/profile/<?= $logged_info['id']; ?>"><i class="material-icons left">assignment_ind</i>Profile</a></li>
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
            <h4><?= $wall_info['full_name']; ?>'s Wall</h4>
        </div>
        <div class="row">

        <table class="responsive-table col s6 bordered">
            <tr>
                <td>Registerd on:</td>
                <td><?= $wall_info['created_on']; ?></td>
            </tr>
            <tr>
                <td>User ID:</td>
                <td><?= $wall_info['id']; ?></td>
            </tr>
            <tr>
                <td>E-Mail Address:</td>
                <td><?= $wall_info['email']; ?></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><?= $wall_info['description']; ?></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h5 class="header col s12 light">Leave a message for <?= $wall_info['first_name']; ?></h5>
            <form action="/Dashboards/create_message" method="post">
                <textarea name="message"></textarea>
                <input type="hidden" value="<?= $logged_info['id']; ?>" name="author_id" />
                <input type="hidden" value="<?= $wall_info['id']; ?>" name="wall_id" />
                <button class="btn waves-effect waves-light right" type="submit">Message<i class="material-icons right">message</i></button>
            </form>
        </div>
    </div>
    <div id="messageMain" class=" container col s12">
            <?php   
                for ($i = 0; $i < count($message_info); $i++){ 
                $d = strtotime($message_info[$i]["created_on"]); ?>
<!--         <div class="divider col s12">
        </div> -->
        <div id="message" class="row col s12">
            <h5 class="col s9"><?= $message_info[$i]['author'];?></h5>
            <p class="col s3 right-align"><?= date('g:ia F jS, Y', $d); ?></p>
            <div class="row col s12">
            <p><?= $message_info[$i]['message'];?></p>
            </div>
        <?php   for ($j = 0; $j < count($comment_info); $j++) {
                    if($comment_info[$j]['message_id'] == $message_info[$i]['id']){ ?>
                        <div id="comment" class="row col s9 offset-s3">
                            <h5 class="col s9"><?= $comment_info[$j]['author'];?></h5><p class="col s3 right-align"><?= date('g:ia F jS, Y', $d); ?></p>
                            <div class="row col s12">
                            <p><?= $comment_info[$j]['comment'];?></p>
                            </div>
                        </div>    
                    <?php    }
                    } ?>
        </div>
        <div class="row col s6 offset-s6">
        <h6 class="col s6 offset-s6">comment:</h6>
        <form class="col s6 offset-s6" action="/Dashboards/create_comment/<?= $wall_info['id']; ?>" method="post">
            <textarea name="comment" class="materialize-textarea"></textarea>
            <input type="hidden" value="<?= $message_info[$i]['id']; ?>" name="message_id"/>
            <input type="hidden" value="<?= $logged_info['id']; ?>" name="author_id" />
            <button class="btn waves-effect waves-light green white-text right" type="submit">comment<i class="material-icons right">comment</i></button>
        </form>
        </div>
        <br>
        <div class="divider row col s12"></div>
            <?php } ?>
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