# USER MANAGER

Projeto simples em **PHP** que demonstra um sistema básico de gerenciamento de usuários.  
Inclui classes para representar um usuário, gerenciar operações e validar dados.

---

## Como Rodar o Projeto

1. Tenha um servidor web com PHP instalado (ex.: **XAMPP**, **WAMP** ou **LAMPP**).
2. Clone ou baixe este repositório para a pasta `htdocs` (ou a raiz do seu servidor web).
3. Estrutura de pastas recomendada:

project-root/
├── src/
│ ├── index.php
│ ├── User.php
│ ├── UserManager.php
│ └── Validator.php
└── README.md


4. Inicie o servidor web.  
5. No navegador, acesse:  
http://localhost/usuarios/src/index.php


## Funcionalidades

- **Cadastro de Usuário** → Criação de novos usuários com validação de nome, e-mail e senha.  
- **Login de Usuário** → Autenticação com e-mail e senha.  
- **Reset de Senha** → Alteração da senha de usuários existentes.  
- **Validação de Dados** → E-mail válido + senha com no mínimo 8 caracteres, 1 letra maiúscula e 1 número.  

---

## Casos de Uso (index.php)

###  1. Cadastro de Usuário Válido
- **Ação:** Cadastrar `André Luis | andre@email.com | Senha123`
- **Resultado:** Cadastro bem-sucedido com senha criptografada (hash).

###  2. Cadastro com E-mail Inválido
- **Ação:** Cadastrar com e-mail `joaquim@@email`
- **Resultado:** Erro → "E-mail inválido".

###  3. Tentativa de Login com Senha Incorreta
- **Ação:** Login com `joao@email.com | SenhaErrada`
- **Resultado:** Erro → "Credenciais inválidas".

###  4. Reset de Senha Válido
- **Ação:** Redefinir senha do usuário ID `1` para `NovaSenha555`
- **Resultado:** Sucesso com novo hash gerado.

###  5. Cadastro com E-mail Duplicado
- **Ação:** Cadastrar novo usuário com `joao@email.com`
- **Resultado:** Erro → "E-mail já está em uso".

---

##  Tecnologias Utilizadas
- PHP 8+
- Servidor Web (Apache)
- Hash de Senhas (`password_hash`, `password_verify`)

---

##  Licença
Este projeto é apenas para fins educacionais. Livre para uso e modificação.

Ra: 1987363->André Luis da Silva Reis.
Ra: 1993917->Joaquim Fernando Sant'ana Moreira.
