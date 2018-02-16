<?php

class Koneksi {

    public static function get_koneksi() {
        try {
            //using mysql server
            $db_handler = new PDO("mysql:host=localhost;dbname=ta_survey", "root", "");
            //using mysql server
            $db_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $db_handler;
    }

}

?>