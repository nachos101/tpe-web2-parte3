<?php 

require_once './app/models/model.php';

class SeriesModel extends Model{
    
    function __construct() {
        //abro conexion con la db
        parent::__construct();
    }

    function getSerie ($id){
        
        $query = $this->db->prepare('SELECT * FROM series WHERE id_serie=?');
        
        $query->execute([$id]);
        $serie = $query->fetch(PDO::FETCH_OBJ);
        
        return $serie;

    }

    function getSeries (){
        //preparo y ejecuto la consulta.
        $query = $this->db->prepare('SELECT * FROM series');
        $query->execute();
        $series = $query->fetchAll(PDO::FETCH_OBJ);

        return $series;
    }

    function getSerieByGenre ($genre){
        $query = $this->db->prepare('SELECT * FROM series WHERE genero LIKE ?');
        $query->execute(['%'.$genre.'%']);
        $serie = $query->fetch(PDO::FETCH_OBJ);
        
        return $serie;
    }

        function insertSerie ($title, $genre, $seasons, $synopsis, $ageR, $img){
        $query = $this->db->prepare('INSERT INTO `series` (`titulo`, `genero`, `cant_temporadas`, `sinopsis`, `clasificación`, `img`)
                VALUES (?,?,?,?,?.?)');
        $query->execute([$title, $genre, $seasons, $synopsis, $ageR, $img]);
    }

    function updateSerie ($id,$title, $genre, $seasons, $synopsis, $ageR, $img){
        $query = $this->db->prepare('UPDATE `series` SET titulo = ?, genero = ?, cant_temporadas = ?, sinopsis = ?, clasificación = ?, img = ? WHERE id_serie = ?');
        $query->execute([$title, $genre, $seasons, $synopsis, $ageR, $img,$id]);
    }


    function deleteSerie ($id){
        $query = $this->db->prepare('DELETE FROM `series` WHERE id_serie=?');
        $query->execute([$id]);
    }

    function getSerieByName ($name){
        $query = $this->db->prepare('SELECT * FROM series WHERE titulo LIKE ?');
        $query->execute(['%'.$name.'%']);
        $serie = $query->fetch(PDO::FETCH_OBJ);
        
        return $serie;
    }

}