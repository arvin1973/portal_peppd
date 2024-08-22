<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'C_pagesController/home';
$route['news'] = 'C_pagesController/news';
$route['news/(:any)'] = 'C_pagesController/news/$1';
$route['publication'] = 'C_pagesController/publication';
$route['file_publication/(:any)/(:any)'] = 'C_pagesController/file_publication/$1/$2';
$route['aplikasi'] = 'C_pagesController/aplikasi';
$route['kegiatan'] = 'C_pagesController/kegiatan';
$route['karir'] = 'C_pagesController/karir';
$route['kegiatan/penghargaan'] = 'C_pagesController/penghargaan';
$route['kegiatan/pemantauan'] = 'C_pagesController/pemantauan';
$route['kegiatan/evaluasi'] = 'C_pagesController/evaluasi';
$route['kegiatan/koordinasi'] = 'C_pagesController/koordinasi';

$route['get_data'] = 'C_pagesController/get_data';
// $route['test'] = 'C_pagesController/test';

$route['infograph/export'] =  'C_infographController/export';

// $route['infograph'] = 'C_pagesController/infograph';
$route['infograph'] = 'C_infographController/index';

$route['kegiatan/penghargaan/profil'] = 'C_pagesController/profil_ppd';
$route['kegiatan/penghargaan/pedoman'] = 'C_pagesController/pedoman_ppd';

$route['article_pagination/(:any)'] = 'C_pagesController/article_pagination/$1';

$route['logPortalController/store'] = 'C_logPortalController/store';

$route['commentController/index'] = 'C_commentController/index';
$route['commentController/store'] = 'C_commentController/store';
$route['commentController/destroy'] = 'C_commentController/destroy';

$route['infographController/index'] = 'C_infographController/index';

$route['login'] = 'auth/C_loginController/login';
$route['logout'] = 'auth/C_loginController/logout';
$route['register'] = 'auth/C_loginController/register';


$route['dashboard'] = 'admin/C_dashboard/dashboard';

$route['user'] = 'admin/C_usersController/user';
$route['user/(:num)'] = 'admin/C_usersController/show/$1';
$route['user/(:num)/edit'] = 'admin/C_usersController/edit/$1';
$route['user/(:num)/delete'] = 'admin/C_usersController/destroy/$1';
$route['user/create'] = 'admin/C_usersController/create';

$route['article'] = 'admin/C_articlesController/article';
$route['article/(:any)/edit'] = 'admin/C_articlesController/edit/$1';
$route['article/(:num)/delete'] = 'admin/C_articlesController/destroy/$1';
$route['article/create'] = 'admin/C_articlesController/create';

$route['publication_menu'] = 'admin/C_publicationController/publication';
$route['publication_menu/(:num)/edit'] = 'admin/C_publicationController/edit/$1';
$route['publication_menu/(:num)/delete'] = 'admin/C_publicationController/destroy/$1';
$route['publication_menu/create'] = 'admin/C_publicationController/create';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;