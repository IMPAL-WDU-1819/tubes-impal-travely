<?php

require 'vendor/autoload.php';

$klein = new \Klein\Klein();

// HTTP error handlers
$klein->onHttpError(function ($code, $router) {
    switch ($code) {
        case 404:
            $router->response()->body(
                'You\'re lost'
            );
            break;
        default:
            $router->response()->body(
                'Bad things happened, error: '. $code
            );
    }
});

// Route handlers
$klein->respond('GET', '/', function ($request, $response, $service) {
    $service->render('views/index.html');
});

$klein->respond('GET', '/login', function ($request, $response, $service) {
    $service->render('views/login.html');
});

$klein->respond('GET', '/register', function ($request, $response, $service) {
    $service->render('views/register.html');
});

<<<<<<< HEAD
$klein->respond('GET', '/schedule', function ($request, $response, $service) {
    $service->render('views/schedule.html');
});

// Route namespaces
=======
// Route with namespace handlers
>>>>>>> 558a70468567eedda5a87c37d08c41fd89425daf
$klein->with('/admin', function () use ($klein) {
    $klein->respond('GET', '/refund', function ($request, $response, $service) {
        $service->render('views/admin/refund.html');
    });

    $klein->respond('GET', '/confirmation', function ($request, $response, $service) {
        $service->render('views/admin/confirmation.html');
    });
});

// Run
$klein->dispatch();