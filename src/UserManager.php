<?php


declare(strict_types=1);

require_once 'User.php';
require_once 'Validator.php';

class UserManager
{
    private array $users = [];
    public function __construct(array $initialUsers = [])
    {
        $this->users = $this->convertArrayToUsers($initialUsers);
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

    public function findUserById( int $id): ?User
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

    private function hashedPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function generateNextId(): int
    {
        return count($this->users) + 1;
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


        $hashedPassword = $this->hashedPassword($password);

        $newUserId = $this->generateNextId();

        
        $newUser = new User(
            $newUserId,
            $name,
            $email,
            $hashedPassword
        );

        $this->users[] = $newUser;
    
        return ['success' => true, 'message' => 'Usuário cadastrado com sucesso', 'user' => $newUser];
    }

    public function loginUser(string $email, string $password): array 
    {
        $user = $this->findUserByEmail($email);
        if ($user === null || !$user->verifyPassword($password)) {
            return ['success' => false, 'message' => 'Credenciais inválidas.'];
        }
        return['success' => true, 'message' => 'Login realizado com sucesso.'];
    }

    public function resetPassword(int $userId, string $newPassword): array
    {
        $user = $this->findUserById($userId);
        if ($user === null) {
            return ['success' => false, 'message' => 'Credenciais inválidas.'];
        }

        if (!Validator::isStrongPassword($newPassword)) {
            return ['success' => false, 'message' => 'Nova senha fraca.'];
        }

        $newHashedPassword = $this->hashedPassword($newPassword);
         
        $user->setHashedPassword($newHashedPassword);

        return ['success' => true, 'message' => 'Senha redefinida com sucesso.'];


    }

    public function getUsers(): array 
    {
        return $this->users;
    }
}