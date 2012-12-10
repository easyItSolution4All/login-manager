<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Home route
Route::get('/', array('uses' => 'users@index'));

// Session routes
Route::any('sessions', array('uses' => 'sessions@index'));

Route::group(array('before' => 'auth'), function() {
	// Clients
	Route::any('clients', array('uses' => 'clients@index'));
	Route::get('clients/(:num)', array('uses' => 'clients@view'));
	Route::post('clients/(:num)', array('uses' => 'clients@update'));
	Route::delete('clients/(:num)', array('uses' => 'clients@index'));
	
	// Projects
	Route::any('projects', array('uses' => 'projects@index'));
	Route::get('projects/(:num)', array('uses' => 'projects@view'));
	Route::post('projects/(:num)', array('uses' => 'projects@update'));
	Route::delete('projects/(:num)', array('uses' => 'projects@index'));
	
	// Logins
	Route::any('logins', array('uses' => 'logins@index'));
	Route::get('logins/(:num)', array('uses' => 'logins@view'));
	Route::post('logins/(:num)', array('uses' => 'logins@update'));
	Route::delete('logins/(:num)', array('uses' => 'logins@index'));
	Route::post('logins/access', array('uses' => 'logins@access'));
	
	// Favourites
	Route::any('favourites', array('uses' => 'favourites@index'));

	// Users
	Route::any('users/profile', array('uses' => 'users@profile'));

	// Versioning
	Route::delete('versions/(:num)', array('uses' => 'versions@index'));
	Route::post('versions/revert/(:num)', array('uses' => 'versions@revert'));
});

/**
 * If the request type is not an AJAX request, then we simply want 
 * to return the main layout page, in this case it's home.index.
 */
Route::filter('response', function($response)
{
	// Redirects have no content and errors should handle their own layout.
	if ($response->status() > 300) return;

	if (!Request::ajax()) {
		$response->header('content-type', File::mime('html'));
		$response->content = View::make('home.index')->render();
	}
});

/**
 * Auth check, but only on ajax - cos all we're doing is rendering
 * HTML anyways.
 */
Route::filter('auth', function()
{
	if (Auth::guest() && Request::ajax()) return Response::json(array(), 401);
});

Event::listen('404', function()
{
	return Redirect::to('/');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

// Register assets to be rendered in the layout
View::composer('home.index', function($view) {
	Asset::add('main', 'css/main.css');
	Asset::add('jquery', 'js/lib/jquery.min.js');
	Asset::add('angular', 'js/lib/angular.min.js');
	Asset::add('angular-resource', 'js/lib/angular-resource.min.js');
	Asset::add('angular-cookies', 'js/lib/angular-cookies.min.js');
	Asset::add('aes', 'js/lib/aes.js');
	Asset::add('zero-clipboard', 'js/lib/ZeroClipboard.min.js');
	Asset::add('services', 'js/services.js');
	Asset::add('filters', 'js/filters.js');
	Asset::add('app', 'js/app.js');
	Asset::add('setup', 'js/setup.js');
	Asset::add('directives', 'js/directives.js');
	Asset::add('logins-controller', 'js/controllers/logins.js');
	Asset::add('clients-controller', 'js/controllers/clients.js');
	Asset::add('projects-controller', 'js/controllers/projects.js');
	Asset::add('help-controller', 'js/controllers/help.js');
	Asset::add('home-controller', 'js/controllers/home.js');
	Asset::add('users-controller', 'js/controllers/users.js');
});