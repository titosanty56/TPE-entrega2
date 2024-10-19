<?php
    require_once './app/models/aerolinea.models.php';
    require_once './app/views/aerolinea.views.php';

class aerolineasControllers{
    private $models;
    private $views;

    public function __construct($res) {
        $this->models = new aerolineasModels(); // Inicializa la propiedad con una instancia de fabricaModel
        $this->view = new aerolineasView($res->user); // Asegúrate de inicializar también la vista si es necesario
    }


    public function showAerolineas(){
        $aerolineas = $this->models->getAerolineas();
        return $this->view->showAerolineas($aerolineas);
    }

    public function showListarAerolineas($models){
        $models = $models->getpersonas();
        $aerolineas = $this->models->getAerolineas();
        return $this->view->showListarAerolineas($aerolineas, $models);
    }

    public function showAerolineaDetails($id, $personas) {
        $aerolinea = $this->models->getAerolinea($id);
        if ($aerolinea) {
            return $this->view->showdetailAerolinea($aerolinea, $personas);
        }
    }

    public function showAerolineasid($id_aerolineas){
        $aerolinea = $this->models->getAerolineasId($id_aerolineas);
        return $aerolinea;
    }

    public function addAero(){
        if (!isset($_POST['Nombre']) || empty($_POST['Nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['Pais']) || empty($_POST['Pais'])) {
            return $this->views->showError('Falta completar el pais');
        }

        if (!isset($_POST['Fundacion']) || empty($_POST['Fundacion'])) {
            return $this->views->showError('Falta completar la fecha de fundacion de la empresa');
        }

        if (!isset($_POST['servicios']) || empty($_POST['servicios'])) {
            return $this->views->showError('Falta completar los servicios');
        }
    
        $nombre = $_POST['Nombre'];
        $pais = $_POST['Pais'];
        $fundacion = $_POST['Fundacion'];
        $servicios = $_POST['servicios'];
    
        $id = $this->models->insertAerolinea($nombre, $pais, $fundacion, $servicios);
       
    
        // redirijo al showAddFabrica (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . 'showAddAerolinea/');
    }

    public function ListaaddAero(){
        $aerolineas = $this->models->getAllAerolineas();
        $this->views->showListarAerolineas($aerolineas);
    }

    public function deleteAero($id){
        // obtengo la tarea por id
        $aerolinea = $this->models->getAerolinea($id);

        if (!$aerolinea) {
            return $this->views->showError("No existe la tarea con el id=$id");
        }

        // borro la tarea y redirijo
        $this->models->eraseAero($id);


        header('Location: ' . BASE_URL . 'showAddAerolinea/');

    }

    public function showEditAerolinea($id) {
        $aerolinea = $this->models->getAerolinea($id);
        if ($aerolinea) {
            return $this->views->showEditAerolinea($aerolinea);
        } else {
            return $this->views->showError("La aerolinea con el ID=$id no existe.");
        }
    }
    
    public function editAero($id) {
        if (!isset($_POST['Nombre']) || empty($_POST['Nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['Pais']) || empty($_POST['Pais'])) {
            return $this->views->showError('Falta completar el pais');
        }

        if (!isset($_POST['Fundacion']) || empty($_POST['Fundacion'])) {
            return $this->views->showError('Falta completar la fecha de fundacion de la empresa');
        }

        if (!isset($_POST['servicios']) || empty($_POST['servicios'])) {
            return $this->views->showError('Falta completar los servicios');
        }

        $nombre = $_POST['Nombre'];
        $pais = $_POST['Pais'];
        $fundacion = $_POST['Fundacion'];
        $servicios = $_POST['servicios'];
    
        $this->models->updateAerolinea($id, $nombre, $pais, $fundacion, $servicios);
    
        header('Location: ' . BASE_URL . 'showAddAerolinea/');
    }

}