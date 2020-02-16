<?php


namespace app\engine;


class Storage
{
    protected $items = [];

    public function set($key, $object)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'key' =>  $key,
                'object' => $object
            ]
        ]);
        $this->items[$key] = $object;
    }

    public function get($key)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'key' => $key
            ]
        ]);
        if(!isset($this->items[$key])){
            //если при обращении к свойству-методу не существует объекта, создадим его
            $this->items[$key] = App::call()->createComponent($key);
        }
        return $this->items[$key];
    }
}