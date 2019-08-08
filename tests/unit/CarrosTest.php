<?php 

use App\Carros;

class CarrosTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester, $carro;
    
    protected function _before()
    {
        $this->carro = new Carros;
    }

    protected function _after()
    {
    }

    // tests
    public function testDevoCriarCarros()
    {
        $this->assertTrue(is_object($this->carro));
    }

    public function testDeveTrazerIdDaMarca()
    {
        //MIURA 42 
        //CADILLAC 10
        $this->carro->setBrand("MIURA");
        $this->assertEquals(42, $this->carro->getBrandId());

        $this->carro->setBrand("CADILLAC");
        $this->assertEquals(10, $this->carro->getBrandId());

        $this->carro->setBrand("matra");
        $this->assertEquals(37, $this->carro->getBrandId());
    }

    public function testDeveTrazerKeyDoModelo()
    {
        $this->carro->setBrand("MIURA");
        $this->carro->setModel("Picape BG-Truck CD Turbo Diesel");
        $this->assertEquals("picape-1780", $this->carro->getPropertyModel()->key);

        $this->carro->setBrand("CADILLAC");
        $this->carro->setModel("Deville/Eldorado 4.9");
        $this->assertEquals('deville-eldorado-258', $this->carro->getPropertyModel()->key);

        // $this->carro->setModel("matra");
        // $this->assertEquals(37, $this->carro->getPropertyModel());
    }

    public function testDeveTrazerEndereco(){
        $this->carro->setBrand("Toyota");
        $this->carro->setModel("Corolla Fielder SW SE-G 1.8 Flex 16V Aut");
        $this->assertEquals('56/4348/2008-1', $this->carro->get_key());
    }
}