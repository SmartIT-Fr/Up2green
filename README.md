Up2green
========

1) Installation
--------------------------------

### a) Clone the git Repository

Run the following commands:

``` bash
git clone git@github.com:SmartIT-Fr/Up2green.git
```

### b) Install the Vendor Libraries

``` bash
composer.phar install --dev
```

### c) Check your System Configuration

After installing vendors, make sure that your local system is properly
configured for Symfony. To do this, execute the following:

``` bash
php app/check.php
```

### d) Add apache  Virtual hosts and check the web configuration

You will have to create multiple virtual hosts to work and precise your domain
name in the parameters.yml file. You will have to create :

* www.yourdomain
* reforestation.yourdomain
* education.yourdomain
* admin.yourdomain
* association.yourdomain

Then, check the configuration : http://www.yourdomain/config.php

### e) Permissions

``` bash
sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs web/uploads
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs web/uploads
```

### f) Configuration your database and build

``` bash
cp app/config/parameters.dist.yml app/config/parameters.yml
vim app/config/parameters.yml
php app/console doctrine:build --all --and-load
```

### g) Add bootstrap symlinks

``` bash
php app/console mopa:bootstrap:symlink:less
```
