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


$route['default_controller'] = 'Welcome/home';
//view web site
$route['translate_uri_dashes'] = FALSE;
$route['home']['GET'] = 'Welcome/home';
$route['services']['GET']  = 'Welcome/services';
$route['about']['GET']  = 'Welcome/about';
$route['about/polices']['GET']  = 'Welcome/policies';
$route['about/covid19']['GET']  = 'Welcome/covid';
$route['products']['GET']  = 'Welcome/products';


$route['contacts']['GET']  = 'Welcome/contacts';
$route['employ']['GET']  = 'Welcome/employ';
$route['clients']['GET']  = 'Welcome/clients';
$route['api/services']['GET'] = 'HomeSite/getServices';
$route['api/personal']['GET'] = 'HomeSite/getPersonal';
$route['api/contacts']['GET'] = 'HomeSite/getContacts';
$route['api/sections']['GET'] = 'HomeSite/getSections';
$route['api/notices']['GET'] = 'HomeSite/getNotices';
$route['api/supplier']['GET'] = 'HomeSite/getSupplier';
$route['api/news']['GET'] = 'HomeSite/getNews';
$route['api/rubros']['GET'] = 'HomeSite/getRubros';
$route['api/publications']['GET'] = 'HomeSite/getPublications';
$route['api/charges']['GET'] = 'HomeSite/getCharges';
$route['api/categories']['GET'] = 'HomeSite/getCategory';
$route['api/supplier/select']['GET'] = 'HomeSite/getSupplierSelect';
$route['api/subcategories/(:num)']['GET'] = 'HomeSite/getSubcategories/$1';
$route['api/subsubcategories/(:num)']['GET'] = 'HomeSite/getSubSubcategories/$1';
$route['api/products/all']['GET'] = 'HomeSite/getAllProducts';
$route['api/policies']['GET'] = 'HomeSite/getPolicies'; 


// view and function cpanel 
$route['cpanel/login']['GET']  = 'Home/login';
$route['404_override'] = 'Home/error';
$route['api/login']['POST'] = 'Login/login_user';
$route['api/logout']['POST'] = 'Login/logout';
$route['api/load_page']['GET']= 'Home/load_page';
$route['api/recovery_email']['POST']= 'Login/recovery_email';
$route['api/recovery']['POST']= 'Login/recovery';
$route['api/new_password']['POST']= 'Login/new_password';
/* $route['login']['GET']= 'Login/index'; */


// HOME VIEWS ( SERVICES, BRANDS, NOTICES , NEWS)
$route['home/service']['GET'] = 'Services/adminServices';
$route['home/supplier']['GET'] = 'Supplier/adminSupplier';
$route['home/notices']['GET'] = 'Notices/adminNotices';
$route['home/news']['GET'] = 'News/adminNews';


$route['home/notices']['GET'] = 'Notices/adminNotices';
$route['cpanel/services']['GET'] = 'Services/cpanelServices';
$route['cpanel/employ']['GET'] ='Employ/cpanelEmploy';
$route['cpanel/about']['GET'] ='About/cpanelAbout';
$route['cpanel/contact']['GET'] ='Contact/cpanelContact';
$route['cpanel/policies']['GET'] ='Policies/cpanelPolicies';
$route['cpanel/client']['GET'] ='Client/cpanelClient';
$route['cpanel/products/section']['GET'] ='Product/sectionProduct';
$route['cpanel/home/section']['GET'] ='Sections/sectionHome';
$route['cpanel/covid']['GET'] ='Covid/adminCovid';


//HOME SERVICES - CPANEL
$route['api/home/get/services']['GET'] = 'Services/getServices'; //listo
$route['api/home/create/service']['POST'] = 'Services/createService';
$route['api/home/up/image/service/(:num)']['POST']  = 'Services/upImage/$1';
$route['api/home/up/image/edit/service/(:num)']['POST']  = 'Services/upImageUpload/$1';
$route['api/home/delete/service/(:num)']['POST'] = 'Services/deleteService/$1'; //listo
$route['api/home/update/service']['POST'] = 'Services/updateService';
$route['api/home/state/service']['POST'] = 'Services/changeState';

//HOME SUPPLIER - CPANEL
$route['api/home/get/supplier']['GET'] = 'Supplier/getSupplier'; //en espera
$route['api/home/create/supplier']['POST'] = 'Supplier/createSupplier';
$route['api/home/up/supplier/(:num)']['POST']  = 'Supplier/upImage/$1';
$route['api/home/delete/supplier/(:num)']['POST'] = 'Supplier/deleteSupplier/$1'; //listo
$route['api/home/update/supplier/(:num)']['POST'] = 'Supplier/updateSupplier';
$route['api/home/state/supplier']['POST'] = 'Supplier/changeState';
$route['api/home/edit/supplier']['POST'] = 'Supplier/editSupplier';
$route['api/home/up/supplier/edit/(:num)']['POST'] = 'Supplier/upImageEdit/$1';


//HOME NOTICE - CPANEL

