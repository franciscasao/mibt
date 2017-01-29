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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['report'] = 'report/index';

$route['job/new'] = 'job/new_job';
$route['job/delete'] = 'job/delete';
$route['job/(:any)'] = 'job/view_job/$1';
$route['job'] = 'job';

$route['employee/edit/(:any)'] = 'employee/edit/$1';
$route['employee/list'] = 'employee/employee_list';
$route['employee/delete'] = 'employee/delete';
$route['employee/new'] = 'employee/new_employee';
$route['employee/(:any)'] = 'employee/view/$1';
$route['employee'] = 'employee';

$route['expense/edit/(:any)'] = 'expense/edit/$1';
$route['expense/new'] = 'expense/new_expense';
$route['expense/(:any)/(:any)'] = 'expense/index/$1/$2';
$route['expense'] = 'expense';

$route['payment/new/(:any)'] = 'payment/new_payment/$1';
$route['payment/new'] = 'payment/new_payment';
$route['payment/edit/(:any)'] = 'payment/edit_payment/$1';
$route['payment/(:any)/(:any)'] = 'payment/index/$1/$2';
$route['payment'] = 'payment';

$route['course/delete'] = 'course/delete_course';
$route['course/edit/(:any)'] = "course/edit/$1";
$route['course/new'] = "course/new_course";
$route['course/(:any)'] = "course/view/$1";
$route['course'] = "course";

$route['student/delete'] = 'student/delete_student/';
$route['student/edit/(:any)'] = 'student/edit_student/$1';
$route['student/new'] = 'student/new_student';
$route['student/(:any)'] = "student/view/$1";
$route['student'] = "student";

$route['user'] = 'user/user';
$route['logout'] = 'user/logout';
$route['check'] = 'user/check';
$route['default_controller'] = 'user';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
