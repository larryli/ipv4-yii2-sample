<?php
/**
 * console.php
 *
 * Author: Larry Li <larryli@qq.com>
 */

Yii::setAlias('@ipv4-yii2', (dirname(__DIR__) . '/vendor/larryli/ipv4-yii2'));

$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'ipv4-yii2-sample-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        // ipv4 command
        'ipv4' => [
            'class' => 'larryli\ipv4\yii2\commands\Ipv4Controller',
        ],
        // you must copy the migrate files on @ipv4/Yii/Migrations to @app/migrations manually
        // or see [improve migrate command](https://github.com/yiisoft/yii2/issues/384)
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@ipv4-yii2/migrations',
        ],
    ],
    'vendorPath' => VENDOR_PATH,
    'components' => [
        // ipv4 component
        'ipv4' => [
            'class' => 'larryli\ipv4\yii2\IPv4',
            'providers' => [
                'monipdb' => [
                    'filename' => '@runtime/17monipdb.dat',
                ],
                'qqwry' => [
                    'filename' => '@runtime/qqwry.dat',
                ],
                'full' => [
                    'providers' => ['monipdb', 'qqwry'], // ex. 'monipdb', 'qqwry', ['qqwry', 'monipdb']
                ],
                'mini' => [
                    'providers' => 'full',   // ex. ['monipdb', 'qqwry'], 'monipdb', 'qqwry', ['qqwry', 'monipdb']
                ],
                'china' => [
                    'providers' => 'full',
                ],
                'world' => [
                    'providers' => 'full',
                ],
                'freeipip',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => [],
];

return $config;
