# mvc-lecture

> Basic application with MVC architecture

## Setup

1. Clone the repository and `cd` into it.

1. Install composer using:
    ```console
    > curl -s https://getcomposer.org/installer | php
    > sudo mv composer.phar /usr/local/bin/composer
    ```

1. Install dependencies and dump-autoload:
    ```console
    > composer install
    > composer dump-autoload
    ```
Here there are some steps which can be alternatively be performed by using setup_shellscript.sh
1. Copy `config/sample.config.php` as `config/config.php` and edit it accordingly:
    ```console
    > cp config/sample.config.php config/config.php
    # Edit the file using your mysql database credentials
    ```

1. Import schema present in `schema/schema.sql` in your database.

1. Serve the public folder at any port (say 8001):
    ```console
	> cd public
    > php -S localhost:8001
    ```
