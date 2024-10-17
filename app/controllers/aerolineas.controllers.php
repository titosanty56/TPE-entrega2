<?php
    //traigo los datos del aerolinea.models
    require_once './app/models/aerolinea.models.php';
    require_once './app/views/aerolinea.views.php';

    class aerolineasControllers{
        private $models;
        private $view;

        public function __construct(){
            // Inicializa la propiedad con una instancia de aerolineaModel
            $this->models= new aerolineaModel();
            // Asegúrate de inicializar también la vista si es necesario
            $this->view= new aerolineasView();
        }

        //muestra todas las erolineas
        public function showAerolineas(){
            $aerolineas= $this->models->getAerolineas();
            return $this->view->showAerolineas($aerolineas);
        }

        public function showAerolineaDetails($id, $personas){
            $aerolinea= $this->models->getAerolinea($id);
            return $this->view->showDetailAerolinea($aerolinea, $personas);
        }

    }
