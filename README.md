# idlephp

## apache2 config file
```
$ sudo nano /etc/apache2/apache2.conf 
```

```
<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
</Directory>
```

Change it to

```
<Directory /home/USER/git/idlephp>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
        Allow from all
</Directory>
```

## default virtual host configuration file
```
$ sudo nano /etc/apache2/sites-available/000-default.conf
```

```
DocumentRoot /var/www/html
```

Change document root to

```
DocumentRoot /home/USER/git/idlephp
```

```
chmod 755 /home/USER
```

##  restart apache
```
sudo service apache2 restart
```

## install mysql
```
sudo apt install mysql-server
```
set privileges
```
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('[password]');
FLUSH PRIVILEGES;
```

## check service status
```
sudo systemctl status apache2.service
sudo service apache2 status
sudo systemctl restart mysql.service
sudo service mysql status
```

## install php
```
sudo apt install php libapache2-mod-php
sudo apt install php-mysql
```

sudo apt install phpmyadmin
sudo ln -s /etc/phpmyadmin/apache.conf /etc/apache2/conf-available/phpmyadmin.conf
sudo a2enconf phpmyadmin.conf
sudo systemctl reload apache2.service
