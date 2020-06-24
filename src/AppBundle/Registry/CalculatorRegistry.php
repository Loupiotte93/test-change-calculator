<?php

declare(strict_types=1);

namespace AppBundle\Registry;

use AppBundle\Calculator\CalculatorInterface;

class CalculatorRegistry implements CalculatorRegistryInterface
{
    /** @var CalculatorInterface[] */
    private $calculators = [];

    public function __construct(iterable $taggedCalculators)
    {
        foreach ($taggedCalculators as $calculator) {
            $this->calculators[$calculator->getSupportedModel()] = $calculator;
        }
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
