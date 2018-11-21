<?php

class Factory extends CI_Model {

    private static $connection;
    private static $user = 'aabbmain';
    private static $pass = 'mgc15370';
    private static $dsn = 'mysql:host=aabbmain.mysql.dbaas.com.br;dbname=aabbmain';

    public static function getConnection() {
        try {
            if (!self::$connection) {
                self::$connection = new PDO(self::$dsn, self::$user, self::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            }
            return self::$connection;
        } catch (PDOException $e) {
            throw new PDOException('<strong>ERRO</strong>: Não foi possível conectar ao banco de dados. ' . $e->getMessage());
        }
    }

}