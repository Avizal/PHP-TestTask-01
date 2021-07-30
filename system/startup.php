<?php

if (is_file(DIR_CLASS . 'registry.php')) {
	require_once(DIR_CLASS . 'registry.php');
} else {
    exit('Not exist file registry.php');
}

if (is_file(DIR_CLASS . 'db.php')) {
	require_once(DIR_CLASS . 'db.php');
} else {
    exit('Not exist file db.php');
}

if (is_file(DIR_CLASS . 'response.php')) {
	require_once(DIR_CLASS . 'response.php');
} else {
    exit('Not exist file response.php');
}

if (is_file(DIR_CLASS . 'view.php')) {
	require_once(DIR_CLASS . 'view.php');
} else {
    exit('Not exist file view.php');
}

if (is_file(DIR_CLASS . 'controller.php')) {
	require_once(DIR_CLASS . 'controller.php');
} else {
    exit('Not exist file controller.php');
}

if (is_file(DIR_CLASS . 'routing.php')) {
	require_once(DIR_CLASS . 'routing.php');
} else {
    exit('Not exist file routing.php');
}

$registry = new Registry();

$db = new DB(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
$registry->set('db', $db);

$response = new Response($registry);
$registry->set('response', $response);

$view = new View($registry);
$registry->set('view', $view);

$controller = new Controller($registry);
$registry->set('controller', $controller);

$routing = new Routing($registry);
$registry->set('routing', $routing);

$request = (isset($_REQUEST['route'])) ? $_REQUEST['route'] : 'category';

$routing->dispatch($request);

$response->output();