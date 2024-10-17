<?php

    class aerolineaModel{
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
    }
?>