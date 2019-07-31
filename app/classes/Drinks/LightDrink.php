<?php


namespace App\Drinks;

class LightDrink extends Drink
{
    public function drink()
    {
        parent::setAmount($this->getAmount() - 100);
    }
}