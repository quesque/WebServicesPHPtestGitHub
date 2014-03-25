<?php

// Identifiants pour la base de données. Nécessaires à PDO2.
define('SQL_DSN','mysql:dbname=fbay;host=localhost');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', '');
define('SQL_OPTIONS', 'array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")');

define('CHEMIN_MODELE', 'modeles/');
define('CHEMIN_LIB',    'libs/');
