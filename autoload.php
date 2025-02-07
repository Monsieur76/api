<?php

/**
 * Class Autoloader
 */
class Autoloader{

    private static $dossier = ['model','DAO','controller','json'];
    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        $name = strtolower($class).".php";
        foreach (self::$dossier as $ligne){
            if( file_exists($ligne.'/' .$name) ){
                require $ligne.'/' . $name;
            }
        }
    }

}