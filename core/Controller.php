<?php

class Controller
{
    public function model($model)
    {
        require_once "core/MyPDO.php";
        require_once "models/$model.php";
        return new $model ();
    }

    public function view($view, $data = Array())
    {
        $config = $this->config();
        require_once "views/$view.php";
    }

    public function config(){
        return new Config();
    }
}
