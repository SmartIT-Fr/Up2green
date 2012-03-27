Up2green
========

1) Installation
--------------------------------

### a) Clone the git Repository

Run the following commands:

``` bash
git clone git@github.com:SmartIT-Fr/Up2green.git
```

### b) Check your System Configuration

Before you begin, make sure that your local system is properly configured
for Symfony. To do this, execute the following:

``` bash
php app/check.php
```

### c) Install Composer

``` bash
sudo su
cd /usr/bin/
curl -s http://getcomposer.org/installer | php
chmod a+x composer.phar
```


### d) Install the Vendor Libraries

``` bash
composer.phar install
```

### d) Access the Application via the Browser and check the config

    http://localhost/Symfony/web/config.php

### e) Install tools for assetic

 - node.js:

``` bash
git clone https://github.com/joyent/node.git
cd node
git checkout v0.6.7 //Try checking nodejs.org for what the stable version is
./configure
make
sudo make install
```

 - npm: (node package manager) 
 
``` bash
curl http://npmjs.org/install.sh | sh
```

 - less css and uglify-js:

``` bash
npm install less -g
npm install uglify-js -g
```

 - compass and sass gems:

``` bash
gem install compass
gem install sass
```

### f) Configuration your database and build

``` bash
cp app/config/parameters.ini-dist app/config/parameters.ini
vim app/config/parameters.ini
php app/console propel:database:create
php app/console propel:build --insert-sql
```