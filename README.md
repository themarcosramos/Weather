# Weather
Aplicação web que permite aos usuários consultar a previsão do tempo de uma determinada cidade, utilizando a API do WeatherStack, através da stack PHP com Laravel para o backend, e para o frontend jQuery e Bootstrap, utilizando o banco de dados MySQL.

## Requisitos necessários excução do  projeto 

 > Docker  
 >
 > Possuir um perfil [WeatherStack](https://weatherstack.com)
 >
 
 ## Como executar o projeto 

  1. Primeiro realize a clonagem para sua máquina do repositório [Weather](https://github.com/themarcosramos/Weather).

  2. Acesse o seguinte diretório e arquivo:

  ``` 
     Weather/app/Http/Controllers/PrevisaoController.php
   ```
 e  na variável 

```php
   private $weatherstackApiKey = '';
```
dentro na '' insira o seu token da [WeatherStack](https://weatherstack.com)

   3. Faça um copia do arquivo  `env.example.` e renomeei para  `.env` e altere para suas credência caso  necessário.  

   4. Após isso ainda diretório raiz do projeto execute : 

```bash
docker-compose up --build
```
5. Ainda  diretório raiz do projeto execute : 

```bash
docker-compose up -d
```
6. Ainda seguinda execute : 

```bash
docker-compose exec app bash
```

7. Execute as migrations do laravel: 

```bash
php artisan migrate
```
8. Inicie o servidor laravel :

```bash
php artisan serve --host=0.0.0.0 --port=8000
```
Quando você terminar de usar o servidor laravel, pressione `Ctrl + C` no terminal onde o servidor está em execução para encerrá-lo. E para sair do contêiner, basta digitar `exit` no terminal.

 ### Demostração de uso  

![Demonstração de Uso da aplicação ](https://github.com/themarcosramos/Weather/blob/main/gif/user.gif)

>>

![Demonstração de Uso da aplicação ](https://github.com/themarcosramos/Weather/blob/main/gif/user2.gif)

>>

![Demonstração de Uso da aplicação responsivo ](https://github.com/themarcosramos/Weather/blob/main/gif/responsivo.gif)
