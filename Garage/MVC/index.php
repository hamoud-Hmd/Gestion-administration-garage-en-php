<?php

use Classes\Router;

session_start();
require_once('classes/Autoloader.php');
include_once('classes/Router.php');

var_dump($_SESSION);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Site dynamique en POO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"/>
    <link href="component/css/mystyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<main>
    <?php require('views/nav_bar.php') ?>
    <div id="mainContainer" class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
        <?php
        $router = new Router();
        print $router->controllerReturn((isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '');
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>
