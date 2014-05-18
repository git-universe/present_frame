<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP MVC skeleton</title>
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
<!-- header -->
<div class="container">
    <!-- navigation -->
    <h3>Demo Navigation</h3>
    <div class="navigation">
        <ul>
            <!-- same like "home" or "home/index" -->
            <li><a href="<?php echo URL; ?>"><?php echo URL; ?>home</a></li>
            <li><a href="<?php echo URL; ?>home/exampleone"><?php echo URL; ?>home/exampleone</a></li>
            <li><a href="<?php echo URL; ?>home/exampletwo"><?php echo URL; ?>home/exampletwo</a></li>
            <!-- "songs" and "songs/index" are the same -->
            <li><a href="<?php echo URL; ?>songs/"><?php echo URL; ?>songs/index</a></li>
        </ul>
    </div>
</div>