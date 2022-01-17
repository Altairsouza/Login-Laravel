<?php


    namespace App\Classes;
    class Nossaclasse{

        public function checkSession() {
            return session()->has('usuario');
        }

    }


?>
