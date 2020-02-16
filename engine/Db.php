<?php

namespace app\engine;

use app\traits\Tsingletone;

class Db
{
    private $config;

    private $connection = null;

    public function __construct($driver, $host, $login, $password, $database, $charset = "utf8")
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Сздан класс Базы Данных'
        ]);

        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection() {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        if (is_null($this->connection)) {
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Создание PDO соединения'
            ]);
            $this->connection = new \PDO(
                $this->prepareDSNString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Возврат соединения'
        ]);
        return $this->connection;
    }

    private function prepareDSNString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query($sql, $params){
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function lastInsertId() {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return $this->connection->lastInsertId();
    }

    public function queryObject($sql, $params, $class) {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'sql' => $sql,
                'params' => $params,
                'class' => $class
            ]
        ]);
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $pdoStatement->fetch();
    }

    public function execute($sql, $params) {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'sql' => $sql,
                'params' => $params
            ]
        ]);
        $this->query($sql, $params);
        return true;
    }

    public function executeLimit($sql, $page) {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'sql' => $sql,
                'page' => $page
            ]
        ]);
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->bindValue(1, $page, \PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetchAll();
    }

    public function queryOne($sql, $params = []) {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'sql' => $sql,
                'params' => $params
            ]
        ]);
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll($sql, $params = []) {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'sql' => $sql,
                'params' => $params
            ]
        ]);
        return $this->query($sql, $params)->fetchAll();
    }

    public function __toString()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return "Db";
    }
}