<?php
class Connection
{
    private static $instance = null;
    private $connect;
    private function __construct($dbConfig)
    {
        try {
            $dsn = 'mysql:dbname=' . $dbConfig['db'] . ';host=' . $dbConfig['host'];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            $this->connect = new PDO($dsn, $dbConfig['user'], $dbConfig['password'], $options);
        } catch (PDOException $ex) {
            $data['message'] = $ex->getMessage();
            App::$app->renderError('database', $data);
            die;
        }
    }

    public static function getInstance($dbConfig)
    {
        if (self::$instance == null) {
            self::$instance = new Connection($dbConfig);
        }
        return self::$instance->connect;
    }
}
