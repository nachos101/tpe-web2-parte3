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
            if (isset($req->query->orden) && isset($req->query->atributo)){
                $orden = $req->query->orden;
                $atributo = $req->query->atributo;
                $series = $this->getByOrder($orden,$atributo);
                    return $res->json($series,200);
            }
            else {
                $series = $this->model->getSeries();
                return $res->json($series,200);
            }
        }
        private function getByOrder($orden,$atributo){
            $series = $this->model->getSeries();

            if ($orden == 'asc') {                    
                    $order = SORT_ASC;
                }
                else if ($orden == 'dsc'){
                    $order = SORT_DESC;
                }
            if ($atributo == 'titulo' || $atributo == 'genero' || $atributo == 'cant_temporadas' || $atributo == 'fecha_estreno'){
              $aux = array_column($series, $atributo);
              array_multisort($aux, $order, $series);
              return $series;
            }
            else {
                return null;
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
            if (!$req->body->titulo ||
                !$req->body->genero ||
                !$req->body->cant_temporadas ||
                !$req->body->sinopsis ||
                !$req->body->clasificación ||
                !$req->body->fecha_estreno ||
                !$req->body->img){

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
            return $res->json($serieActualizada,201);
        }

    }
?>