<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->get('/', function() use ($app) {
	$var = "harald";
    return $app['twig']->render('index.twig', array('name'=>$var));
});

$app->run();
