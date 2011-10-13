# PHP-MG Cep
O codigo inicial deste projeto foi desenvolvido no DOJO que aconteceu no dia 08/10, no Segundo PHPMG Talks

### Requerimentos
* PHP 5.3
* MySQL 5.1


### Dependências
* Respect Rest        - http://github.com/Respect/Rest
* Respect Config      - http://github.com/Respect/Config
* Symfony ClassLoader - https://github.com/symfony/ClassLoader.git

### Instalação
1. Clone o repositório;
2. Instalar as dependências usando o comando:
    php bin/vendors install
3. Criar o banco de dados usando o arquivo contido em data/mysql-data.sql
4. Criar seu arquivo local de configurações chamado config.ini baseado no config.ini.example, altere as variaveis de conexão apenas


### TODO
1. TODO's no código.
2. Normalizar o banco de dados e criar o script para migração dos dados desnormalizados para a estrutura normalizada;
3. Melhorar o tratamento de erros;


### Contribuindo
* Todo codigo fonte deverá ser escrito em inglês;
* Seguir os padrões:
    * [PSR-0](http://groups.google.com/group/php-standards/web/psr-0-final-proposal)
    * [Symfony 2 Coding Standards](http://symfony.com/doc/current/contributing/code/standards.html)
    * [Symfony 2 Conventions](http://symfony.com/doc/current/contributing/code/conventions.html)
