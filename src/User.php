<?php


declare(strict_types=1);

class User 
{
    private int $id;
    private string $name;
    private string $email;
    private string $hashedPassword;
    
    public function __construct(int $id, string $name, string $email, string $hashedPassword) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
    }

    public function getId(): int 
    {
        return $this->id;
    } 

    public function getName(): string 
    {
        return $this->name;
    } 

    public function getEmail(): string
    {
        return $this->email;
    } 

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    } 

    public function verifyPassword(string $password): bool 
    {
        return password_verify($password, $this->hashedPassword);
    }

    public function setHashedPassword(string $newHashedPassword): void 
    {
        $this->hashedPassword = $newHashedPassword;
    }
    
}

