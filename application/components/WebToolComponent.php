<?php
class WebToolComponent
{
    public function WebToolComponent()
    {

    }


    public function trimController($controllerClass)
    {
        $controllerClass = str_replace('Controller', '', $controllerClass);
        $controllerClass = strtolower($controllerClass);
        return $controllerClass;
    }

    public function trimAction($actionName)
    {
        $actionName = str_replace('action', '', $actionName);
        $actionName = strtolower($actionName);
        return $actionName;
    }
}