<?php

//----------------------------
// DATABASE CONFIGURATION
//----------------------------

/*

Valid types (adapters) are Postgres & MySQL:

'type' must be one of: 'pgsql' or 'mysql'

*/

//require_once(realpath(dirname(__FILE__)).'/../../../shared/config/config.php');

return array(
        'db' => array(
                'development' => array(
                        'type'      => 'mysql',
                        'host'      => app()->config['db']['server'],
                        'port'      => app()->config['db']['port'],
                        'database'  => app()->config['db']['database'],
                        'user'      => app()->config['db']['username'],
                        'password'  => app()->config['db']['password'],
                        //'directory' => 'custom_name',
                        //'socket' => '/var/run/mysqld/mysqld.sock'
                ),
        ),

        'table_prefix' => app()->config('tablePrefix'),

        'migrations_dir' => RUCKUSING_WORKING_BASE . DIRECTORY_SEPARATOR . 'migrations',

        'db_dir' => RUCKUSING_WORKING_BASE . DIRECTORY_SEPARATOR . 'db',

        'log_dir' => RUCKUSING_WORKING_BASE . DIRECTORY_SEPARATOR . 'logs',

        'ruckusing_base' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'

);
