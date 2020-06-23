<?php

namespace Tests\AppBundle\Calculator;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Model\Change;
use AppBundle\Calculator\Mk2Calculator;
use PHPUnit\Framework\TestCase;

class Mk2CalculatorTest extends TestCase
{
    /**
     * @var CalculatorInterface
     */
    private $calculator;

    protected function setUp()
    {
        $this->calculator = new Mk2Calculator();
    }

    public function testGetSupportedModel()
    {
        $this->assertEquals('mk2', $this->calculator->getSupportedModel());
    }

    public function testGetChangeEasy()
    {
        $change = $this->calculator->getChange(2);
        $this->assertInstanceOf(Change::class, $change);
        $this->assertEquals(1, $change->coin2);
    }

    /**
     * @dataProvider provideImpossibleChangeAmount
     * @param $amount
     */
    public function testGetChangeImpossible($amount)
    {
        $change = $this->calculator->getChange($amount);
        $this->assertNull($change);
    }

    public function provideImpossibleChangeAmount()
    {
        return [
            [-1],
            [1],
            [3]
        ];
    }

    /**
     * @dataProvider provideHardChangeAmount
     * @param $amount
     * @param $bill10
     * @param $bill5
     * @param $coin2
     */
    public function testGetChangeHard($amount, $bill10, $bill5, $coin2)
    {
        $change = $this->calculator->getChange($amount);
        $this->assertEquals($bill10,$change->bill10);
        $this->assertEquals($bill5,$change->bill5);
        $this->assertEquals($coin2,$change->coin2);
    }

    public function provideHardChangeAmount()
    {
        return [
            [0,0,0,0],
            [6,0,0,3],
            [7,0,1,1],
            [11,0,1,3],
            [21,1,1,3],
            [26,2,0,3]
        ];
    }
}
