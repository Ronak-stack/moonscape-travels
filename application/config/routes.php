<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['admin'] = 'Dashboard';
$route['login'] = 'Login';
$route['admin/login'] = 'Login/login';
$route['admin/logout'] = 'Dashboard/logout';
$route['admin/add'] = 'Dashboard/addDefaultUser';

// Package Manager
$route['admin/packages/add'] = 'Package/add';
$route['admin/packages/list'] = 'Package';
$route['admin/packages/details/(:num)'] = 'Package/details/$1';
$route['admin/packages/delete/(:num)'] = 'Package/delete/$1';
$route['admin/package/update/status'] = 'Package/updateStatus';
$route['admin/packages/published/(:num)'] = 'Package/publishPackage/$1';
$route['admin/packages/un/published/(:num)'] = 'Package/unPublishPackage/$1';
$route['admin/package/update/show/(:num)'] = 'Package/updatePackageShow/$1';
$route['admin/package/update/(:num)'] = 'Package/updatePackage/$1';

// Itinerary Manager
$route['admin/itineraries/add'] = 'Itinerary/add';
$route['admin/itineraries/list'] = 'Itinerary';
$route['admin/itineraries/update'] = 'Itinerary/update';
$route['admin/itineraries/delete/(:num)'] = 'Itinerary/delete/$1';

// Days Manager
$route['admin/days/add'] = 'Days/addDays';
$route['admin/days/list'] = 'Days/showDays';
$route['admin/days/find/(:num)'] = 'Days/findDay/$1';
$route['admin/days/delete/(:num)'] = 'Days/delete/$1';

$route['admin/cars/add'] = 'Car/addCar';
$route['admin/cars/list'] = 'Car/carList';
$route['admin/cars/categories'] = 'Car/showCarCategories';
$route['admin/cars/categories/list'] = 'Car/showCarCategories';
$route['admin/cars/delete/(:num)'] = 'Car/deleteCar/$1';
$route['admin/car/update/(:num)'] = 'Car/updateCar/$1';
$route['admin/car/categories/add'] = 'Car/addCategory';
$route['admin/car/categories/update/(:num)'] = 'Car/category/$1';
$route['admin/cars/categories/delete/(:num)'] = 'Car/deleteCarCategories/$1';

$route['translate_uri_dashes'] = FALSE;
