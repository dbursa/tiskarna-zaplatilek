<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Register routes here
 *
 * In inline routes, access container like $this->get()
 * In controller routes, access container like $this->container->get()
 */

/*****************************************************
 * DEFAULT ROUTES - YOU CAN DELETE THIS
 * Good for learning how you can use router.
 * There is small comment for each one.
 *****************************************************/

/**
 * Basic simple route
 */
$app->get('/', function (Request $request, Response $response) {
    return $this->get('view')->render($response, 'index.html');
});

/**
 * Basic simple route
 */
$app->get('/reference', function (Request $request, Response $response) {
    return $this->get('view')->render($response, 'reference.html');
});
$app->get('/kontakty', function (Request $request, Response $response) {
    return $this->get('view')->render($response, 'kontakt.html');
});

/**
 * Basic route using Controller TestController with method test()
 */
$app->get('/test', Phisolutions\Controllers\TestController::class . ':test');

/**
 * Named route which renders Twig template
 * Find templates in /src/Templates
 */
$app->get('/hello/{name}', function ($request, $response, $args) {

    return $this->get('view')->render($response, 'index.html', [
        'name' => $args['name'],
    ]);

})->setName('profile');

/**
 * This is how you send Email
 */
$app->get('/send/mail', function ($request, $response, $args) {
    // Create a message
    $message = (new Swift_Message('Wonderful Subject'))
        ->setFrom(['john@doe.com' => 'John Doe'])
        ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
        ->setBody('Here is the message itself')
    ;

    //Send the message
    $result = $this->get('mailer')->send($message);

    $response->getBody()->write((string) $result);
    return $response;
});

/**
 *
 *  _  _    ___  _  _
 * | || |  / _ \| || |
 * | || |_| | | | || |_
 * |__   _| | | |__   _|
 *    | | | |_| |  | |
 *    |_|  \___/   |_|
 *
 * Catch-all route to serve a 404 Not Found page if none of the routes match
 * NOTE: make sure this route is defined last
 */
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    return $this->get('view')->render($response, "404.html");
});
