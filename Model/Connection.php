<?php
abstract class Connection{

    protected function conectionDB( ){
        $host = "localhost";
        $user = 'root';
        $password = '';
        $database = 'bibliotecatmax';
        try{
            $conn = new mysqli($host, $user, $password, $database);
            return $conn;

        }
        catch (Exception $e){
            return $e->getMessage();
        }

    }
}