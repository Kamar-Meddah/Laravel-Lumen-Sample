<?php

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

$router->group(['prefix' => 'Api'], function () use ($router) {

    $router->group(['prefix' => 'posts'], function () use ($router) {
        $router->get('all/{page:\d+}', 'PostsController@all');
        $router->get('last/{page:\d+}', 'PostsController@last');
        $router->get('search/{query:[A-z0-9]+}/{page:\d+}', 'PostsController@search');
        $router->get('find/{id:\d+}', 'PostsController@find');
        $router->get('lastByCatgory/{id:\d+}/{page:\d+}', 'PostsController@lastByCatgory');
    });

    $router->group(['prefix' => 'categories'], function () use ($router) {
        $router->get('all', 'CategoriesController@all');
    });

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('login', 'AuthController@login');
        $router->post('check', 'AuthController@checkToken');
    });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->post('signup', 'UsersController@signup');
    });

    $router->group(['prefix' => 'comments'], function () use ($router) {
        $router->get('post/{id:\d+}', 'CommentsController@findAll');
        $router->post('post', 'CommentsController@post');
        $router->delete('/{id:\d+}', 'CommentsController@delete');
    });

});

