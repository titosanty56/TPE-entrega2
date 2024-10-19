<?php
    require_once './app/models/personas.models.php';
    require_once './app/views/personas.views.php';

class personasControllers{
    private $models;
    private $views;

    public function __construct($res) {
        $this->models = new personasModels(); // Inicializa la propiedad con una instancia de personasModel
        $this->views = new personasViews($res->user); // Asegúrate de inicializar también la vista si es necesario
    }

    public function showListarPersonas(){
        $personas = $this->models->getPersonas();
        return $this->views->showListPersonas($personas);
    }

    public function getpersonas(){
        $personas = $this->models->getPersonas();
        return $personas;
    }

    public function getPersona($id_persona){
        $personas = $this->models->getPersona($id_persona);
        return $personas;
    }


    public function showPersonas(){
        $personas = $this->models->getpersonas();
        return $this->views->showPersonas($personas);
    }

    public function showPersonasid($id_persona){
        $personas = $this->models->getPersonasId($id_persona);
        return $personas;
    }
    

    public function showPersonaDetails($id_persona, $aerolinea) {
        $persona = $this->models->getPersona($id_persona);
        $nombre_aerolinea = $aerolinea->Nombre;
        if ($persona) {
            return $this->views->showdetailPersona($persona, $nombre_aerolinea);
        } else {
            return $this->views->showError("La persona con el ID=$id_persona no existe.");
        }
    }

    public function listaaddPersona($modelsAero) {
        $personas = $this->models->getAllPersonas();
        $aerolineas = $modelsAero; 
        $this->views->showListaPersonas($personas, $aerolineas); 
    }

    public function addPersona() {
        if (!isset($_POST['Nombre']) || empty($_POST['Nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['id_aerolinea']) || empty($_POST['id_aerolinea'])) {
            return $this->views->showError('Falta completar la aerolinea');
        }
    
        if (!isset($_POST['edad']) || empty($_POST['edad'])) {
            return $this->views->showError('Falta completar la edad');
        }
    
        if (!isset($_POST['Destino']) || empty($_POST['Destino'])) {
            return $this->views->showError('Falta completar el Destino');
        }

        if (!isset($_POST['Cantidad']) || empty($_POST['Cantidad'])) {
            return $this->views->showError('Falta completar la cantidad de pasajes');
        }
    
    
        $nombre = $_POST['nombre'];
        $id_aerolinea = $_POST['id_aerolinea']; 
        $edad = $_POST['edad']; 
        $destino = $_POST['Destino']; 
        $cantidad = $_POST['Cantidad']; 
    
        
        $aerolinea = $this->models->getAllPersonas($id_aerolinea);

        if (!$aerolinea) {
            return $this->view->showError('El ID de la aerolinea no existe actualmente');
        }

    
        $id = $this->models->insertPersona($nombre, $id_aerolinea, $edad, $destino, $cantidad);
    
        header('Location: ' . 'showAddPersona/');
    }

    public function deletePerson($id){
        $persona = $this->models->getPersona($id_persona);
        if (!$persona) {
            return $this->views->showError("No existe la tarea con el id=$id_persona");
        }

        $this->models->erasePerson($id_persona);

        header('Location: ' . BASE_URL . 'showAddPersona/');
    }

    public function showEditPersona($id_persona, $aerolineas) {
        $persona = $this->models->getPersona($id_persona);
        if ($persona) {
            return $this->views->showEditPersona($persona, $aerolineas);
        } else {
            return $this->views->showError("La aerolinea con el ID=$id no existe.");
        }
    }
    
    public function editPersona($id_persona) {
        if (!isset($_POST['Nombre']) || empty($_POST['Nombre'])) {
            return $this->views->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['id_aerolinea']) || empty($_POST['id_aerolinea'])) {
            return $this->views->showError('Falta completar la aerolinea');
        }
    
        if (!isset($_POST['edad']) || empty($_POST['edad'])) {
            return $this->views->showError('Falta completar la edad');
        }
    
        if (!isset($_POST['Destino']) || empty($_POST['Destino'])) {
            return $this->views->showError('Falta completar el Destino');
        }

        if (!isset($_POST['Cantidad']) || empty($_POST['Cantidad'])) {
            return $this->views->showError('Falta completar la cantidad de pasajes');
        }
    
        $nombre = $_POST['nombre'];
        $id_aerolinea = $_POST['id_aerolinea']; 
        $edad = $_POST['edad']; 
        $destino = $_POST['Destino']; 
        $cantidad = $_POST['Cantidad']; 
    
        $this->models->updatePersona($nombre, $id_aerolinea, $edad, $destino, $cantidad);
    
        header('Location: ' . BASE_URL . 'showAddPersona/');
    }
}