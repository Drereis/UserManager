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

echo "<h1>Caso de Uso</h1>";
echo "<hr>";


$name1 = "André Luis";
$email1 = "andre@email.com";
$password1 = "Senha123";

echo "<h3>Caso de Uso 1: Cadastro Válido</h3>";
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

echo "<h3>Caso de Uso 2:Cadastro com E-mail Inválido</h3>";
echo "Entrada: Nome: " . $name2 . ", E-mail: " . $email2 . ", Senha: " . $password2 . "<br>";
$result2 = $userManager->registerUser($name2, $email2, $password2);
echo "Resultado: " . ($result2['success'] ? 'Sucesso: ' : 'Erro: ' . $result2['message']) . "<br>";
echo "<hr>";

$emailLogin = "joao@email.com";
$passwordLogin = "SenhaErrada";

echo "<h3>Caso de Uso 3: Tentativa de login com senha errada</h3>";
echo "Entrada: E-mail: " . $emailLogin . ", Senha: " . $passwordLogin . "<br>";

$resultLogin = $userManager->LoginUser($emailLogin, $passwordLogin);
echo "Resultado: " . ($resultLogin['success'] ? 'Sucesso ' : 'Erro: ' . $resultLogin['message']) . "<br>";
echo "<hr>";

$userId = 1;
$newPassword = "NovaSenha555";

echo "<h3>Caso de Uso 4:Reset de senha válido</h3>";
echo "Entrada: ID: " . $userId . ", Nova senha: " . $newPassword . "<br>";

$resultReset = $userManager->resetPassword($userId, $newPassword);

echo "Resultado: " . ($resultReset['success'] ? 'Sucesso: ' . $resultReset['message'] : 'Erro: ' . $resultReset['message']) . "<br>";

$userAfterReset = $userManager->findUserById($userId);  
if ($userAfterReset !== null) {
    echo "Nova senha Hashada: " . $userAfterReset->getHashedPassword() . "<br>";
}
echo "<hr>";

$name3 = "Hornet";
$emailDuplicate = "joao@email.com";
$password3 = "QualquerSenha1";

echo "<h3>Caso de Uso 5: Cadastro de usuário com e-mail duplicado</h3>";
echo "Entrada: Nome: " . $name3 . ", E-mail: " . $emailDuplicate . ", Senha: " . $password3 . "<br>";

$resultDuplicate = $userManager->registerUser($name3, $emailDuplicate, $password3);

echo "Resultado: " . ($resultDuplicate['success'] ? 'Sucesso: ' : 'Erro: ') . $resultDuplicate['message'] . "<br>";
echo "<hr>";



