# PHP Project CI/CD Pipeline

This repository uses a Jenkins pipeline to automate various aspects of the development workflow, including code linting, coding standards checking, and unit testing for a PHP project.

## Pipeline Overview

The Jenkins pipeline defined in the `Jenkinsfile` performs the following stages:

1. **Checkout**: Retrieves the latest code from the Git repository.
2. **Set Up PHP**: Installs PHP and required extensions.
3. **Run PHP Linter**: Uses PHP's built-in linter to check PHP files for syntax errors.
4. **Run PHP_CodeSniffer**: Checks code against the PSR-12 standard using PHP_CodeSniffer.
5. **Run PHPUnit Tests**: Executes PHPUnit tests to verify code functionality.
6. **Deploy Using SSH PUBLISHER**: Copy file to target webserver 


***PRE-Requists***

1 - please make sure to define below Env Variable on webserver :
```php
$servername = getenv('DB_HOST');
$username = getenv('DB_USER'); // default username for MySQL
$password = getenv('DB_PASSWORD');; // default password for MySQL
```
2 - make sure below packages installated on jenkiens worker : 
```bash
php7 phpunit phpcs 
```

3 - make sure below packages installated on Webserver : 
```bash
php7 php-mysqli 
```

4 - Update Firewall setting on target webserver  : 
```bash
sudo firewall-cmd --permanent --add-port=80/tcp  ## in case of http
sudo firewall-cmd --permanent --add-port=443/tcp  ## in case of https 
```
