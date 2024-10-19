<?php

    class UserModels{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=agencia_viajes;charset=utf8', 'root', '');
        }

        public function getUser($user){
            $query = $this->db->prepare("SELECT * FROM usuario WHERE user = ?");
            $query->execute([$user]);

            $user = $query->fetch(PDO::FETCH_OBJ);

            return $user;
        }
    }

?>