<?php
class personasViews {
public $user;

    public function showPersonas($personas) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($personas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require './templates/index.phtml';
    }
    public function showPersonasId($personas) {

        require './templates/detail_aerolinea.phtml';
    }
    public function showDetailPersona($persona){
        require './templates/detail_persona.phtml';
    }

}
?>