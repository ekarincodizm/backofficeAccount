<?php

return array(
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=account_ple',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '1234',
            'charset' => 'utf8',
            'class' => 'CDbConnection',
        ),
    )
);