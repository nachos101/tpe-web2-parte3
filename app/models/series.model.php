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

    function getSerieByGenre ($genre){
        $query = $this->db->prepare('SELECT * FROM series WHERE genero LIKE ?');
        $query->execute(['%'.$genre.'%']);
        $serie = $query->fetch(PDO::FETCH_OBJ);
        
        return $serie;
    }

    function insertSerie ($title, $genre, $seasons, $synopsis, $ageR, $date, $img){
        $query = $this->db->prepare('INSERT INTO `series` (`titulo`, `genero`, `cant_temporadas`, `sinopsis`, `clasificación`, `fecha_estreno` ,`img`)
                VALUES (?,?,?,?,?,?,?)');
        $query->execute([$title, $genre, $seasons, $synopsis, $ageR, $date, $img]);
                
        //pido el id del ultimo insert para poder devolverlo
        $id = $this->db->lastInsertId();

        return $id;
    }

        function updateSerie ($id,$title, $genre, $seasons, $synopsis, $ageR, $fecha, $img){
            $query = $this->db->prepare('UPDATE `series` SET titulo = ?, genero = ?, cant_temporadas = ?, sinopsis = ?, clasificacion = ?, fecha_estreno = ?, img = ? WHERE id_serie = ?');
            $query->execute([$title, $genre, $seasons, $synopsis, $ageR, $fecha, $img,$id]);
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
           
    function getSeries($filters = [], $orden = '', $atributo = '', $offset = '', $limit = ''){

        $params = [];
        $sql = "SELECT * FROM series ";
        
        // filtro
        foreach ($filters as $filter => $value) {
            if ($filter == 'genero' ||
                $filter == 'titulo' ||
                $filter == 'clasificación'){
            
                if (empty ($params)){
                    if ($filter == 'clasificación') {
                        $sql .= "WHERE clasificación >= ?";
                        $params[] = $value;
                    }

                    $sql.= "WHERE $filter LIKE ?";
                    $params[] = '%' . $value . '%';
                }

                if ($filter == 'clasificación'){
                    $sql.= " AND $filter >= ?";
                    $params[] = '%' . $value . '%';
                }

                $sql.= " AND $filter LIKE ?";
                $params[] = '%' . $value . '%';

            }    
        }
        
        // agregar orden
        if ($orden != null && $atributo != null){
            $sql.= " ORDER BY $atributo $orden";
        }

        // paginado 
        if ($limit != null && $limit > 0 && $offset != null){
            $sql.= " LIMIT $limit Offset $offset";
        }
        
        
        $query = $this->db->prepare($sql);

        $query->execute($params);

        $series = $query->fetchAll(PDO::FETCH_OBJ);
                
        return $series;
    }

}