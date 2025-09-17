<?php


declare(strict_types=1);

class User 
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    
    public function __construct(int $id, string $name, string $email, string $password) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function userLogin()

    public function passwordUpdate()
    
}

