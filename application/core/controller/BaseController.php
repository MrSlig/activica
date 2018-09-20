<?php

class BaseController {
    function render($path, $data = []) {
        extract($data);
        ob_start();
        require VIEW_PATH . $path . '.php';
        return ob_get_clean();
    }
}
/*
function getView($name) {
    if (isset($name) &&
        file_exists(VIEW_PATH . $name . '.php')) {
        return $name;
    } else {
        return '404';
    }
}
*/