<?php

namespace App\Drinks;

class LightDrink extends Drink
{
    public function drink()
    {
        parent::setAmount($this->getAmount() - 100);
    }

    public function getImage()
    {
        if($this->getImage() !== null) {
            return parent::getImage();
        } else {
        return 'https://lt1.pigugroup.eu/colours/219/837/20/21983720/447ce40e9b567ecbbe8b0daa598fa6f8_large.jpg';
        }
    }
}
