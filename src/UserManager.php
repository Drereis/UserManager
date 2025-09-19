<?php


declare(strict_types=1);

require_once 'User.php';
require_once 'Validator.php';

class UserManager
{
    private array $users = [];
    private int $nextId = 1;    

    public function __construct(array $initialUsers = [])
    {
        $this->users = $this->convertArrayToUsers($initialUsers);
        if (!empty($this->users)) {
            $lastUser = end($this->users);
            $this->nextId = $lastUser->getId() + 1;
        }
    }

    private function convertArrayToUsers(array $userArrays): array
    {
        $userObjects = [];
        foreach ($userArrays as $userData) {
            $userObjects[] = new User(
                $userData['id'],
                $userData['nome'],
                $userData['email'],
                $userData['senha'],
            );
        }
        return $userObjects;
    }

    private function findUserById( int $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        return null;
    }

    private function findUserByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    public function registerUser(string $name, string $email, string $password): array 
    {
        if (!Validator::isValidEmail($email)) {
            return ['success' => false, 'message' => 'E-mail inválido.'];
        }

        if (!Validator::isStrongPassword($password  )) {
            return ['success' => false, 'message' => 'Senha fraca.'];
        }

        if ($this->findUserbyEmail($email)) {
            return ['success' => false, 'message' => 'E-mail já esta em uso.'];
        }


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $newUser = new User(
            $this->nextId,
            $name,
            $email,
            $hashedPassword
        );


        $this->users[] = $newUser;
        $this->nextId++;


        return ['success' => true, 'message' => 'Usuário cadastrado com sucesso', 'user' => $newUser];


    }

    public function loginUser(string $email, string $password): array 
    {
        return[];
    }

    public function resetPassword(int $userId, string $newPassword): array
    {
        return [];
    }

    public function getUsers(): array 
    {
        return $this->users;
    }
}