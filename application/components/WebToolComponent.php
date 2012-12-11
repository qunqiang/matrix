<?php
class WebToolComponent
{
    public function WebToolComponent()
    {

    }


    public function trimController($controllerClass)
    {
        $controllerClass = trim($controllerClass, 'Controller');
        $controllerClass = strtolower($controllerClass);
        return $controllerClass;
    }

    public function trimAction($actionName)
    {
        $actionName = trim($actionName, 'action');
        $actionName = strtolower($actionName);
        return $actionName;
    }
}