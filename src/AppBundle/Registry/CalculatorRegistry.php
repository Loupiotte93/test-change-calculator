<?php

declare(strict_types=1);

namespace AppBundle\Registry;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Calculator\Mk1Calculator;
use AppBundle\Calculator\Mk2Calculator;

class CalculatorRegistry implements CalculatorRegistryInterface
{
    /** @var CalculatorInterface[] */
    private $calculators = [];

    public function __construct(Mk1Calculator $mk1Calculator, Mk2Calculator $mk2Calculator)
    {
        $this->calculators[$mk1Calculator->getSupportedModel()] = $mk1Calculator;
        $this->calculators[$mk2Calculator->getSupportedModel()] = $mk2Calculator;
    }

    /**
     * @param string $model Indicates the model of automaton
     *
     * @return CalculatorInterface|null The calculator, or null if no CalculatorInterface supports that model
     */
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {
        return $this->calculators[$model] ?? null;
    }
}
