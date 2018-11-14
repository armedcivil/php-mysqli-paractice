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

If you get following output, you couled install.

```
      Name                    Command               State                 Ports
---------------------------------------------------------------------------------------------
practice_mysql_1   docker-entrypoint.sh mysql ...   Up      0.0.0.0:3306->3306/tcp, 33060/tcp
practice_php_1     docker-php-entrypoint apac ...   Up      0.0.0.0:15000->80/tcp
```

## Browse

Open following link on browsser.

http://localshot:15000/index.php