$route['api/home/get/notices']['GET'] = 'Notices/getNotices'; //en espera
$route['api/home/create/notices']['POST'] = 'Notices/createNotice';
$route['api/home/up/notices/(:num)']['POST']  = 'Notices/upImage/$1';
$route['api/home/delete/notices/(:num)']['POST'] = 'Notices/deleteNotice/$1'; //listo
$route['api/home/update/notices']['POST'] = 'Notices/updateNotice';
$route['api/home/state/notices']['POST'] = 'Notices/changeState';

//HOME NEWS - CPANEL

$route['api/home/get/news']['GET'] = 'News/getNews'; //en espera
$route['api/home/create/new']['POST'] = 'News/createNew';
$route['api/news/up/image/(:num)']['POST'] = 'News/upImage/$1'; //listo

$route['api/home/delete/news']['POST'] = 'News/deleteNews'; //listo
$route['api/home/update/news']['POST'] = 'News/updateNews';
$route['api/home/changeState/news']['POST'] = 'News/changeState';

//SERVICES_GALLERY -CPANEL

$route['service/admin/gallery']['GET'] ='Gallery/adminGallery/$1';
$route['service/create/image']['POST']  = 'Gallery/createImage';
$route['service/up/image/(:num)']['POST']  = 'Gallery/upImage/$1';
$route['service/get/images/(:num)']['GET']  = 'HomeSite/getGallery/$1';
$route['service/edit/image']['POST']  = 'Gallery/editImage';
$route['service/upMultiplesImage/(:num)']['POST']  = 'Gallery/upMultiplesImage/$1';
$route['service/delete/image/(:num)']['POST']  = 'Gallery/deleteImage/$1';
$route['api/service/update/description']['POST']  = 'Gallery/editDescription';


// RUBRO
$route['api/service/rubro']['POST'] = 'Rubros/createRubros';
$route['api/service/get/rubros']['GET'] = 'Rubros/getRubros'; 
$route['api/service/up/image/rubros/(:num)']['POST']  = 'Rubros/upImage/$1';

$route['api/service/delete/rubros/(:num)']['POST'] = 'Rubros/deleteRubro/$1'; //listo
$route['api/service/update/rubros']['POST'] = 'Rubros/editRubros';
$route['api/service/state/rubros']['POST'] = 'Rubros/changeState';



// EMPLOY -CHARGES
$route['api/employ/charges']['GET'] = 'Employ/getCharges';
$route['api/employ/create/charges']['POST'] = 'Employ/createCharge';
$route['api/employ/charges/state']['POST'] = 'Employ/stateCharge';
$route['api/employ/charges/edit']['POST'] = 'Employ/editCharge';
$route['api/employ/charges/delete']['POST'] = 'Employ/deleteCharge';


//EMPLOY -NOTIFICATIONS
$route['api/employ/page/notifications']['POST']  = 'HomeSite/createNotification';
$route['api/employ/notifications']['GET'] = 'Employ/getNotifications'; 
$route['api/employ/create']['POST'] = 'Employ/createEmploy'; 

$route['api/employ/page/delete/notification/(:num)']['POST'] = 'Employ/deleteNotification/$1'; //listo
$route['api/employ/update/publication/(:num)']['POST'] = 'Employ/updatePublication/$1'; //listo
$route['api/employ/get/publication']['GET'] = 'Employ/getPublications'; 
$route['api/employ/state/publication/(:num)']['POST'] = 'Employ/changeState/$1';



//HOME - API -CPANEL
$route['api/about/get/personal']['GET'] = 'About/getPersonal';
$route['api/about/create/personal']['POST'] = 'About/createPersonal';
$route['api/about/update/personal']['POST'] = 'About/updatePersonal';
$route['api/about/up/image/personal/(:num)']['POST'] = 'About/upImage/$1';
$route['api/about/delete/personal/(:num)']['POST'] = 'About/deletePersonal/$1';

//ABOUT- API -CPANEL
$route['api/about/get/policies']['GET'] = 'Policies/getPolicies';
$route['api/about/create/policies']['POST'] = 'Policies/createPolicies';
$route['api/home/delete/policies/(:num)']['POST'] = 'Policies/deletePolicies/$1';
$route['api/about/update/policies']['POST'] = 'Policies/updatePolicies';





//SECCIÓN - API SECCION 

$route['api/get/sections']['POST'] = 'Sections/getSections';
$route['api/section/about/update']['POST'] = 'Sections/updateSection';
$route['api/section/about/update_not']['POST'] = 'Sections/updateNotImage';
$route['api/section/up/image/(:num)']['POST'] = 'Sections/upImage/$1';

//CONTACT

$route['api/contact/create']['POST'] = 'Contact/createContact';
$route['api/get/contacts']['GET'] = 'Contact/getContacts';
$route['api/contact/up/image/(:num)']['POST'] = 'Contact/upImage/$1';
$route['api/contact/update']['POST'] = 'Contact/updateContact';
$route['api/contact/delete/(:num)']['POST'] = 'Contact/deleteContact/$1';
$route['api/contact/up/image/edit/(:num)']['POST'] = 'Contact/upImageEdit/$1';

