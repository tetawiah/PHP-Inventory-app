<?php

$router->get('/','controllers/index.php')->only('auth');
$router->post('/search','controllers/index.php')->only('auth');
$router->get('/search','controllers/index.php')->only('auth');


$router->post('/create','controllers/create.php')->only('auth');
$router->delete('/delete','controllers/destroy.php')->only('auth');
$router->get('/edit','controllers/edit.php')->only('auth');
$router->patch('/update','controllers/update.php')->only('auth');

$router->get('/api/readapi','api/readapi.php');
$router->get('/api/updateapi','api/updateapi.php');


$router->get('/register', 'controllers/user/register.php')->only('guest');
$router->post('/register','controllers/user/store.php')->only('guest');

$router->get('/login','controllers/user/login.php')->only('guest');
$router->post('/login','controllers/user/log.php')->only('guest');

$router->get('/logout','controllers/user/logout.php')->only('auth');

$router->get('/reset','controllers/user/reset.php')->only('guest');
$router->post('/reset','controllers/user/setpass.php')->only('guest');