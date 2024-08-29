# The Golden Pearl Restaurant
## Description
This is a website for a restaurant called The Golden Pearl. The website is a template to make other websites for other restaurants. 

## Getting Started
### Dependencies
- [PHP8 or later](https://www.php.net/downloads)
  - [Xdebug](https://xdebug.org/docs/install)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/)

### Installing

1. Run 
```bash
./build.sh
```

## Implementing

### Apache2 

you will need to add this config 
```conf
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /index.php [NC,L,QSA]
```
and add sqlite3 to dependency
```bash
apt install php8.2-sqlite3
a2enmod proxy_fcgi
a2enconf php8.2-fpm
```


## Author
- [Ethann Schneider](https://github.com/EthannSchneider/)

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details