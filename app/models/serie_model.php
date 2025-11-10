<?php
    require_once './app/models/model.php';

    class ModelSerie extends Model{
        function __construct(){
            parent::__construct();
        }

            function getSeries (){
        //preparo y ejecuto la consulta.
        $query = $this->db->prepare('SELECT * FROM series');
        $query->execute();
        $series = $query->fetchAll(PDO::FETCH_OBJ);

        return $series;
    }
    }







?>