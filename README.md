# ci-demo
CodeIgniter demo project

## Install

```bash

$ cd [webroot]

$ git clone https://github.com/bordee/ci-demo.git

$ cd ci-demo

$ composer install
```


## Config

Let's assume that you'd like the site to be available on:

    ci-demo.my-pc.lan

and your webroot is:

    /var/www

### Set up VirtualHost

(for Apache users only!)

Example:

```bash
<VirtualHost *:80>
    ServerName ci_demo
    ServerAlias ci-demo.my-pc.lan
    DocumentRoot /var/www/ci-demo

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    DirectoryIndex index.php

    <Directory "/var/www/ci-demo">
        Options +FollowSymLinks -Indexes
        AllowOverride All
    </Directory>

</VirtualHost>

```

After saving the changes the server should be restarted (or the server config should be reloaded)!

### Add domain to /etc/hosts file

Add the following line to your /etc/hosts file:

    127.0.0.1     ci-demo.my-pc.lan

### Create developement config files

You can change the default configuration by copying the config files you want to override from

    application/config/

to

    application/config/developement/

and changing the values as you like.

For example, database connection settings have to be set before trying out this demo.

### Import database dump

The default database dump file is located in the root of this project, named  ```ci-demo.sql```.

You can import the file using your favourite database administration too (like PHPMyAdmin, or MySQLWorkbench), or from command line:

```bash
    $ mysql -u username -p database_name < ci-demo.sql
```