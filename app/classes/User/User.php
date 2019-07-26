<?php

namespace App\User;

class User
{
    private $data = [];

    public function __construct($data = null)
    {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'name' => null,
                'email' => null,
                'password' => null,
            ];
        }
    }

    public function setData($array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        } else {
            $this->data['id'] = null;
        }
        $this->setName($array['name'] ?? null);
        $this->setEmail($array['email'] ?? null);
        $this->setPassword($array['password'] ?? null);
    }

    /**
     * Gets all data as array
     * @return array
     */
    public function getData()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
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
     * Sets name
     * @param string $name
     */
    public function setEmail(string $email)
    {
        $this->data['email'] = $email;
    }

    /**
     * Returns name
     * @return string
     */
    public function getEmail()
    {
        return $this->data['email'];
    }

    /**
     * Sets name
     * @param string $name
     */
    public function setPassword(string $pass)
    {
        $this->data['pass'] = $pass;
    }

    /**
     * Returns name
     * @return string
     */
    public function getPassword()
    {
        return $this->data['pass'];
    }

}