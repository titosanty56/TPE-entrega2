<?php

    class aerolineasModels{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=agencia_viajes;charset=utf8', 'root', '');
        }

        public function getAerolineas(){
            //Ejecuto la consulta
            $query = $this->db->prepare('SELECT * FROM aerolinea');
            $query->execute();

            //Obtengo los datos en un arreglo de objetos
            $aerolineas = $query->fetchAll(PDO::FETCH_OBJ); 
    
            return $aerolineas;
        }

        public function getAerolinea($id) {
            $query = $this->db->prepare('SELECT * FROM aerolinea WHERE id = ?');
            $query->execute([$id]);

            $aerolinea = $query->fetch(PDO::FETCH_OBJ); 
            
            return $aerolinea;
        }

        public function insertAerolinea($nombre, $pais, $fundacion, $servicios){

            $query = $this->db->prepare('INSERT INTO aerolinea(Nombre, Pais, Fundacion, servicios) VALUES (?, ?, ?, ?)');
            $query->execute([$nombre, $pais, $fundacion, $servicios]);
        
            $id = $this->db->lastInsertId();
        
            return $id;
    
        }

        public function getAerolineasId($id) {
            $query = $this->db->prepare('SELECT * FROM aerolinea WHERE id = ?');
            $query->execute([$id]);

            $aerolinea = $query->fetch(PDO::FETCH_OBJ); 
            
            return $aerolinea;
        }

        public function getAllAerolineas(){
            $query = $this->db->prepare('SELECT * FROM aerolinea');
            $query->execute();

            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function eraseAero($id) {
            $deleteModelsQuery = $this->db->prepare('DELETE FROM persona WHERE id_aerolinea = ?');
            $deleteModelsQuery->execute([$id]);
        
            $query = $this->db->prepare('DELETE FROM aerolinea WHERE id = ?');
            $query->execute([$id]);
        }

        public function updateAerolinea($id, $nombre, $pais, $fundacion, $servicios) {
            $query = $this->db->prepare('UPDATE aerolinea SET Nombre = ?, Pais = ?, Fundacion = ?, servicios = ? WHERE id = ?');
            $query->execute([$id, $nombre, $pais, $fundacion, $servicios]);
        }
    }

?>