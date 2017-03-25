<?php
namespace app\base;

class Container
{
    protected $item = [];

    public function set($object, $key)
    {
        $this->item[$key] = $object;
    }

    public function get($key)
    {
        if(!isset($this->item[$key])){
            $this->item[$key] = Application::call()->createComponent($key);
        }
        return $this->item[$key];
    }
}