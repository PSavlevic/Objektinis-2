<?php

namespace App\Drinks;

class StrongDrink extends Drink {
    public function drink() {
        parent::setAmount($this->getAmount()-50);
    }
}