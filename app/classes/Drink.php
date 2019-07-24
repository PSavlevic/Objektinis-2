<?php

class Drink
{

    private $data = [];

    public function __construct($data = null)
    {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'name' => null,
                'amount_ml' => null,
                'abarot' => null,
                'image' => null
            ];
        }
    }

    /**
     * Sets all data from array
     * @param array $array
     */
    public function setData($array)
    {
        $this->setName($array['name']) ?? null;
        $this->setAmount($array['amount_ml']) ?? null;
        $this->setAbarot($array['abarot']) ?? null;
        $this->setImage($array['image']) ?? null;
    }

    /**
     * Gets all data as array
     * @return array
     */
    public function getData()
    {
        return [
            'name' => $this->getName(),
            'amount_ml' => $this->getAmount(),
            'abarot' => $this->getAbarot(),
            'image' => $this->getImage()
        ];
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->data['id'] = $id;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->data['id'];
    }


    /**
     * Sets name
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->data['name'] = $name;
    }

    /**
     * Returns name
     * @return string
     */
    public function getName()
    {
        return $this->data['name'];
    }

    /**
     * Sets data amount
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->data['amount_ml'] = $amount;
    }

    /**
     * Returns amount in mililiters
     * @return int
     */
    public function getAmount()
    {
        return $this->data['amount_ml'];
    }

    /**
     * Sets data abarot
     * @param float $abarot
     */
    public function setAbarot(float $abarot)
    {
        if ($abarot >= 0 && $abarot < 100) {
            $this->data['abarot'] = $abarot;
        } else {
            throw new Exception('Abarot invalid');
        }
    }

    /**
     * Returns alchohol percentage
     * @return float
     */
    public function getAbarot()
    {
        return $this->data['abarot'];
    }

    /**
     * Sets data image
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->data['image'] = $image;
    }

    /**
     * Returns image url
     * @return string
     */
    public function getImage()
    {
        return $this->data['image'];
    }

}
