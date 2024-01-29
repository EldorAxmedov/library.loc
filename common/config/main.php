<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['queue'],
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=127.0.0.1;dbname=library',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',

        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
            'cache' => 'cache' //Включаем кеширование
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // Компонент подключения к БД или его конфиг
            'tableName' => '{{%queue}}', // Имя таблицы
            'channel' => 'studentJob', // Выбранный для очереди канал
            'ttr' => 8 * 60, // Время выполнения задания
            'mutex' => \yii\mutex\MysqlMutex::class, // Мьютекс для синхронизации запросов
            'as log' => \yii\queue\LogBehavior::class,
        ],
        // Asia/Tashkent
        'formatter' => [
            'class' => \yii\i18n\Formatter::class,
            'timeZone' => 'Asia/Tashkent',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'defaultTimeZone' => 'Asia/Tashkent',
            'locale' => 'ru-RU',
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'currencyCode' => 'UZS',
        ],
    ],
];
