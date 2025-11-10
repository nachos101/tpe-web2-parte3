<?php
    require_once './app/models/serie_model.php';
    require_once './app/views/api_view.php';
    class SerieApiController{
        private $model;
        private $view;

        function __construct(){
            $this->model = new ModelSerie();
            $this->view = new ApiView();
        }

        public function getSeries($req, $res){
            if (isset($req->query->orden) && isset($req->query->atributo)){
                $orden = $req->query->orden;
                $atributo = $req->query->atributo;
                $series = getByOrder($orden,$atributo);
                    return $this->view->response($series,200);
                
            }
            else {
                $series = $this->model->getSeries();
                return $this->view->response($series,200);
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
    }
?>