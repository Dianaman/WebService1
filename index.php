<?php
include_once('servidor/Personas.php');
/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require 'vendor/autoload.php';

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
/**
* GET: Para consultar y leer recursos
* POST: Para crear recursos
* PUT: Para editar recursos
* DELETE: Para eliminar recursos
*
*  GET: Para consultar y leer recursos */

$app->get('/', function ($request, $response, $args) {
    $response->write("Welcome to Slim!");
    return $response;
});

$app->get('/usuarios[/]', function ($request, $response, $args) {
    $datos=Persona::TraerTodasLasPersonas();
    $response->write(json_encode($datos));
    
    return $response;
});

$app->get('/usuario[/{id}[/{name}]]', function ($request, $response, $args) {
    $response->write("Datos usuario ");
    var_dump($args);
    return $response;
});
/* POST: Para crear recursos */
$app->post('/usuario/{persona}', function ($request, $response, $args) {
    $persona = json_decode($args['persona']);
    Persona::InsertarPersona($persona);
    $response->write("ingresado", $persona);
var_dump($args);
    return $response;
});

// /* PUT: Para editar recursos */
$app->put('/usuario/{persona}', function ($request, $response, $args) {
    $persona = json_decode($args['persona']);
    Persona::ModificarPersona($persona);
    $response->write("modificado", $args);
    return $response;
});

// /* DELETE: Para eliminar recursos */
$app->delete('/usuario/{id}', function ($request, $response, $args) {
    echo $args['id'];
    Persona::BorrarPersona($args['id']);
    $response->write("borrar !");
    return $response;
});
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
