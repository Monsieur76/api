<?php

class Database
{
    private static $myConfig;
    private static $db = NULL;
    private static $sql = 'mysql:host';
    private static $host;
    private static $dbn = 'dbname';
    private static $name;
    private static $charset = 'charset';
    private static $nameCharset;
    private static $userName;
    private static $pass;
    private static $mode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];
    private static $debug = 1;

    public static function get()
    {
        if (self::$debug === 0){
            self::$myConfig = parse_ini_file("configprod.ini", true);
            self::$name = self::$myConfig['Database']['dbname'];
            self::$host = self::$myConfig['Database']['host'];
            self::$nameCharset = self::$myConfig['Database']['charset'];
            self::$userName = self::$myConfig['Database']['username'];
            self::$pass = self::$myConfig['Database']['pass'];
        }elseif(self::$debug === 1){
            self::$myConfig = parse_ini_file("configTest.ini", true);
            self::$name = self::$myConfig['Database']['dbname'];
            self::$host = self::$myConfig['Database']['host'];
            self::$nameCharset = self::$myConfig['Database']['charset'];
            self::$userName = self::$myConfig['Database']['username'];
            self::$pass = self::$myConfig['Database']['pass'];
        }
        if (!(self::$db instanceof self)) {
            try {
                self::$db = new PDO(self::$sql . '=' . self::$host . ';' . self::$dbn . '=' . self::$name .
                    ';' . self::$charset . '=' . self::$nameCharset, self::$userName, self::$pass,
                    self::$mode);
            } catch (Exception $e) {
                echo 'Échec de la connexion : ' . $e->getMessage();
                exit;
            }
        }
        return self::$db;
    }
}