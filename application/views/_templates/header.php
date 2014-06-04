<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Present Frame</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/cyborg/bootstrap.min.css">
    <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <!-- Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>public/js/application.js"></script>
</head>
<body>

    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL.$_SESSION['lang']; ?>">Present Frame</a>
        </div>

        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                 <li>
                    <a href="<?php echo URL . $_SESSION['lang']; ?>">
                        link1
                    </a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo URL."public/img/flags/".$_SESSION['lang'].".png"; ?>" height="24px" /> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($lang_model->getLanguages() as $language) { ?>
                            <li>
                                <a href="<?php echo $lang_model->linkTransform($language->short) ?>">
                                    <img src="<?php echo URL."public/img/flags/".$language->short.".png"; ?>" height="10px" />
                                    <?php echo $language->name ?> 
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                <?php if ( isset($_SESSION['username']) ) { ?> <!-- IF user is logedin -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <?php echo $lang_model->translate('Wellcome') . ' ' . $_SESSION['username']; ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo URL . $_SESSION['lang']; ?>/login/logout">
                                <?php echo $lang_model->translate('Logout'); ?>
                            </a></li>
                        </ul>
                    </li>
                <?php } else { ?> <!-- IF user is not loggedin -->
                    <li>
                        <a href="<?php echo URL . $_SESSION['lang']; ?>/login">
                        <?php echo $lang_model->translate('Login') ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo URL . $_SESSION['lang']; ?>/register">
                            <?php echo $lang_model->translate('Register') ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>