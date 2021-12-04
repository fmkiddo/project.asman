<?php namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance'', increase by specifying the default
// route since we don't have to scan directories.
$routes->get ('{locale}/development/reset-cookie', 'FrontpageController::resetCookie');
$routes->get ('{locale}/client/setup/firsttime', 'SystemSetupController::firstTimeSetup');
$routes->get ('{locale}/assets/user-login', 'FrontpageController::authentication');
$routes->get ('{locale}/assets/authenticate-client', 'FrontpageController::doClientAuthentication');
$routes->get ('{locale}/assets/do-logout', 'FrontpageController::userLogout');
$routes->get ('{locale}/dashboard', 'DashboardController::displayDashboard');
$routes->get ('{locale}/dashboard/(:any)', 'DashboardController::displayDashboard/$1');

$routes->post ('{locale}/assets/user-login', 'FrontpageController::authentication');
$routes->post ('{locale}/dashboard/(:any)', 'DashboardController::displayDashboard/$1');
$routes->post ('{locale}/api/process', 'FrontendRequestController::postRequest');

$routes->add ('ajax-request/frontend', 'FrontendRequestController::ajaxRequest');
// $routes->add ('{locale}/docs', 'PortableDocumentController::loadPortableDocument');
$routes->add ('{locale}/docs/print', 'PortableDocumentController::loadPortableDocument');

$routes->put ('{locale}/api/get', 'FrontendRequestController::ajaxRequest');
$routes->put ('{locale}/api/sent', 'FrontendRequestController::ajaxRequest');
$routes->put ('{locale}/client/setup/firsttime-process', 'SystemSetupController::doFirstTimeSetup');
$routes->put ('{locale}/assets/authenticate-client', 'FrontpageController::doClientAuthentication');
$routes->put ('{locale}/assets/do-userlogin', 'FrontpageController::doClientUserAuthentication');

/**
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
