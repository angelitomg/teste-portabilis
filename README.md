# Sistema Para Gerenciamento de Matrículas 
## (Avaliação Portabilis)

Instalação
===========================
1. git clone https://github.com/angelitomg/teste-portabilis.git
2. cd teste-portabilis
3. Configure o banco de dados no arquivo config/app.php
4. Instale as dependências com o comando: php ../composer.phar install
5. Atualize os componentes com o comando: php ../composer.phar update
6. Instale o banco de dados com o comando: php bin/cake.php migrations migrate
7. Insira os dados básicos de acesso com o comando: php bin/cake.php migrations seed (este comando também irá popular o banco de dados com alunos, cursos e matrículas)
8. Acesse http://seu_servidor/teste-portabilis


Características adicionais do sistema
===========================
* Multilinguagem, en_US disponível, basta configurar no arquivo config/configs.php
* Layout responsivo
* Multiusuário
* Diferentes bancos de dados suportados: MySQL, PostgreSQL, SQLite

Notas extras
============================
* Quando uma matrícula é cadastrada, os pagamentos são automaticamente gerados, com um vencimento de 30 dias a partir do vencimento anterior.
* As parcelas são geradas com base nos meses de duração do cursos + a parcela da matrícula.
* Para evitar um arquivo seed muito grande, as matrículas foram importadas, porém as parcelas de cada matrícula não foram geradas automaticamente.
* Nestes casos em que as parcelas não foram geradas, existe um botão *Gerar Parcelas*, no dashboard da matrícula, responsável por gerar as parcelas para os próximos meses.
* O autocomplete do nome do aluno no cadastro de matrículas começa a funcionar quando são digitados 3 caracteres ou mais.
