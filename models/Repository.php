<?php


namespace app\models;


use app\engine\App;
use app\interfaces\IModel;

abstract class Repository implements IModel
{
    public function getOneWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value";
        return App::call()->db->queryObject($sql, ["value" => $value], $this->getEntityClass());
    }

    public function getCountWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `$field`=:value";
        return App::call()->db->queryOne($sql, ["value" => $value])['count'];
    }

    public function getOneWhereAnd($field, $value, $field2, $value2)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value AND `$field2`=:value2";
        return App::call()->db->queryObject($sql, ["value" => $value, "value2" => $value2], $this->getEntityClass());
    }

    public function showLimit($page)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE 1 LIMIT ?";
        return App::call()->db->executeLimit($sql, $page);
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryObject($sql, ['id' => $id], $this->getEntityClass());

    }
    public function getOneArr($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryOne($sql, ['id' => $id], $this->getEntityClass());

    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function getAllWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value";
        return App::call()->db->queryAll($sql, ['value' => $value]);
    }

    public function getAllWhereLIKE($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field` LIKE :value";
        return App::call()->db->queryAll($sql, ['value' => '%'.$value.'%']);
    }

    public function insert(Entity $entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {

            $params[":{$key}"] = $entity->$key;
            $columns[] = "`$key`";
        }
        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $tableName = $this->getTableName();

        $sql = "INSERT INTO `{$tableName}`({$columns}) VALUES ({$values})";

//        var_dump($sql, $params);
//        die();

        App::call()->db->execute($sql, $params);

        $entity->id = App::call()->db->lastInsertId();

    }

    public function update(Entity $entity)
    {
        $params = [];
        $columns = [];
        foreach ($entity->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $entity->$key;
            $columns[] .= "`" . $key . "` = :" . $key;
            $entity->props[$key] = false;
        }
        $columns = implode(", ", $columns);
        $params[':id'] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";

        App::call()->db->execute($sql, $params);
    }

    public function save(Entity $entity)
    {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }

    }

    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ['id' => $entity->id]);
    }
}