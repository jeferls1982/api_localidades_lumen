<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\PaisController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post("/register", "UserController@register");
$router->post("/login", "UserController@login");





$router->get('/ping', function () use ($router) {
    return response()->json("pong");
});


$router->get("/paises", "PaisController@index");
$router->get("/paises/{id}", "PaisController@show");
$router->post("/paises", "PaisController@store");
$router->put("/paises/{id}", "PaisController@update");
$router->delete("/paises/{id}", "PaisController@destroy");


$router->get("/estados", "EstadoController@index");
$router->get("/estados/{id}", "EstadoController@show");
$router->post("/estados", "EstadoController@store");
$router->put("/estados/{id}", "EstadoController@update");
$router->delete("/estados/{id}", "EstadoController@destroy");

$router->get("/cidades", "CidadeController@index");
$router->get("/cidades/{id}", "CidadeController@show");
$router->post("/cidades", "CidadeController@store");
$router->put("/cidades/{id}", "CidadeController@update");
$router->delete("/cidades/{id}", "CidadeController@destroy");
