<?php

/**
 * Initialize app, DI, config and another dependencies
 */
require 'src/bootstrap.php';

/**
 * Routes
 */
require 'src/Routes/api.php';
require 'src/Routes/web.php';

$app->run();
