<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'      => '',
    'hostname' => getenv('DB_HOST_VINPLAY_ADMIN') ?: 'localhost',
    'port'     => getenv('DB_PORT_VINPLAY_ADMIN') ?: '3306',
    'username' => getenv('DB_USER_VINPLAY_ADMIN') ?: 'root',
    'password' => getenv('DB_PASS_VINPLAY_ADMIN') ?: '',
    'database' => getenv('DB_NAME_VINPLAY_ADMIN') ?: 'vinplay_admin',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

$db['vinplay'] = array(
    'dsn'      => '',
    'hostname' => getenv('DB_HOST_VINPLAY') ?: 'localhost',
    'port'     => getenv('DB_PORT_VINPLAY') ?: '3307',
    'username' => getenv('DB_USER_VINPLAY') ?: 'root',
    'password' => getenv('DB_PASS_VINPLAY') ?: '',
    'database' => getenv('DB_NAME_VINPLAY') ?: 'vinplay',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

$db['vinplay_minigame'] = array(
    'dsn'      => '',
    'hostname' => getenv('DB_HOST_MINIGAME') ?: 'localhost',
    'port'     => getenv('DB_PORT_MINIGAME') ?: '3308',
    'username' => getenv('DB_USER_MINIGAME') ?: 'root',
    'password' => getenv('DB_PASS_MINIGAME') ?: '',
    'database' => getenv('DB_NAME_MINIGAME') ?: 'vinplay_minigame',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);