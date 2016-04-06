<?php

/* database connection */

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBHOST', 'localhost');
    define('DBNAME', 'test');
} else {
    define('DBUSER', 'db-user');
    define('DBPASS', 'db-pass');
    define('DBHOST', 'your-db-host.com');
    define('DBNAME', 'db-name');
}
define('DB', 'mysql:host=' . DBHOST . ';dbname=' . DBNAME);
