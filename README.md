## Тестовое задание для бэкендера
 
## Напиши простое приложение партнерской программы. Использовать можно любой фреймворк. Мы используем Laravel, поэтому он в приоритете.
 
### Что нужно сделать
 — Регистрацию и вход партнера в систему.
 
 — Пополнение баланса без настоящего процессинга. Добавляет средства на баланс партнера.
 
 — Приглашение других партнеров. Двухуровневая система. Приглашенный партнер (реферал) приглашать новых не может. При пополнении баланса 10% от суммы начисляется пригласившему (родителю).
 
 -----------------
##  How to  install.

1.  Copy `git clone <Http>` ...
2.  ` cd <project dir>` 
3.  Redact you .env for DB access.
4. `composer install && composer update`
5. For server start use (@not artisan serve): `php -S localhost:8000 -t public` 
6. Feel free to use `artisan db:seed`

6. RESTful description:

(Please use POSTMAN or CURL command from CLI)

#### First step is to register for new user:
 -  `/api/register` : 
    `curl -i http://<host>/api/register -d first_name=John last_name=Doe -d email=test@test.com -d password=secret -d password_confirmation=secret`

Login:  
    `curl -i http://<host>/api/login -d email=test@test.com -d password=secret`
  
  
  you can get this result:
   ![Screen logo](/IMG/screen1.png)
  after that you can use your token for AUTH connection.
    `curl -H "Authorization: Bearer <token>" http://localhost:8000/api/profile`
  EX: ![Screen2](/IMG/screen2.png)
  
 #### Next EXAMPLE is  users route (with postman use Bearer token):
 
 Get user profele
 `curl -H "Authorization: Bearer <token>" http://<host>/api/profile`
   
   The suppling fund is going by link billow: 

   `http://<host>/api/checkout`
  
  EX: `curl -i "Authorization: Bearer <token>" http://<host>/api/checkout -d grand_total=4.22 -d status=compleated`
  
   consist from follow value from body:
       - grand_total (int)
       - status  (array - 'completed');
   
   #### Balance calculation 
   The GetCheckout() method is basically can use for triggering user 
   balance calculation and can be organised in a queue.
   
   `http://<host>/api/getbalance`
   
   ### Register referral relationship
   
   `http://<host>/api/token/N`   - register referral relationship
   
   There "N" is parent user ID. The child user  can register only one parent. Any child can't be parent for nobody.
   
   SUM for `grand_total` field
   (7079.750000+9617.444444+47314.500000+1874.857143+8116.000000+5.000000+10.000000+20.500000+20.530000+40.530000) :
   Result :  `{"message":"You total balance is : 74099.111587"}`    
   
NOTE: 
  - lumen with the eloquent, facade 
 
  And several add-ons :
   1. JWT - AUTH `https://iwader.co.uk/post/tymon-jwt-auth-with-lumen-5-2`
   2. JWT - `lcobucci/jwt` is a framework-agnostic PHP library that allows you to issue, parse, and validate JSON Web Tokens based on the RFC 7519. 


## Git workflow:

    * a3d2a37        (origin/C&B, C&B) ups
    | *   07979bd    (HEAD -> master, origin/master) Merge pull request #2 from djpolmd/C&B
    | |\  
    | |/  
    |/|   
    * | be3caa3      adding refferal  for 10% bonus
    | *   6d15c25    Merge pull request #1 from djpolmd/C&B
    | |\  
    | |/  
    |/|   
    * | e6f74d8      referral adding
    * | df7ca34      some commit
    * | 9bf76a8       referal sution populate
    * | ac3c036      checkout && referral
    * | 706e83e      (JWT) referral
    * | 473f948      (origin/JWT) add UserController
    * | 6600f57      Adding JWT : ok
    * | 698137e      add JWT AUTH dependence
    


 ## Описание :
Приложение является ли демонстративной и не может использоватся как финальное комерчиское приложение. 
Все материалю использованы выще являюся  property of Open Source: Laravel and PHP Zend Framework, Git -  комюнити.


Для быстрого запуска можно использовать сиды после миграции.  Отыскать коменты в Model factory.

   Правило определяюшие партнёров приглашонных  от родителей  находится в  юзер контролере. и не учитывается модельной фабрикой, 
поскольку не является основной бизнес логикой. Также это надо учитывать, пользуясь сидамы - это не генерируется. 
Толко в ходе ручьного тестирование. 
    Есть Хард связь в таблице Referral означяет что приглашонный  реферал не может принадлежать нескольким родителям.
 Это правило определяется как и логикой так и уникальным свойтвом поле таблицы "referral" (uniq). 

Подсёт чекущего баланса (состояние сщёто произходит птолько по заверщённым платежам имеющие статус "completed") 
В люмен не включины зависимоти Passport, несмотря что мы работаем с JWT можно вызвать и эти зависимости отдельно через композер. 
Также можно организовать функционал для супер юзер - через сервиз провайдер. Также нужно опредилится с политекой пользователей которую тоже нужно прописать.
 Но это отдельная тема, может скоро выложу в хаб наработки в отдельном проэкте. Политика пользоватей может оперделятся и 
 отдельным фронтенд сервером в связи  с (vuex - redux). 

Дальще: 
- Сheсkout нужно организовать в queue. c логированием эксепшен в логдаш либо в кибану а лутше в обе.
- Также вычясления из чекоут и запись на сщёт пользоватля необходимо также оганизовать в queue (FIFO)
при этом  ищё нужен audit модуль . 
- Шаблон модели Checkout взят из Mastercard API  но без реального процессинга.
- Время сменны токена доступа можно  легко сменить а также добавить запись. 

