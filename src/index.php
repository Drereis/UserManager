<?php

declare(strict_types=1);

require_once 'User.php';
require_once 'Validator.php';
require_once 'UserManager.php';


$initialUsersData = [
    [
        'id' => 1,
        'nome' => 'João Silva',
        'email' => 'joao@email.com',
        'senha' => password_hash('SenhaForte1', PASSWORD_DEFAULT)
    ]
];

$userManager = new UserManager($initialUsersData);

echo "<h1>Casos de Teste</h1>";
echo "<hr>";


$name1 = "André Luis";
$email1 = "andre@email.com";
$password1 = "Senha123";

echo "<h3>Tentativa de Cadastro Válido</h3>";
echo "Entrada: Nome: " . $name1 . ", E-mail: " . $email1 . ", Senha: " . $password1 . "<br>";

$result1 = $userManager->registerUser($name1, $email1, $password1);

echo "Resultado: " . ($result1['success'] ? 'Sucesso: ' : 'Erro: ') . $result1['message'] . "<br>";

if ($result1['success']) {
    $newUser = $result1['user'];
    echo "Nome do usuário: " . $newUser->getName() . "<br>";
    echo "E-mail do usuário: " . $newUser->getEmail() . "<br>";
    echo "Senha: " . $newUser->getHashedPassword() . "<br>";
}

echo "<hr>";


$name2 = "Joaquim";
$email2 = "joaquim@@email";
$password2 = "Senha123";

echo "<h3>Tentativa de Cadastro com E-mail Inválido</h3>";
echo "Entrada: Nome: " . $name2 . ", E-mail: " . $email2 . ", Senha: " . $password2 . "<br>";
$result2 = $userManager->registerUser($name2, $email2, $password2);
echo "Resultado: " . ($result2['success'] ? 'Sucesso: ' : 'Erro: ' . $result2['message']) . "<br>";
echo "<hr>";