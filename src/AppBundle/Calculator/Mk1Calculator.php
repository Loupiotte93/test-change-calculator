<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

class Mk1Calculator extends MkCalculator implements CalculatorInterface
{
    public const MODEL_NAME = 'mk1';

    public const MODEL_COINS = [
        'coin1' => 1,
    ];

    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string
    {
        return self::MODEL_NAME;
    }

    /**
     * @return array Indicates the availables coins for this automaton (Change property => integer value)
     */
    public function getModelCoins(): array
    {
        return self::MODEL_COINS;
    }
}
