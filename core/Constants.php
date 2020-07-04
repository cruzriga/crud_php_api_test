<?php
session_start();

require_once ('Config.php');

ini_set("allow_url_fopen","1");
setlocale(LC_ALL,"es_ES");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('BASE_URL', $config->base_url);
define('APP_NAME', $config->app_name);
define('APP_VERSION', $config->app_version);
define('DB_HOST',$config->db_host);
define('DB_USER',$config->db_user);
define('DB_PASSWORD',$config->db_password);
define('DB_DATABASE',$config->db_database);
define('DB_PORT',$config->db_port);
define('DB_COLLATION',$config->db_collation);
define('DEFAULT_CONTROLLER', $config->default_controller);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath($_SERVER['DOCUMENT_ROOT']).DS.$config->path.DS);
define('CORE', ROOT . 'core' . DS);
define('MODELS', ROOT . 'models' . DS);
define('VIEWS', ROOT . 'views' . DS);
define('CONTROLLERS', ROOT . 'controllers' . DS);

//====================================

define('PQR_NUEVO', 1);
define('PQR_EN_EJECUCION', 2);
define('PQR_CERRADO', 3);
