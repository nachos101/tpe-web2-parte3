<?php
    require_once 'libs/router/router.php';
    require_once 'app/controllers/serie_api_controller.php';

    $router = new Router();

    //endpoints
    $router->addRoute('series','GET','SerieApiController','getSeries');
    $router->addRoute('series/:id','GET','SerieApiController','getSerieByID');
    $router->addRoute('series/:id','DELETE','SerieApiController','deleteSerie');
    $router->addRoute('series/:id','PUT','SerieApiController','editSerie');
    $router->addRoute('series','POST','SerieApiController','addSerie');

    //ruteo
    $router->route($_GET['resource'],$_SERVER['REQUEST_METHOD']);
?>
