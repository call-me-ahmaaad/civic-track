<?php

namespace App\Models;

class User
{
    private ?int $id = null;
    private string $username;
    private string $password;

    public function __construct(?int $id, string $username, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}