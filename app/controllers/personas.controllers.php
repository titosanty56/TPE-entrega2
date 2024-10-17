<?php
    //traigo los datos del aerolinea.models
    require_once './app/models/personas.models.php';
    require_once './app/views/personas.views.php';

    class personasControllers{
        private $models;
        private $view;

        public function __construct(){
            // Inicializa la propiedad con una instancia de aerolineaModel
            $this->models= new personasModel();
            // Asegúrate de inicializar también la vista si es necesario
            $this->view= new personasView();
        }

        //muestra todas las personas
        public function showPersonas(){
            $personas= $this->models->getPersonas();
            return $this->view->showPersonas($personas);
        }

        public function showPersonasId($id_aerolinea){
            $personas= $this->models->getPersonasId($id_aerolinea);
            return $personas;
        }

        public function showPersonaDetails($id_persona){
            $persona= $this->models->getPersona($id_persona);
            return $this->view->showDetailPersona($persona);
        }

    }