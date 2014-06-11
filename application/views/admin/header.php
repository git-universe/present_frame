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
    <link href="<?php echo URL; ?>public/css/codemirror.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/monokai.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- Codemirror -->
    <script src="<?php echo URL; ?>public/js/codemirror.js"></script>
    <!-- htmlmixed mode for codemirror -->
    <script src="<?php echo URL; ?>public/js/xml.js"></script>
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
                    <a href="<?php echo URL . $_SESSION['lang']; ?>/admin/pages">
                        Edit pages
                    </a>
                </li>

                <li>
                    <a href="<?php echo URL . $_SESSION['lang']; ?>/admin/categories">
                        Edit categories
                    </a>
                </li>

                <li>
                    <a href="<?php echo URL . $_SESSION['lang']; ?>/admin/presentations">
                        Edit presentations
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

                <li>
                    <a href="<?php echo URL . $_SESSION['lang']; ?>">
                        To home page
                    </a>
                </li>
            </ul>
        </div>
    </div>