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

            $orden = null;
            $atributo = null;

            $filters = null;
        
            $offset = null;
            $limit = null;
            //filtrado
            if (!empty(((array)$req->query))){
                $filters =  (array)$req->query;
                if (!empty($filters)){
                    $series = $this->model->getSeries($filters);
                    if (empty($series)){
                        $res->json("Ups! No tenemos series que coincidan con tu busqueda ):", 404);
                    }
                }
            } 
            
            //ordenamiento
            if (isset($req->query->orden) && isset($req->query->atributo)){
                //en caso de venir con mayusculas se transforma a min para evitar errores
                $orden = strtolower($req->query->orden);
                $atributo = strtolower($req->query->atributo); 
                if ($atributo == 'titulo' || $atributo == 'genero' || $atributo == 'genero' || $atributo == 'cant_temporadas'){
                    if ($orden == 'asc' || $orden == 'desc'){    
                    $series = $this->model->getSeries([],$orden,$atributo);
                    }
                    else {
                        $res->json("No se espeficia ASC o DESC", 404);        
                    }
                }
            }

            //paginado
            if (isset($req->query->offset) && isset($req->query->limit)){
                if (is_numeric($req->query->offset) && is_numeric($req->query->limit)){
                    $offset = $req->query->offset;
                    $limit = $req->query->limit;
                    $series = $this->model->getSeries([],'','',$offset,$limit);
                } else {
                    $res->json("los valores no son numericos", 404);
                }
            }
            $series = $this->model->getSeries($filters,$orden,$atributo);
            return $res->json($series,200);
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