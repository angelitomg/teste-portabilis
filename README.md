# Sistema Para Gerenciamento de Matrículas (Avaliação Portabilis)

Instalação
===========================
1. git clone https://github.com/angelitomg/teste-portabilis.git
2. cd teste-portabilis
3. Configure o banco de dados no arquivo config/app.php
4. Instale as dependências com o comando: php ../composer.phar install
5. Atualize os componentes com o comando: php ../composer.phar update
6. Instale o banco de dados com o comando: php bin/cake.php migrations migrate
7. Insira os dados básicos de acesso com o comando: php bin/cake.php migrations seed
8. Acesse http://seu_servidor/teste-portabilis


Características adicionais do sistema
===========================
* Multilinguagem, en_US disponível, basta configurar no arquivo config/configs.php
* Layout responsivo
* Multiusuário
* Diferentes bancos de dados suportados: MySQL, PostgreSQL, SQLite