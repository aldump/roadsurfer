# Coding Challenge

So, to start this simple application, you need to do following steps:

- Run from the project root:

```
docker-compose up -d
docker-compose run php composer install
```
- Open [http://localhost/api/doc](http://localhost/api/doc)


To load fixtures for test run:

```
docker-compose run php bin/console h:f:l  
```
