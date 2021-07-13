# Forum

![](https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=https%3A%2F%2Fgithub.com%2Farshetamine%2Fforum&count_bg=%23ab7def&title_bg=%23555555&icon=&icon_color=%23E7E7E7&title=hits&edge_flat=false)

#### Laravel based open-source forum application built for the modern web.

###### Clone and install composer dependencies.

```
$ git clone git@github.com:arsovskidev/forum.git
$ cd forum

$ composer install
```

###### Rename the .env.example file to .env and change the following settings.

```
$ mv .env.example .env
$ nano .env

DB_DATABASE= YOUR_DATABASE_NAME
DB_USERNAME= YOUR_MYSQL_USERNAME
DB_PASSWORD= YOUR_MYSQL_PASSWORD
```

###### Migrate the database and seed it.

```
$ php artisan migrate --seed
```

###### You are now done with setting up, go ahead and run the project!

```
$ php artisan serve
```

###### Feel free to contribute.
