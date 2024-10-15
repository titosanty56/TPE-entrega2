<?php
$db = new PDO('mysql:host=localhost;'.'dbname=agencia_viajes;charset=utf8', 'root', '');
$query_persona = $db->prepare("SELECT * FROM persona WHERE Id_aerolinea = '3'");
$query_persona->execute();

$personas = $query_persona->fetchAll(PDO::FETCH_OBJ);

?>

<h2> QATAR AIRWAYS </h2>

<?php

foreach($personas as $persona) {
    echo "Id: " . $persona->id . "; Nombre: " . $persona->Nombre . "; Cantidad: " . $persona->Cantidad . "; id aerolinea: " . $persona->Id_aerolinea . "; destino: " . $persona->Destino;
    echo "<br>";
}
?>