<?php
    require_once './app/models/series.model.php';
    require_once './app/views/api_view.php';
    class SerieApiController{
        private $model;
        private $view;

        function __construct(){
            $this->model = new SeriesModel();
            $this->view = new ApiView();
        }

        public function getSeries($req, $res){
            $filtro = [];
            $parametros = $req->query;
            foreach ($parametros as $key => $valor) {
                if ($key !== 'orden' && $key !== 'atributo'){
                    $filtro[$key] = $valor;
                }
            }

            if (!empty($filtro)){
                $series = $this->filtrarSeries($filtro);
            } else {
                $series = $this->model->getSeries();
            }

            if (isset($req->query->orden) && isset($req->query->atributo)){
                //en caso de venir con mayusculas se transforma a min para evitar errores
                $orden = strtolower($req->query->orden);
                $atributo = strtolower($req->query->atributo);
                $series = $this->getByOrder($series,$orden,$atributo);
                    return $res->json($series,200);
            }
            else {
                return $res->json($series,200);
            }
        }

        private function filtrarSeries($filtros){
            $series = $this->model->getSeries();
            $seriesFiltradas = [];
            $columnas = [
                'titulo' => 'titulo', 
                'cant_temporadas' => 'cantidad_temporadas',
                'genero' => 'genero',
                'fecha_estreno' => 'fecha_estreno'];
    
            foreach ($series as $serie) {
                $coincide = false;
        
            foreach ($filtros as $parametro => $valorBuscado) {
                $parametro = strtolower($parametro);
                $valorBuscado = strtolower($valorBuscado);
            
                $columna = isset($columnas[$parametro]) ? $columnas[$parametro] : $parametro;
            
                if (property_exists($serie, $columna) || isset($serie->$columna)) {
                    $valorSerie = $serie->$columna;
                
                    $valorSerieStr = strtolower(strval($valorSerie));
                
                if (is_numeric($valorSerie) && is_numeric($valorBuscado)) {
                    
                    if ($valorSerie == $valorBuscado) {
                        $coincide = true;
                        break; 
                    }
                } else {
                    
                    if (strpos($valorSerieStr, $valorBuscado) !== false) {
                        $coincide = true;
                        break; 
                    }
                }
            }
        }
        
        if ($coincide) {
            $seriesFiltradas[] = $serie;
        }
    }
    
    return $seriesFiltradas;
                        
        }

        private function getByOrder($series,$orden,$atributo){
            //$series = $this->model->getSeries();

            if ($orden == 'asc') {                    
                    $order = SORT_ASC;
                }
                else if ($orden == 'desc'){
                    $order = SORT_DESC;
                }
            if ($atributo == 'titulo' || $atributo == 'genero' || $atributo == 'cant_temporadas' || $atributo == 'fecha_estreno'){
              $aux = array_column($series, $atributo);
              array_multisort($aux, $order, $series);
              return $series;
            }
            else {
                return $res->json("Error, no existe la serie",404);
            }
        }

        // /api/series/:ID
        public function getSerieByID ($req, $res){
            //obtengo el ID desde la ruta
            $id = $req->params->id;

            //obtengo la serie de la db
            $serie = $this->model->getSerie($id);

            if (!$serie){
                return $res->json("Ups! La serie que buscas no existe ):", 404);
            }
            return $res->json($serie,200);
        }

        //POST /api/serie
        public function addSerie ($req, $res){
            if (empty($req->body->titulo) ||
                empty($req->body->genero) ||
                empty($req->body->cant_temporadas) ||
                empty($req->body->sinopsis) ||
                empty($req->body->clasificación) ||
                empty($req->body->fecha_estreno) ||
                empty($req->body->img)){

                //algun campo no tiene datos
                return $res->json('Error! x.x Faltan campos obligatorios', 400);
            }
            //obtengo los datos del body del $req
            $title = $req->body->titulo;
            $genre = $req->body->genero;
            $seasons = $req->body->cant_temporadas;
            $synopsis = $req->body->sinopsis;
            $ageR = $req->body->clasificación;
            $releaseDate = $req->body->fecha_estreno;
            $img = $req->body->img;

            //pido al model que la inserte
            $serie = $this->model->insertSerie($title, $genre, $seasons, $synopsis, $ageR, $releaseDate, $img);

            if (!$serie){
                return $res->json('Error! x.x no se pudo insertar la tarea', 500);
            }

            //la devuelvo junto con un mensaje que confirme el exito del post
            return $res->json("La serie con el id= $serie fue agregada con exito.", 201);
        }

        /* {
            "titulo" :
            "genero" :
            "cant_temporadas" :
            "sinopsis" :
            "clasificación" :
            "fecha_estreno" :
            "img" :
            } */

        //PUT
        public function editSerie($req, $res){
            $id = $req->params->id;
            if (empty($id)){
                return $res->json("no existe la serie",404);
            }
            if (!isset($req->body)){
                return $res->json("no existe el req",404);
            }
            $serie = $this->model->getSerie($id);
            if (!$serie){
                return $res->json("no existe la serie",404);
            }
                
            if(empty($req->body->titulo) || empty($req->body->genero) || empty($req->body->cant_temporadas)
                || empty($req->body->sinopsis) || empty($req->body->clasificacion) || empty($req->body->fecha_estreno)
            || empty($req->body->img)){
                return $res->json("hay algun/nos parametro/s vacio/s",404);
            }
            
            $titulo = $req->body->titulo;
            $genero = $req->body->genero;
            $cantTemporadas = $req->body->cant_temporadas;
            $sinopsis = $req->body->sinopsis;
            $clasificacion = $req->body->clasificacion;
            $fechaEstreno = $req->body->fecha_estreno;
            $img = $req->body->img;

            $this->model->updateSerie($id,$titulo,$genero,$cantTemporadas,$sinopsis,$clasificacion,$fechaEstreno,$img);
            $serieActualizada = $this->model->getSerie($id);
            return $res->json($serieActualizada,200);
        }

    }
?>