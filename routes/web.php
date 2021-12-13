<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;


$router->post("/register", "AuthController@Register");
$router->post("/reset_password", "AuthController@ResetPassword");
$router->post("/verify/email/reset_password", "AuthController@VerifyEmailResetPassword");

$router->group(['middleware' => 'auth', 'prefix' => '/profile'], function () use ($router) {
    $router->post("/change_password", "AuthController@ChangePassword");
    $router->post("/update", "ChannelsController@UpdateProfile");
    $router->post("/subscription", "SubscriptionController@Subscribe");
    $router->post("/upload/video", "VideoController@Upload");
    $router->post("/upload/file", "FileController@Upload");
});
