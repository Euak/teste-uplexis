# Teste Programador PHP - upLexis

## Descrição
Desenvolver uma aplicação que utilize PHP7 e Framework Laravel 5. A aplicação deve ser capaz de realizar uma requisição ao Sintegra do Estado do Espirito Santo (http://www.sintegra.es.gov.br/). Os dados devem ser salvos em um banco de dados MySQL. Para acesso como serviço da aplicação deve-se desenvolver uma API do tipo REST.

## API Endpoint
http://localhost/teste-uplexis/public/index.php/api/sintegra/es/{CNPJ} (Apache) ou http://localhost/api/sintegra/es/{CNPJ}
É utilizado Basic Authentication para autentição na API. Sendo o usuário e senha os mesmos cadastrados no banco dados.

#### Configuração do Banco de Dados utilizado
> Host: localhost
> Nome: uplexis
> Usuário: root
> Sem senha
## Usuários Cadastrados nas Seeds
> Usuário: kaue
> Senha: 123

> Usuário: teste
> Senha: 321

#### Comandos para Migrations e Seeds
> php artisan migrate
> php artisan db:seed

#### Notas
> Apenas foi testado em ambiente com servidor Apache 2.4. Devido à isso, apenas caminhos com prefixo /teste-uplexis/public/index.php/ funcionaram durante os testes.

