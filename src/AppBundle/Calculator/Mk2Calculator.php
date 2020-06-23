<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

class Mk2Calculator extends MkCalculator implements CalculatorInterface
{
    public const MODEL_NAME = 'mk2';

    public const MODEL_COINS = [
        'bill10' => 10,
        'bill5' => 5,
        'coin2' => 2,
    ];

    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string
    {
        return self::MODEL_NAME;
    }

    /**
     * @return array Indicates the availables coins for this automaton (change property => integer value)
     */
    public function getModelCoins(): array
    {
        return self::MODEL_COINS;
    }
}
