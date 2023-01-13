Что бы работала данная утилитка после разворота на сервере apache 
нужно добавить в свой  apache2.conf  следующие строки 


```
LogFormat "{\"status_b\":false,\"remote_addr\":\"%a\",\"time_local\":\"%{%s}t\",\"request\":\"%r\",\"status\":\"%>s\",\"http_referer\":\"%{Referer}i\"}," json_log
CustomLog "/{это приложение опубликованное  на вебсервере }/storage/app/access.json" json_log
```
в моём случае моё приложение лежит по следующему пути 
```/var/www/loger-app```  
по этому след конфигурация будет у меня: 
```
LogFormat "{\"status_b\":false,\"remote_addr\":\"%a\",\"time_local\":\"%{%s}t\",\"request\":\"%r\",\"status\":\"%>s\",\"http_referer\":\"%{Referer}i\"}," json_log
CustomLog "/var/www/loger-app/storage/app/access.json" json_log
```

При установке приложения после копирования из Git и установокй .env 
следующие  команды обязательный 
composer install 
php artisan migrate 
php artisan optimize 
yarn build   

обязательное наличие на сервере: 
 php  > 8.1
 npm 8.19.3  или совместимый с yarn 1.22  

