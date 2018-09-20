<?php

abstract class BaseRouter {

    abstract public function getControllerName();
    abstract public function getActionName();

    public function run() {
        include_once __DIR__ . '/../controller/' .
            $this->getControllerName() . '.php';
        $controllerName = $this->getControllerName();
        $controller = new $controllerName;
        if (!method_exists($controller, $this->getActionName())) {
            return render('404');
        } else {
            return $controller->{$this->getActionName()}();
        }
    }
}