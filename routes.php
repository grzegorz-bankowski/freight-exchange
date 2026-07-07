<?php

$router->get('/', 'app/Controllers/index.php');
$router->get('/register', 'app/controllers/register.php');
$router->post('/register', 'app/controllers/register.php');
$router->get('/forgot-password', 'app/controllers/forgot-password.php');
$router->post('/forgot-password', 'app/controllers/forgot-password.php');
$router->get('/reset-password', 'app/controllers/reset-password.php');
$router->post('/reset-password', 'app/controllers/reset-password.php');
$router->get('/add-load', 'app/controllers/add-load.php');
$router->post('/add-load', 'app/controllers/add-load.php');
$router->get('/add-vehicle', 'app/controllers/add-vehicle.php');
$router->post('/add-vehicle', 'app/controllers/add-vehicle.php');
$router->get('/find-load', 'app/controllers/find-load.php');
$router->get('/find-vehicle', 'app/controllers/find-vehicle.php');
$router->get('/load', 'app/controllers/load.php');
$router->get('/vehicle', 'app/controllers/vehicle.php');
$router->get('/orders', 'app/controllers/orders.php');
$router->post('/orders', 'app/controllers/orders.php');
$router->get('/offers', 'app/controllers/offers.php');
$router->post('/offers', 'app/controllers/offers.php');
$router->get('/profile', 'app/controllers/profile.php');
$router->get('/settings', 'app/controllers/settings.php');
$router->get('/logout', 'app/controllers/logout.php');
