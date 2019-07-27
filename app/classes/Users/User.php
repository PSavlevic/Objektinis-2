<?php

namespace App\Users;

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
                'password' => null
            ];
        }
    }

    public function setData($array)
    {
        $this->setName($array['name'] ?? null);
        $this->setAmount($array['email'] ?? null);
        $this->setAbarot($array['password'] ?? null);
    }

    public function getData()
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
    }

    public function setName(String $name)
    {
        $this->data['name'] = $name;
    }

    public function setEmail(String $email)
    {
        $this->data['email'] = $email;
    }

    public function setPassword(String $password)
    {
        $this->data['password'] = $password;
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getEmail()
    {
        return $this->data['email'];
    }

    public function getPassword()
    {
        return $this->data['password'];
    }

}