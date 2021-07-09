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
$route['default_controller'] = 'blog';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dash'] = 'dash';
$route['dash/login']['GET'] = 'dash/login';
$route['dash/login']['POST'] = 'dash/loginCheck';
$route['dash/changePasswd']['GET'] = 'dash/changePasswd';
$route['dash/changePasswd']['POST'] = 'dash/changePasswdCheck';

$route['dash/reset'] = 'dash/system_reset';

$route['dash/cpe'] = 'dash/CPE_Index';
$route['dash/cpe/upload'] = 'dash/CPE_Upload';
$route['dash/cpe/preview/([0-9]{5})'] = 'dash/previewCPE/$1';
$route['dash/cpe/delete/([0-9]{5})'] = 'dash/CPE_Delete/$1';

$route['dash/author'] = 'dash/author';
$route['dash/author/upload'] = 'dash/userUpload';
$route['dash/author/link']['GET'] = 'dash/linkEdit';
$route['dash/author/link']['POST'] = 'dash/linkEditPost';
$route['dash/author/info']['GET'] = 'dash/userInfo';
$route['dash/author/info']['POST'] = 'dash/userInfoPost';

$route['dash/category']['GET'] = 'article/category';
$route['dash/category']['POST'] = 'article/categoryNew';
$route['dash/category/view/C([0-9]{3})'] = 'article/categoryView/C$1';
$route['dash/category/tagView/(:any)'] = 'article/tagView/$1';
$route['dash/category/edit'] = 'article/categoryEdit';
$route['dash/category/delete/C([0-9]{3})'] = 'article/categoryDelete/C$1';

$route['dash/article']['GET'] = 'article/index';
$route['dash/article/new'] = 'article/postArticle';
$route['dash/article/preview/([0-9]{14})'] = 'article/previewArticle/$1';
$route['dash/article/edit/([0-9]{14})'] = 'article/ArticleEdit/$1';
$route['dash/article/save'] = 'article/postArticleSave';
$route['dash/article/publish/([0-9]{14})'] = 'article/publishArticle/$1';
$route['dash/article/draft/([0-9]{14})'] = 'article/draftArticle/$1';
$route['dash/article/delete/([0-9]{14})']['GET'] = 'article/ArticleDelete/$1';

$route['blog/(:num)'] = 'blog/index/$1';
$route['blog/about'] = 'blog/about';
$route['blog/article/([0-9]{14})'] = 'blog/SingleArticle/$1';
$route['blog/category/(:any)/(:num)'] = 'blog/categoryView/$1/$2';
$route['blog/tag/(:any)/(:num)'] = 'blog/tagView/$1/$2';
$route['blog/cpe'] = 'blog/cpeList';
$route['blog/cpe/view/([0-9]{5})'] = 'blog/cpeSingle/$1';