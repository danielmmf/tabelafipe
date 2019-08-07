<?php

namespace App;

class Carros
{
    private $brand;
    private $model;

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     *
     * @return self
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     *
     * @return self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getBrandId()
    {
        $marcas = json_decode(file_get_contents('public/marcas.json'));

        foreach ($marcas as $marca) {
            if(strtolower($marca->name) == strtolower($this->getBrand()))
                return $marca->id;
        }
    }

    public function getModelId()
    {
        $file_models = file_get_contents('http://fipeapi.appspot.com/api/1/1/veiculos/'.$this->getBrandId().'.json');

        if(!file_exists('public/modelos.'.$this->getBrandId().'.json'))
            file_put_contents('public/modelos.'.$this->getBrandId().'.json', $file_models);
                
        $modelos = json_decode(file_get_contents('public/modelos.'.$this->getBrandId().'.json'));

        foreach ($modelos as $modelo) {
            if(strtolower($modelo->name) == strtolower($this->getModel()))
                return $modelo->key;
        }
    }
}