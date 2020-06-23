<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

abstract class MkCalculator
{
    abstract public function getModelCoins();

    /**
     * Recursive function :
     *  - stop condition is : $amount not divisible by any coin value (example for this model : 1 or 3)
     *  - OK situation : remaining $amount to convert into coins == 0
     *
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change
    {
        $change = new Change();
        $coins = $this->getModelCoins();
        arsort($coins);

        // start to iterate with biggest $value first
        foreach ($coins as $changeProperty => $coinValue) {
            while ($amount >= $coinValue) {
                // try to minus $coinValue on given amount
                $remaining = $amount - $coinValue;
                // if the remaining is negative or can't be recursively changed, then stop
                if ($remaining < 0 || ($remaining > 0 && null === $this->getChange($remaining))) {
                    break;
                }
                // else continue loop and update values :
                $amount -= $coinValue;
                $change->{$changeProperty}++;
            }
        }

        // if there is still remainder, then change operation is impossible
        return (0 !== $amount) ? null : $change;
    }
}
