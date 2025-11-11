<?php
    require_once './libs/router/router.php';
    require_once './app/controllers/serie_api_controller.php';
    require_once './libs/jwt/jwt.middleware.php';
    require_once './app/middlewares/guard-api.middleware.php';
    require_once './app/controllers/auth-api.controller.php';

    $router = new Router();
    $router->addRoute('auth/login',     'GET',     'AuthApiController',    'login');


    $router->addMiddleware(new JWTMiddleware());
    //endpoints
    $router->addRoute('series','GET','SerieApiController','getSeries');
    $router->addRoute('series/:id','GET','SerieApiController','getSerieByID');
    $router->addMiddleware(new GuardMiddleware());
    $router->addRoute('series/:id','DELETE','SerieApiController','deleteSerie');
    $router->addRoute('series/:id','PUT','SerieApiController','editSerie');
    $router->addRoute('series','POST','SerieApiController','addSerie');

    //ruteo
    $router->route($_GET['resource'],$_SERVER['REQUEST_METHOD']);
?>
