<?php

namespace Step\Acceptance;
use App\Carros;

class TabelaFipe extends \AcceptanceTester{

    public $valor, $tabela;

    /**
    * @Given i have a brand car with value :arg1
     */
     public function iHaveABrandCarWithValue($arg1)
     {
     	$car = new Carros;
     	$car->setBrand($arg1);

     	if($car->getBrand() == $arg1)
     		return true;
     	else
     		throw new \Error("This Brand not is correct".$arg1, 1);
     }

    /**
     * @Given i have a model car with value :arg1
     */
     public function iHaveAModelCarWithValue($arg1)
     {
     	$car = new Carros;
     	$car->setModel($arg1);

     	if($car->getModel() == $arg1)
     		return true;
     	else
     		throw new \Error("This Model not is correct".$arg1, 1);
     }

   /**
    * @When i go to find table fipe
    */
    public function iGoToFindTableFipe()
    {
        return true;
    }

   /**
    * @Then i get url
    */
    public function iGetUrl()
    {
        return true;
    }

    /**
     * @Given i have a car with name :arg1$
      */
      public function iHaveACarWithName($arg1)

     {
        $this->tabela = new \App\TabelaFipe($arg1);

       
     }

    /**
     * @When i call find_price
     */
     public function iCallFind_price()
     {
         $this->valor = $this->tabela->consulta_fipe();
     }

    /**
     * @Then i see the price is :arg1$
     */
      public function iSeeThePriceIs($arg1)
      {
          if($this->valor == $arg1)
                    return true;
                else
                    throw new \Error("O valor do carro nao bateu com ".$arg1. " o Valor trazido foi ".$this->valor, 1);
      }
}