//USER 
/*api admin user*/
$route['api/user']['GET']= 'User/index';
$route['api/get_users']['GET']= 'User/list';
$route['api/create_user']['POST']= 'User/create';
$route['api/update_user']['POST']= 'User/update';
$route['api/des_hab_user']['POST']= 'User/des_hab';

////BIENVENIDOS-CPANEL
$route['counterOrders']['GET']='Home/counterOrders';


//CHAT PAGE


$route['api/chat/close']['POST']= 'Chat/closeChat';
$route['api/chat/validation']['POST']= 'Chat/validateChat';
$route['api/chat/message/client']['POST']= 'Chat/messageClient';
$route['api/chat/get/messages/(:num)']['GET']= 'Chat/getMessageById/$1';
//CHAT CPANEL


// PRODUCT PAGE 
$route['api/product/search']['POST']= 'HomeSite/getProducts';
$route['products/details']['GET']= 'Welcome/productById/$1';
$route['api/description/product/(:num)']['GET']= 'HomeSite/getProductId/$1';


//PRODUCT CPANEL

//HOME PRODUCTS - CPANEL
$route['product/supplier']['GET'] = 'Purveyor/adminPurveyor';
$route['product/category']['GET'] = 'Category/adminCategory';
$route['product/subCategory/(:num)']['GET'] = 'Subcategory/adminSubcategory/$1';
$route['product/subSubCategory/(:num)']['GET'] = 'SubSubcategory/adminSubSubcategory/$1';
$route['product/products']['GET'] = 'Products/adminProduct';

//HOME CATEGORY- CPANEL
$route['api/home/get/category']['GET'] = 'Category/getCategory'; 
$route['api/home/create/category']['POST'] = 'Category/createCategory';
$route['api/home/update/category']['POST'] = 'Category/updateCategory';
$route['api/home/state/category']['POST'] = 'Category/changeState';

//HOME SUBCATEGORY- CPANEL
$route['api/home/get/subCategory']['POST'] = 'Subcategory/getSubCategory'; 
$route['api/home/create/subCategory']['POST'] = 'Subcategory/createSubCategory';
$route['api/home/update/subCategory']['POST'] = 'Subcategory/updateSubCategory';
$route['api/home/state/subCategory']['POST'] = 'Subcategory/changeState';

//HOME SUBSUBCATEGORY- CPANEL
$route['api/home/get/subSubCategory']['POST'] = 'SubSubCategory/getSubSubCategory'; 
$route['api/home/create/subSubCategory']['POST'] = 'SubSubCategory/createSubSubCategory';
$route['api/home/update/subSubCategory']['POST'] = 'SubSubCategory/updateSubSubCategory';
$route['api/home/state/subSubCategory']['POST'] = 'SubSubCategory/changeState';

//HOME PRODUCTS- CPANEL

$route['api/home/get/product']['GET'] = 'Products/getProduct'; 
$route['api/home/adminCreate/product']['GET'] = 'Products/adminCreateProduct';
$route['api/home/product/getFields']['GET'] = 'Products/getFields';
$route['api/home/create/product']['POST'] = 'Products/createProduct';
$route['api/home/create/product/up/images/(:num)']['POST']  = 'Products/create_uploadImages/$1';
$route['api/home/create/product/up/imagep/(:num)']['POST']  = 'Products/create_uploadImageP/$1';
$route['api/home/update/product']['POST'] = 'Products/updateProduct';
$route['api/home/update/product/up/imagep/(:num)']['POST']  = 'Products/update_uploadImageP/$1';
$route['api/home/update/product/up/images/(:num)']['POST']  = 'Products/update_uploadImages/$1';
$route['api/home/product/getFieldsUpdate/(:num)']['GET'] = 'Products/getFieldsUpdate/$1';
$route['api/home/adminUpdate/product/(:num)']['GET'] = 'Products/adminUpdateProduct/$1';
$route['api/home/delete/product/(:num)']['POST'] = 'Products/deleteProduct/$1';

//HOME Supplier- CPANEL
$route['api/home/get/purveyor']['GET'] = 'Purveyor/getPurveyor'; 
$route['api/home/create/purveyor']['POST'] = 'Purveyor/createPurveyor';
$route['api/home/update/purveyor']['POST'] = 'Purveyor/updatePurveyor';
$route['api/home/state/purveyor']['POST'] = 'Purveyor/changeState';



$route['cpanel/slide']['GET'] = 'Slide/cpanelSlide'; 
$route['api/slide']='HomeSite/getSlide';
$route['api/home/get/slide']['GET'] = 'Slide/getSlide'; //en espera
$route['api/home/create/slide']['POST'] = 'Slide/createSlide';
$route['api/home/up/slide/(:num)']['POST']  = 'Slide/upImage/$1';
$route['api/home/delete/slide/(:num)']['POST'] = 'Slide/deleteSlide/$1'; //listo
$route['api/home/update/slide/(:num)']['POST'] = 'Slide/updateSlide';
$route['api/home/changeState/slide']['POST'] = 'Slide/changeState';
$route['api/home/edit/slide']['POST'] = 'Slide/editSlide';
$route['api/home/up/slide/edit/(:num)']['POST'] = 'Slide/upImageEdit/$1';
































































