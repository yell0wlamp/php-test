<?php

class User
{
    protected static int $countUsers = 0;
    public int $id = 0;
    public string $name = '';
    public string $email = '';

    public function __construct($name, $email)
    {
        $this->id = ++self::$countUsers;
        $this->name = $name;
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->id;
    }
}

