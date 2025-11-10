<?php
    require_once './models/serie_model.php';
    require_once './views/api_view.php';
    class SerieApiController{
        private $model;
        private $view;

        function __construct(){
            $this->model = new ModelSerie();
            $this->view = new ApiView();
        }

    }
?>