<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;




// Route::get('/', "RestaurantController@index");
Route::get('/', "RestaurantController@index");
Route::get('/chart', "RestaurantController@getChart");

// Route::get("/orderShow", "RestaurantController@orders")->name("showOrders");

Route::resource("restaurant", "RestaurantController");
Route::resource("orders", "OrderController");
Route::resource("dishes", "DishController");
Auth::routes();


// Route::get("/payment", function () {
//     $gateway = new Braintree\Gateway([
//         'environment' => "sandbox",
//         'merchantId' => "rbhzcjjb2rtjsx4j",
//         'publicKey' => "8hsqrm2vqx9twkpw",
//         'privateKey' => "1971b9924ee94d6d0320bc61d1ccb6be"
//     ]);
//     $token = $gateway->ClientToken()->generate();
//     return view("payment", ["token" => $token]);
// })->name('payment');

Route::post("/checkout", "PaymentsController@checkout");

// //ROTTE DI TEST PER IL FRONT
// Route::get('/frontHome', 'FrontEndTestController@home')->name('homePage');
// Route::get('/frontSuccess', 'FrontEndTestController@success')->name('success');
// // Route::get('/frontRegister', 'FrontEndTestController@register')->name('register');
// Route::get('/menu', 'FrontEndTestController@menu')->name('menu');
// // Route::get('/checkout', 'FrontEndTestController@checkout' );
// // Route::get('/frontLogin', 'FrontEndTestController@login')->name('login');
// // Route::get('/checkout', 'FrontEndTestController@checkout' );
Route::get('/infoClienti', 'FrontEndTestController@infoClienti' );
