<?php
namespace Controllers;
use MVC\Router;

class PageController {
    public static function error(Router $router) {
        $router->render('notFound/error');
    }
}