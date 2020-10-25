<?php

use Framework\Database;

define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'tasks_app');
define('DATABASE_USER', 'tasks_app_user');
define('DATABASE_PASSWORD', 'password');

Database::connect();
