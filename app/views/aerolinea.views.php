<?php
class aerolineasView {
    private $db;

    public $user = null;
    
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function showAerolineas($aerolineas) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($aerolineas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require './templates/listasaero.phtml';
    }

    public function showListarAerolineas($aerolineas, $personas) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($aerolineas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require './templates/lista.phtml';
    }

    public function showdetailAerolinea($aerolinea, $models) {
        
        require './templates/detail_aerolinea.phtml';
    }

    public function showError($error) {
        require './templates/error.phtml';
    }
    
    public function showListaAerolineas($aerolineas) {
        require './templates/lista_aerolinea.phtml';
    }

    public function showEditAerolinea($aerolinea) {
        // Aca se carga una plantilla que incluye el formulario para editar una aerolinea
        require './templates/edit_aerolinea.phtml';
    }

    
}
?>