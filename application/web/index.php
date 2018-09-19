<?php

require_once __DIR__ . '/../core/modules.php';

session_start();
$router     =   new Router();
$content    =   $router->run();


if (is_string($content)) {
    require VIEW_PATH . 'include/content.php';
} else {
    echo json_encode($content);
}