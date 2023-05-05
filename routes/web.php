<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Front Pages
Route::get('/', 'FrontPageController@index')->name('index');
Route::get('about', 'FrontPageController@about')->name('about');
Route::get('contact', 'FrontPageController@contact')->name('contact');
Route::get('terms', 'FrontPageController@terms')->name('terms');

Route::post('contact', 'FrontPageController@postContact')->name('contact.post');

// Cart
Route::post('addToCart', 'CartController@addToCart')->name('cart.addToCart');
Route::get('pluckItem/{position}', 'CartController@pluckItem')->name('cart.pluckItem');

// Testing route
Route::get('test', function() {
	return view('privacy');
});

// Products in Front Page
Route::get('products/{uri}', 'ProductController@showByUri')->name('products.showByUri');
Route::get('products/category/{category_name}', 'FrontPageController@showProductByCategory')->name('products.showByCategory');
Route::get('search/', 'FrontPageController@searchProduct')->name('products.searchNavbar');
Route::resource('products', 'ProductController');

// Members Area
Route::group([
	'middleware' => ['web', 'auth'],
], function() {
	// MemberController
	Route::get('/member/cart/{user_id?}', 'MemberController@myCart')->name('members.carts');
	Route::get('/member/profile/{user_id?}', 'MemberController@showMemberProfile')->name('profile');
	Route::get('/member/privacy/{user_id}', 'MemberController@editPassword')->name('members.privacy');
	Route::get('/member/invoices/{user_id?}', 'MemberController@memberInvoices')->name('members.invoices');
	Route::get('/member/invoices/view/{invoice_id}', 'MemberController@viewMemberInvoice')->name('members.viewInvoice');

	// UserController
	Route::get('/member/{user_id}/get_details', 'UserController@getUserData')->name('users.data');
	Route::match(['PUT', 'PATCH'], '/member/profile/{user_id}/update', 'UserController@updateMember')->name('profile.update');
	Route::match(['PUT', 'PATCH'], '/member/profile/{user_id}/profile_photo/update', 'UserController@updateProfilePicture')->name('profile.updateProfilePhoto');
	Route::match(['PUT', 'PATCH'], 'member/privacy/{user_id}/update', 'UserController@updatePassword')->name('members.updatePassword');

	// Cart Controller
	Route::post('/member/cart/{user_id}/checkout', 'CartController@checkout')->name('members.checkoutCart');
	Route::delete('/member/cart/{cart_id}/destroy', 'CartController@removeFromCart')->name('members.destroyCart');

	// Shipping Controller
	Route::get('/member/shipping_address/{address_id}/get_details', 'ShippingController@getShippingAddressData')->name('members.getShippingAddressData');
	Route::post('/member/{user_id?}/shipping_address/', 'ShippingController@addShippingAddress')->name('members.addShippingAddress');
	Route::match(['PUT', 'PATCH'], '/member/shipping_address/{address_id}', 'ShippingController@updateShippingAddress')->name('members.updateShippingAddress');
	Route::delete('/member/shipping_address/{address_id}/destroy', 'ShippingController@destroyShippingAddress')->name('members.destroyShippingAddress');

	// TransactionController [Midtrans]
	Route::get('/member/pay', 'TransactionController@createPayment')->name('members.pay');
	Route::get('/member/payment/{midtrans_id}/status', 'TransactionController@updateMidtransPaymentStatus')->name('members.updateMidtransPaymentStatus');
});

// Midtrans Notification Reciever
Route::post('/recieve_payment_from_midtrans', 'TransactionController@recieveNotification');
Route::post('/member/pay/finish', 'TransactionController@finishPayment')->name('members.finishPayment');

Route::get('home', 'HomeController@index');

