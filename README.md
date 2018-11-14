# PHP, MySQL, mysqli practice on docker project

## Environments

|Name|Version|
|----|----|
|PHP|7.0|
|MySQL|5.7|

## Setup server

execute following commands

```
$ cd php-mysqli-paractice
$ docker-compose build
$ docker-compose up -d
$ docker-compose ps
```

If you get following output, you couled setup server.

```
      Name                    Command               State                 Ports
---------------------------------------------------------------------------------------------
practice_mysql_1   docker-entrypoint.sh mysql ...   Up      0.0.0.0:3306->3306/tcp, 33060/tcp
practice_php_1     docker-php-entrypoint apac ...   Up      0.0.0.0:15000->80/tcp
```

## Create table

Execute followin command for login mysql server.

```
$ docker-compose exec mysql bash
```

Go to mysql console in mysql server.

```
# mysql -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE
```

Create table and logout.

```
mysql> create table app.memos (id int auto_increment not null primary key, memo text(65535), user_name char(20));
mysql> quit
# exit
```

## Browse

Open following link on browsser.

http://localhost:15000/index.php