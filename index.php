<?php

$db = new PDO('mysql:host=localhost;'.'dbname=agencia_viajes;charset=utf8', 'root', '');
$query_aerolinea = $db->prepare("SELECT * FROM aerolinea");
$query_aerolinea->execute();

$aerolineas = $query_aerolinea->fetchAll(PDO::FETCH_OBJ);

?>

<h2>Lista de Aerolineas (CATEGORIA)</h2>

<?php

foreach($aerolineas as $aerolinea) {
    echo "Id: " . $aerolinea->Id_aerolinea . "; Nombre: " . $aerolinea->Nombre . "; Pais: " . $aerolinea->Pais;
    echo "<br>";
}
?>

<?php

$db = new PDO('mysql:host=localhost;'.'dbname=agencia_viajes;charset=utf8', 'root', '');
$query_persona = $db->prepare("SELECT * FROM persona");
$query_persona->execute();

$personas = $query_persona->fetchAll(PDO::FETCH_OBJ);

?>

<h2>Lista de Personas (ITEMS) </h2>

<?php

foreach($personas as $persona) {
    echo "Id: " . $persona->id . "; Nombre: " . $persona->Nombre . "; Cantidad: " . $persona->Cantidad . "; id aerolinea: " . $persona->Id_aerolinea . "; destino: " . $persona->Destino;
    echo "<br>";
}
?>