<?php

use App\Carros;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

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
        // throw new \PHPUnit\Framework\IncompleteTestError("Step `i go to find table fipe` is not defined");
        return true;
    }

   /**
    * @Then i get url
    */
    public function iGetUrl()
    {
        // throw new \PHPUnit\Framework\IncompleteTestError("Step `i get url` is not defined");
        return true;
    }

}