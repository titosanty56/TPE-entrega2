<?php

    class personasModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=agencia_viajes;charset=utf8', 'root', '');
        }
        public function getPersonas(){
            //Ejecuto la consulta
            $query = $this->db->prepare('SELECT * FROM persona');
            $query->execute();

            //Obtengo los datos en un arreglo de objetos
            $personas = $query->fetchAll(PDO::FETCH_OBJ); 

            return $personas;
        }
        public function getPersonasId($id_aerolinea) {
            $query = $this->db->prepare('SELECT * FROM persona WHERE id_aerolinea = ?');
            $query->execute([$id_aerolinea]);

            $persona = $query->fetchAll(PDO::FETCH_OBJ); 

            return $persona;
        }

        public function getPersona($id_persona) {
            $query = $this->db->prepare('SELECT * FROM persona WHERE id_persona = ?');
            $query->execute([$id_persona]);

            $persona = $query->fetch(PDO::FETCH_OBJ); 

            return $persona;
        }

    }

?>