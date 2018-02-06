# Avaliação T4F

![alt text](http://conde.online/trello.png)
Scrum 

http://conde.online/trello.png

Vídeo de apresentação
https://www.useloom.com/share/84bbb6a262454d879eca2eccbe2080bf


# Requisitos necessários
-PHP >= 7.0.0

-OpenSSL PHP Extension

-PDO PHP Extension

-Mbstring PHP Extension

-Tokenizer PHP Extension

-XML PHP Extension


## Como instalar?

Após clonar o projeto em seu ambiente, siga os seguintes passos:

Utilize o composer  
<pre>
composer install
</pre>

Depois:
<pre>
php artisan key:generate
</pre>


<p>Altere o arquivo .env do seu projeto, mudando as configuraçoes em negrito de acordo com seu banco de dados</p>


<pre>
    DB_CONNECTION=mysql
     DB_HOST=<b>host</b>
     DB_PORT=3306
     DB_DATABASE=<b>database</b>
     DB_USERNAME=<b>usersname</b>
     DB_PASSWORD=<b>password</b>
     </pre>

Após isso, rode o migrate
<pre>
php artisan migrate
</pre>

e Rode seu projeto
<pre>
php artisan serve
</pre>

## Testes API

via Postman
<pre>

<a href=https://www.getpostman.com/collections/1928310c78e68bc6b4be">https://documenter.getpostman.com/collection/view/3434102-2599c12a-393a-d1f3-ce74-e456c1619500</a>

</pre>

## Comentários sobre o projeto

Prezados, 

Conforme citado no video, fiquei em dúvida referente ao carrinho de compras, porém procurei uma forma de resolver 
o teste com o escopo apresentado.
Utilizei laravel 5.5 com mysql e acredito estar nos padrões solicitados pela T4F.
 
