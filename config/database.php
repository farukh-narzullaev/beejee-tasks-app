<?php

use Framework\Database;

define('DATABASE_HOST', getenv('DATABASE_HOST'));
define('DATABASE_NAME', getenv('DATABASE_NAME'));
define('DATABASE_USER', getenv('DATABASE_USER'));
define('DATABASE_PASSWORD', getenv('DATABASE_PASSWORD'));

Database::connect();
