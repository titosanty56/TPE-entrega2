<?php
class aerolineasView {

    public function showAerolineas($aerolineas) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($aerolineas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require './templates/index.phtml';
    }

    public function showDetailAerolinea($aerolinea, $personas) {

        require './templates/detail_aerolinea.phtml';
    }

}
?>