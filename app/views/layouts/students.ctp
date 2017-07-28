<!DOCTYPE html>
<html lang="">
    <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Manager Student</title>

    	<!-- Bootstrap CSS -->
        <?php echo $this->Html->css("bootstrap.min.css"); ?>
        <?php echo $this->Html->css("animate.css"); ?>
        <?php echo $this->Html->css("grid1200.css"); ?>
        <?php echo $this->Html->css("structure.css"); ?>
        <?php echo $this->Html->css("stylesheet.css"); ?>

    </head>
    <body>
        <header id="header">
            <div class="container">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            <a class="navbar-brand" href="<?php echo Router::url('/Home', true) ?>"><span>BPO</span> University </a>
                        </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav custom_nav">
                        <?php if(isset($dataUser) && $dataUser['UsersGroup']['group_id'] == 1 || $dataUser['UsersGroup']['group_id'] == 2) {
                            echo '<li class=""></li>';
                            echo '<li class=""><a href="'.Router::url("/Students", true).'">- Manager Student -</a></li>';
                        }?>
                        </ul>
                    </div>
                    </div>
                </nav>
                <div class="nav navbar-nav navbar-right">
                    <?php
                        if (isset($dataUser)) {
                            echo '<li class="dropdown login-user">';
                            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">';
                            echo '<i class="fa fa-user-circle-o" aria-hidden="true"></i>'.$dataUser['Student']['username'].'</a>';
                            echo '<ul class="dropdown-menu" role="menu">';
                            echo '<li><a class="a-b-c" href="'.Router::url("/Users/logout", true).'"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>';
                            echo '</ul>';
                            echo '</li>';
                        } else {
                            echo '<li class="dropdown login-header"><a class="dropdown-toggle" href="'.Router::url("/Users/login", true).'"><i class="fa fa-user-circle-o" aria-hidden="true"></i> LOGIN </a></li>';
                        }
                    ?>
                </div>
                <form id="searchForm">
                    <input type="text" placeholder="Search...">
                    <input type="submit" value="">
                </form>
            </div>
        </header>

        <?php echo $content_for_layout ?>

        <?php echo $this->Html->script("jquery-2.2.4.min.js"); ?>
        <?php echo $this->Html->script("bootstrap.min.js"); ?>
        <?php echo $this->Html->script("wow.min.js"); ?>
        <?php echo $this->Html->script("script.js"); ?>
    </body>
</html>
