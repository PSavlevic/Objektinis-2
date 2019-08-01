<?php

namespace App\Drinks;

class StrongDrink extends Drink
{
    public function drink()
    {
        parent::setAmount($this->getAmount() - 50);
    }

    public function getImage()
    {
        if (parent::getImage()) {
            return parent::getImage();
        }
        return 'http://berlat.lv/system/products/main_images/000/000/030/medium/Bonus_07.png?1534232122';
    }
}