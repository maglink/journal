<?php
return array(
    'db' => array(
        'driver'         => 'Pdo_MySQL',
        'dsn'            => 'mysql:dbname=journal;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
