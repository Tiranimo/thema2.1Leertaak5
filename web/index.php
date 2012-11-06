<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

//$app['autoloader']->registerNamespace('SilexExtension', __DIR__ . '/vendor/silex-extension/src');

// $app->register(new SilexExtension\MongoDbExtension(), array(
//     'mongodb.class_path' => __DIR__ . '/../vendor/mongodb/lib',
//     'mongodb.connection' => array(
//         'server' => 'mongodb://mysecretuser:mysecretpassw@localhost',
//         'options' => array(),
//         'eventmanager' => function($eventmanager) {
//         }
//     )
// ));



$app->get('/hello', function() {
    return 'Hello!';
});

$app->run();
