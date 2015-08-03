Installation:
1. Создать папку 'dc-web-ui' в var/www;
    svn co "svn+ssh://hce@192.168.253.1/hce/dc-web-ui/trunk"
2. Запустить скрипт 'dc-web-ui/app/permissions.sh';
3. Выбрать папку 'dc-web-ui/app' как "webRoot" в настройках apache/nginx;
4. Указать в 'dc-web-ui/app/protected/config/main.php' корректных пользователя и пароль от mySql;
5. mysql> source path_to_folder/dc-web-ui/app/protected/modules/user/data/schema.mysql.sql;

6. Авторизоваться http://....../dc-web-ui/app/index.php?r=user/login (admin:admin)

7. Изменить в конфиге для модуля rights параметр:
'dc-web-ui/app/protected/config/main.php'

'modules'=>array(
    'rights'=>array(
        'install'=>true,

8. Пройти по ссылке для инсталяции модуля Users: http://....../dc-web-ui/index.php?r=rights/install;
9. Изменить в конфиге для модуля rights параметр:
'dc-web-ui/trunk/app/protected/config/main.php'

'modules'=>array(
    'rights'=>array(
        'install'=>false,

10. mysql> source path_to_folder/dc-web-ui/app/protected/modules/rights/data/base_assignments.sql.