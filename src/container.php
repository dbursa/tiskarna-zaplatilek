<?php

use Dibi\Connection;
use Slim\Views\Twig;

/*************************************
 * Set all dependencies into container
 * in this file
 */


/**
 * Set path to twig templates and enable / disable cache
 * 
 */
$container->set('view', function() use ($app) {
    $container = $app->getContainer();
    return ($container->get('config')['templateCache']) ? 
        Twig::create('./src/Templates', ['cache' => 'cache/']) : 
        Twig::create('./src/Templates', ['cache' => false]);
});
/**
 * If database enabled, put instance of
 * Dibi into container
 */
$container->set('db', function() use ($app) {
    $container = $app->getContainer();
    $config = $container->get('config');

    if ($container->get('config')['usingDatabase'])
    {
        return new Connection([
            'driver' => $config['dbDriver'],
            'host' => $config['dbHost'],
            'username' => $config['dbUsername'],
            'password' => $config['dbPassword'],
            'database' => $config['dbDatabase'],
        ]);
    }else {
        return null;
    }
});

/**
 * If emails enabled, put instance of
 * swiftmailer into container
 */
$container->set('mailer', function() use ($app) {
    $container = $app->getContainer();
    $config = $container->get('config');

    if ($container->get('config')['usingMailer'])
    {
        $transport = (new Swift_SmtpTransport($config['smtpHost'], $config['smtpPort']))
        ->setUsername($config['smtpUsername'])
        ->setPassword($config['smtpPassword']);
        $mailer = new Swift_Mailer($transport);
        return $mailer;
    }else{
        return null;
    }
});
