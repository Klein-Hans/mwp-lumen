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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });


// $version = env('APP_VERSION', 'tes');

// $router->group(['prefix' => 'api/v'.$version], function () use ($router) {

    // Auth
    $router->group(['prefix' => 'login'], function () use ($router) {
        $router->post('/', 'AuthController@authenticate');
    });
    
    $router->group(['prefix' => 'projects'], function () use ($router) 
    {
        $router->get('/', 'ProjectsController@getProjects');
        $router->get('/{column}/{value}', 'ProjectsController@getProjectsFiltered');
        $router->get('{id}', 'ProjectsController@getProjectsById');    
    });

    $router->group(['prefix' => 'email'], function () use ($router) 
    {
        $router->post('/', 'MailController@sendEmail');
    });

    $router->group(['prefix' => 'regions'], function () use ($router) 
    {
        $router->get('/', 'RegionsController@getRegions');
        $router->get('{id}', 'RegionsController@getRegionsById');
    });

    $router->group(['prefix' => 'unit_types'], function () use ($router) 
    {
        $router->get('/', 'UnitTypesController@getUnitTypes');
        $router->get('{id}', 'UnitTypesController@getUnitTypesById');
    });

    $router->group(['prefix' => 'news'], function () use ($router) 
    {
        $router->get('/', 'NewsController@getArticles');
        $router->get('{id}', 'NewsController@getArticlesById');
    });

    $router->group(['prefix' => 'users'], function () use ($router) 
    {
        $router->get('/', 'UsersController@getUsers');
        $router->get('{id}', 'UsersController@getUsersById');
    });

    // Secured routes
    $router->group(['middleware' => 'jwt-auth'], function () use ($router) 
    {
        // Projects Routes
        $router->group(['prefix' => 'projects'], function () use ($router) 
        {
            $router->post('', 'ProjectsController@postProjects');
            $router->put('{id}', 'ProjectsController@putProjects');
            $router->put('', 'ProjectsController@putProjectsMass');
            $router->delete('{id}', 'ProjectsController@deleteProjects');
            $router->patch('{id}', 'ProjectsController@restoreProjects');
        });
        
        // Regions Routes
        $router->group(['prefix' => 'regions'], function () use ($router) 
        {
            $router->post('/', 'RegionsController@postRegions');
            $router->put('{id}', 'RegionsController@putRegions');
            $router->delete('{id}', 'RegionsController@deleteRegions');
            $router->patch('{id}', 'RegionsController@restoreRegions');
        });
    
        // Cities Routes
        $router->group(['prefix' => 'cities'], function () use ($router) 
        {
            $router->post('/', 'CitiesController@postRegions');
            $router->put('{id}', 'CitiesController@putRegions');
            $router->delete('{id}', 'CitiesController@deleteRegions');
            $router->patch('{id}', 'CitiesController@restoreRegions');
        });

        // Townships Routes
        $router->group(['prefix' => 'townships'], function () use ($router) 
        {
            $router->get('townships', 'TownshipsController@all');
            $router->get('townships/{id}', 'TownshipsController@get');
            $router->post('/', 'TownshipsController@postRegions');
            $router->put('{id}', 'TownshipsController@putRegions');
            $router->delete('{id}', 'TownshipsController@deleteRegions');
            $router->patch('{id}', 'TownshipsController@restoreRegions');
        });

        // Unit Types Routes
        $router->group(['prefix' => 'unit_types'], function () use ($router) 
        {
            $router->post('/', 'UnitTypesController@postUnitTypes');
            $router->put('{id}', 'UnitTypesController@putUnitTypes');
            $router->delete('{id}', 'UnitTypesController@deleteUnitTypes');
            $router->patch('{id}', 'UnitTypesController@restoreUnitTypes');
        });
        
        // Articles Routes
        $router->group(['prefix' => 'news'], function () use ($router) 
        {
            $router->post('/', 'NewsController@postArticles');
            $router->put('{id}', 'NewsController@putArticles');
            $router->delete('{id}', 'NewsController@deleteArticles');
            $router->patch('{id}', 'NewsController@restoreArticles');
        });

        // Users Routes
        $router->group(['prefix' => 'users'], function () use ($router) 
        {
            $router->post('/', 'UsersController@postUsers');
            $router->put('{id}', 'UsersController@putUsers');
            $router->delete('{id}', 'UsersController@deleteUsers');
            $router->patch('{id}', 'UsersController@restoreUsers');
        });

        // User Types Routes
        $router->group(['prefix' => 'user-types'], function () use ($router) 
        {
            $router->get('/', 'UserTypesController@getUsers');
            $router->get('{id}', 'UserTypesController@getUsersById');
            $router->post('/', 'UserTypesController@postUsers');
            $router->put('{id}', 'UserTypesController@putUsers');
            $router->delete('{id}', 'UserTypesController@deleteUsers');
            $router->patch('{id}', 'UserTypesController@restoreUsers');
        });

        /**
         * Routes for resource inquiries
         */
        $router->group(['prefix' => 'inquiries'], function () use ($router) 
        {
            $router->get('/', 'InquiriesController@postUsers');
            $router->get('{id}', 'InquiriesController@putUsers');
            $router->delete('{id}', 'InquiriesController@deleteUsers');
            $router->patch('{id}', 'UserTypesController@restoreUsers');
        });
    });
