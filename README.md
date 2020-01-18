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

(Please use POSTMAN or CURL command from CLI)

####First step is to register for new user:
 -  `/api/register` : 
    `curl -i http://localhost:8000/api/register -d first_name=John last_name=Doe -d email=test2@test2.com -d password=secret -d password_confirmation=secret`

Login:  
    `curl -i http://localhost:8000/api/login -d email=test@test.com -d password=secret`
  
  
  you can get this result:
   ![Screen logo](/IMG/screen1.png)
  after that you can use your token for AUTH connection.
    `curl -H "Authorization: Bearer <token>" http://localhost:8000/api/profile`
  EX: ![Screen2](/IMG/screen2.png)
  
 #### Next EXAMPLE is  users route (with postman use Bearer token):
   http://localhost:8000/api/users/1
 `curl -H "Authorization: Bearer <token>" http://localhost:8000/api/users/1`
   
   The suppling fund is going by link billow: 
   `http://localhost:8001/api/checkout`
   consist from follow value from body:
       - grand_total (int)
       - status  (array - 'completed');
   
   #### Balance calculation 
   The GetCheckout() method is basically can use for triggering user 
   balance calculation and can be organised in a queue.
   
   `http://localhost:8001/api/getbalance`
   
   
   SUM for `grand_total` field
   (7079.750000+9617.444444+47314.500000+1874.857143+8116.000000+5.000000+10.000000+20.500000+20.530000+40.530000) :
   Result :  `{"message":"You total balance is : 74099.111587"}`    
   
NOTE: 
  - lumen with the eloquent, facade 
  And several add-ons :
   1. JWT - AUTH `https://iwader.co.uk/post/tymon-jwt-auth-with-lumen-5-2`
   2. JWT - `lcobucci/jwt` is a framework-agnostic PHP library that allows you to issue, parse, and validate JSON Web Tokens based on the RFC 7519. 
