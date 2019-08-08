<?php

namespace App;

class TabelaFipe
{
    private $brand,$model, $carro;

    public function __construct($brand_model){
    	    $this->carro = new \App\Carros;
    	    $nome = explode("/", $brand_model);
    	    $this->carro->setBrand($nome[0]);
    	    $this->carro->setModel($nome[1]);
    }


   public function consulta_fipe(){
   		$key = $this->carro->get_key();
    	$dados_fipe = file_get_contents('http://fipeapi.appspot.com/api/1/1/veiculo/'.$key.".json");
    	$valor = json_decode($dados_fipe);

    	return $valor->preco;
    }

}