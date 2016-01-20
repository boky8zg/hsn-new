<?php
/* Constants */
    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'])); // Server root folder
    define('HOST', $_SERVER['HTTP_HOST']);      // Server HTTP root address
    define('REQUEST', $_SERVER['REQUEST_URI']); // Request URI
    define('MODELS_PATH', '_models');
    define('VIEWS_PATH', '_views');
    define('CONTROLLERS_PATH', '_controllers');
    define('PUBLIC_PATH', 'public');

/* Includes */
    include('format.php');
    include('route.php');
    include('connection.php');
    include('model.php');
    include('view.php');
    include('controller.php');
?>