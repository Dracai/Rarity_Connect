<?php

namespace Config;

use App\Controllers\Administrator;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('GeneralUser');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'GeneralUser::index');
$routes->get('logout', 'GeneralUser::logout');
$routes->get('dashboard', 'GeneralUser::dashboard', ['filter' => 'AllAuth']);
$routes->get('admin_functions_page', 'Administrator::viewUsers', ['filter' => 'AdminAuth']);
$routes->get('aboutus', 'GeneralUser::aboutUs');
$routes->get('rules', 'GeneralUser::rules');
$routes->match(['get', 'post'], 'profile', 'Users::profile', ['filter' => 'UserAuth']);
$routes->get('forum/reported_posts', 'Administrator::displayReportedPosts', ['filter' => 'AdminAuth']);
$routes->get('forum/postsPage', 'GeneralUser::displayPosts', ['filter' => 'AllAuth']);
$routes->match(['get', 'post'], 'forum/createPost', 'GeneralUser::createPost', ['filter' => 'AllAuth']);
$routes->match(['get', 'post'], 'forum/(:any)', 'GeneralUser::viewPost/$1', ['filter' => 'AllAuth']);
$routes->match(['get', 'post'], 'viewUsers', 'Administrator::viewUsers', ['filter' => 'AllAuth']);
$routes->match(['get', 'post'], 'login', 'GeneralUser::login', ['filter' => 'LoggedInAuth']);
$routes->match(['get', 'post'], 'register', 'GeneralUser::register', ['filter' => 'LoggedInAuth']);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
