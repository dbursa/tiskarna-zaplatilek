<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/api/mail', function (Request $request, Response $response) {
    $json = $request->getBody();
    $body = json_decode($json, true);

    // Validate
    $error = false;
    $errors = [];

    if ($body['form_first_name'] == null) {
        $error = true;
        $errors['form_first_name'] = 'Jméno je povinné pole';
    }
    if ($body['form_last_name'] == null) {
        $error = true;
        $errors['form_last_name'] = 'Příjmení je povinné pole';
    }
    if (!filter_var($body['form_email'], FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $errors['form_email'] = 'Email je povinné pole a musí mít formát emailu';
    }
    if ($body['form_phone'] == null) {
        $error = true;
        $errors['form_phone'] = 'Telefonní číslo je povinné pole';
    }
    if ($body['form_message'] == null) {
        $error = true;
        $errors['form_message'] = 'Vaše zpráva je povinné pole';
    }

    if ($error == true) {
        $response->getBody()->write(json_encode($errors));
        return $response->withStatus(400);
    } else {
        $question_email = $body['form_email'];
        $question_phone = $body['form_phone'];
        $question_name = $body['form_first_name'] . " " . $body['form_last_name'];
        $question_message = $body['form_message'];

        $message =
            '<p> Jméno a příjmení: <b>' . $question_name . '</b></p>'
            . '<p> Telefon: <b>' . $question_phone . '</b></p>'
            . '<p> Email: <b>' . $question_email . '</b></p>'
            . '<hr>' . $question_message . '</hr>';

        // Create a message
        $message = (new Swift_Message('Tiskárna Zaplatílek: email od: ' . $question_email))
            ->setFrom(['tiskarnazaplatileksender@seznam.cz' => 'Web Tiskárna Zaplatílek'])
            ->setTo(['vrerabek@gmail.com'])
            ->setBody($message)
            ->setContentType("text/html")
        ;

        //Send the message
        $result = $this->get('mailer')->send($message);

        $newResponse = $response->withStatus(200);
        return $newResponse;
    }
});