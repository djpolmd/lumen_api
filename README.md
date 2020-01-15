## Тестовое задание для бэкендера
 
## Напиши простое приложение партнерской программы. Использовать можно любой фреймворк. Мы используем Laravel, поэтому он в приоритете.
 
 ### Что нужно сделать
 — Регистрацию и вход партнера в систему.
 
 — Пополнение баланса без настоящего процессинга. Добавляет средства на баланс партнера.
 
 — Приглашение других партнеров. Двухуровневая система. Приглашенный партнер (реферал) приглашать новых не может. При пополнении баланса 10% от суммы начисляется пригласившему (родителю).
 
 -----------------
 How to  install.
1.  Copy `git clone <Http>` ...
2.  ` cd <project dir>` 
3. composer install && composer update
4. for server start use (@not artisan serve): `php -S localhost:8000 -t public` 
5. Feel free to use `artisan db:seed`

6. RESTful description:
(use POSTMAN or CURL utils)
 -  `/api/register` : register for new user
    EX:  `curl -i http://localhost:8000/api/login -d email=test@test.com -d password=secret`
  
  you can get this result:
   ![Screen logo](/IMG/screen1.png)
  after  that you can use you token for AUTH connection.
    `curl -H "Authorization: Bearer <token>" http://localhost:8000/api/profile`
  EX: ![Screen2](/IMG/screen2.png)
  
  Next EX route (with postman use Bearer token):
   http://localhost:8000/api/users/1
 `curl -H "Authorization: Bearer <token>" http://localhost:8000/api/users/1`
   
   
NOTE: 
  - lumen with  eloquent, facade 
  And serveral add'ons :
   1. JWT - AUTH `https://iwader.co.uk/post/tymon-jwt-auth-with-lumen-5-2`
   2. JWT - `lcobucci/jwt` is a framework-agnostic PHP library that allows you to issue, parse, and validate JSON Web Tokens based on the RFC 7519. 
