<?php
/**
 * Created by PhpStorm.
 * User: sligx
 * Date: 9/19/2018
 * Time: 11:09 AM
 */
/* 1. --DIRECTORIES-- */
define('VIEW_PATH', __DIR__ . '/../view/');
define('JS_PATH', __DIR__ . '/../../assets/js/');
define('CSS_PATH', __DIR__ . '/../../assets/css/');
define('UPLOADS_PATH', __DIR__ . '/../../uploads/');
/* 2. ---DATABASE---- */
// ' ' are critical in $dsn parameters (you were warned)
define('SQL',		'mysql: ');	                // type of sql db we connecting to
define('HOST',		'host=localhost; ');	    // host, which we want to connect to
define('PORT',		'port=####; ');			    // port, which we want to connect to
define('DATABASE',	'dbname=activica');         // database name to connect to
define('USER',		'root');	                // sql database username
define('PASSWORD',	'');	                    // sql database password
define('CAN_REGISTER',	'any');
define('DEFAULT_ROLE',	'member');
define('SECURE',	FALSE);		// FOR DEVELOPMENT ONLY!