// Dashboard Routes
Route::get('/staff', 'Auth\LoginController@dashboardLogin')->name('login.staff');
Route::get('/admin', 'Auth\LoginController@dashboardLogin')->name('login.admin');

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' => 'dashboard',
	'as' => 'dashboard.',
], function() {
	Route::get('/', 'DashboardController@index')->name('index');

	// Notifications
	Route::get('notifications/{user_id}/read-all', 'NotificationController@readAllMyNotification')->name('notifications.readAll');

	// Invoices
	Route::get('invoices', 'DashboardController@invoices')->name('invoices');
	Route::get('invoices/{invoice_id}/get_details', 'InvoiceController@getInvoiceData')->name('invoices.getInvoiceData');
	Route::post('invoices/{invoice_id}/update_shipping', 'InvoiceController@insertOrUpdateShippingData')->name('invoices.insertOrUpdateShippingData');
	Route::post('invoices/{invoice_id}/manually_add_invoice_item', 'InvoiceController@addInvoiceItem')->name('invoices.manuallyAddInvoiceItem');
	Route::post('invoices/manually_create_invoice', 'InvoiceController@createInvoice')->name('invoices.manuallyCreateInvoice');
	Route::delete('invoices/{invoice_id}/destroy', 'InvoiceController@destroyInvoice')->name('invoices.destroy');

	// Users and Profiles
	Route::get('user/{user_id}/profile', 'DashboardController@showProfile')->name('users.profile');
	Route::get('user/{user_id}/get_details', 'UserController@getUserData')->name('users.data');
	Route::get('staffs', 'DashboardController@staffs')->name('users.staffs');
	Route::get('members', 'DashboardController@members')->name('users.members');
	Route::post('staffs', 'UserController@storeStaff')->name('staffs.store');
	Route::match(['PUT', 'PATCH'], 'user/{user_id}/update', 'UserController@updateMember')->name('users.members.update');
	Route::match(['PUT', 'PATCH'], 'user/{user_id}/self_update', 'UserController@updateMyDetails')->name('users.self-update');
	Route::match(['PUT', 'PATCH'], 'staff/{user_id}/update', 'UserController@updateStaff')->name('users.staffs.update');
	Route::delete('user/{user_id}/destroy', 'UserController@destroyUser')->name('users.destroy');

	// Carts
	Route::get('carts', 'DashboardController@membersCarts')->name('carts');
	Route::delete('carts/{user_id}/destroy_user_cart', 'CartController@destroyUserCart')->name('carts.destroyUserCart');

	// Products
	Route::get('sales', 'DashboardController@sales')->name('sales');
	Route::get('stocks', 'DashboardController@stocks')->name('stocks');
	Route::get('products/subcategory/{subcategoryName?}', 'DashboardController@productLists')->name('products.lists');
	Route::get('products/{product_id}', 'DashboardController@viewProduct')->name('products.showDetail');
	Route::get('products/{product_id}/get_details', 'ProductController@getProductData')->name('products.get-data');
	Route::match(['PUT', 'PATCH'], 'products/{product_id}/update_description', 'ProductController@updateDescription')->name('products.updateDescription');
	Route::delete('products/{product_id}/deleteAndRedirect', 'ProductController@destroyAndRedict')->name('products.destroyAndRedict');

	// Products Attribute
	Route::get('products/attribute/{attribute_id}/get_details', 'ProductsAttributeController@getAttributeDetails')->name('products.getAttributeData');
	Route::post('products/add_attribute', 'ProductsAttributeController@store')->name('products.attribute.store');
	Route::match(['PUT', 'PATCH'], 'products/attribute/{attribute_id}/update_attribute', 'ProductsAttributeController@update')->name('products.updateAttribute');
	Route::delete('products/attribute/{attribute_id}/destroy', 'ProductsAttributeController@destroy')->name('products.attribute.destory');

	// Products Terms
	Route::get('products/term/{product_id}/get_details', 'ProductsTermController@getTerms')->name('products.getTerms');
	Route::post('products/{product_id}/editorupdatewarranty', 'ProductsTermController@updateOrCreate')->name('products.term.updateOrCreate');

	// Products Dimension
	Route::post('products/{product_id}/add_dimension', 'ProductsDimensionController@store')->name('products.dimension.store');
	Route::match(['PUT', 'PATCH'], 'products/dimension/{dimension_id}/update', 'ProductsDimensionController@update')->name('products.dimension.update');
	Route::delete('products/dimension/{dimension_id}/destroy', 'ProductsDimensionController@destroy')->name('products.dimension.destory');

	// Products Photo
	Route::post('products/{product_id}/upload_photos', 'ProductsPhotoController@add')->name('products.photo.add');
	Route::match(['PUT', 'PATCH'], 'products/photo/{photo_id}/update', 'ProductsPhotoController@updatePhoto')->name('products.photo.update');
	Route::delete('products/photo/{photo_id}/destroy', 'ProductsPhotoController@destroy')->name('products.photo.destory');

	// Products Banner
	Route::match(['PUT', 'PATCH'], 'products/banner/{product_id}/updateOrCreateBanner', 'ProductsBannerController@updateOrCreate')->name('products.banner.updateOrCreate');
	Route::delete('products/banner/{banner_id}/destroy', 'ProductsBannerController@destroy')->name('products.banner.destory');

	// Feedbacks
	Route::get('feedbacks', 'DashboardController@feedbacks')->name('feedbacks');
	Route::get('feedbacks/{feedback_id}/get_details', 'ContactController@show')->name('feedbacks.show');
	Route::delete('feedbacks/{feedback_id}', 'ContactController@destroy')->name('feedbacks.destroy');

	Route::resources([
		'products' => 'ProductController',
	]);
});
