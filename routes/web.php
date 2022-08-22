<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    //part of dashboard
    Route::get('admin/dashboard/customer/delete/{id}',"App\Http\Controllers\DashboardController@delete_cus")->name("admin.dashboard.customer.delete");
    //Part of Module User
    Route::get('/dashboard',"App\Http\Controllers\DashboardController@show");
    Route::get('/admin',"App\Http\Controllers\DashboardController@show");
    Route::get("/admin/user/list","App\Http\Controllers\AdminUserController@list")->name("admin.user.list");
    Route::get("/admin/user/add","App\Http\Controllers\AdminUserController@add")->middleware("checkRight");
    Route::Post("/admin/user/store","App\Http\Controllers\AdminUserController@store");
    Route::get("admin/user/excute","App\Http\Controllers\AdminUserController@excute");
    Route::get("admin/user/edit/{id?}","App\Http\Controllers\AdminUserController@edit")->name("user.edit");
    Route::Post("admin/user/update/{id?}","App\Http\Controllers\AdminUserController@update")->name("user.update");
    Route::get("admin/user/restore/{id}","App\Http\Controllers\AdminUserController@restore")->name('restore');
    Route::get("/admin/user/delete_user/{id?}","App\Http\Controllers\AdminUserController@delete_user")->name('delete_user');
    Route::get("/admin/user/delete_trash_user/{id?}","App\Http\Controllers\AdminUserController@delete_trash_user")->name('delete_trash_user');
    
    //Part of Module Page
    Route::get("/admin/page/list","App\Http\Controllers\AdminPageController@list");
    Route::get("/admin/page/add","App\Http\Controllers\AdminPageController@add")->middleware("checkRight");
    Route::get("/admin/page/delete/{id?}","App\Http\Controllers\AdminPageController@delete")->name("page.delete");
    Route::Post("/admin/page/multi-option","App\Http\Controllers\AdminPageController@multi_option")->name("page.multi-option");
    Route::post('/admin/page/store',"App\Http\Controllers\AdminPageController@store");
    Route::get('/admin/page/edit/{id?}',"App\Http\Controllers\AdminPageController@edit")->name("page.edit");
    Route::Post('/admin/page/update/{id}',"App\Http\Controllers\AdminPageController@update")->name("page.update");
    
    //Part of Modul Post
    Route::get("/admin/post/list","App\Http\Controllers\AdminPostController@list");
    
    Route::get("/admin/post/cat/list","App\Http\Controllers\AdminPostController@listcat");
    Route::post("/admin/post/cat/createListCat","App\Http\Controllers\AdminPostController@createListCat")->name("post.cat.list");
    Route::get("/admin/post/cat/delete/{id?}","App\Http\Controllers\AdminPostController@delete")->name("post.cat.delete");
    Route::get("/admin/post/cat/edit/{id?}","App\Http\Controllers\AdminPostController@edit")->name("post.cat.edit");
    Route::post("/admin/post/cat/update/{id?}","App\Http\Controllers\AdminPostController@update")->name("post.cat.update");
    
    Route::get("/admin/post/postDelete/{id?}","App\Http\Controllers\AdminPostController@postDelete")->name("post.delete");
    Route::post("/admin/post/excecute","App\Http\Controllers\AdminPostController@excecute")->name("post.excecute");
    Route::get("/admin/post/add","App\Http\Controllers\AdminPostController@postAdd");
    Route::post("/admin/post/postCreate","App\Http\Controllers\AdminPostController@postCreate")->name("post.create");
    Route::get("/admin/post/postEdit/{id}","App\Http\Controllers\AdminPostController@postEdit")->name("post.edit");
    Route::post("/admin/post/postUpdate/{id}","App\Http\Controllers\AdminPostController@postUpdate")->name("post.update");
    
    //Part of Modul Product
    Route::get("/admin/product/cat/list","App\Http\Controllers\AdminProductController@listcat");
    Route::get("/admin/product/cat/edit/{id}","App\Http\Controllers\AdminProductController@edit")->name("product.cat.edit");
    Route::get("/admin/product/cat/delete/{id}","App\Http\Controllers\AdminProductController@delete")->name("product.cat.delete");
    Route::post("/admin/product/cat/createNewProductCat","App\Http\Controllers\AdminProductController@createNewProductCat")->name("product.createCat");
    Route::post("/admin/product/cat/update/{id}","App\Http\Controllers\AdminProductController@update")->name("product.cat.update");
    
    Route::get("/admin/product/list","App\Http\Controllers\AdminProductController@list");
    Route::post("/admin/product/excecute","App\Http\Controllers\AdminProductController@excecute")->name("product.excecute");
    Route::get("/admin/product/productEdit/{id}","App\Http\Controllers\AdminProductController@productEdit")->name("product.edit");
    Route::get("/admin/product/productDelete/{id}","App\Http\Controllers\AdminProductController@productDelete")->name("product.delete");
    Route::get("/admin/product/add","App\Http\Controllers\AdminProductController@add")->middleware("checkRight");
    Route::post("/admin/product/productCreate","App\Http\Controllers\AdminProductController@productCreate")->name("product.create");
    Route::post("/admin/product/productUpdate/{id}","App\Http\Controllers\AdminProductController@productUpdate")->name("product.update");
    
    Route::get("admin/product/type/list","App\Http\Controllers\AdminProductController@listtype");
    Route::post("/admin/product/cat/createNewProductType","App\Http\Controllers\AdminProductController@createNewProductType")->name("product.createType");
    Route::get("/admin/product/cat/editType/{id}","App\Http\Controllers\AdminProductController@editType")->name("product.type.edit");
    Route::get("/admin/product/cat/deleteType/{id}","App\Http\Controllers\AdminProductController@deleteType")->name("product.type.delete");
    Route::post("/admin/product/cat/updateType/{id}","App\Http\Controllers\AdminProductController@updateType")->name("product.type.update");
    //Part of Modul Slide
    Route::get("/admin/slide/list","App\Http\Controllers\AdminSlideController@list");
    
    Route::post("/admin/slide/excecute","App\Http\Controllers\AdminSlideController@excecute")->name('excecute');
    Route::get("/admin/slide/add","App\Http\Controllers\AdminSlideController@add")->middleware("checkRight");
    Route::post("/admin/slide/create","App\Http\Controllers\AdminSlideController@create")->name('slide.create');
    Route::get("/admin/slide/edit/{id}","App\Http\Controllers\AdminSlideController@edit")->name('slide.edit');
    Route::post("/admin/slide/update/{id}","App\Http\Controllers\AdminSlideController@update")->name("slide.update");
    Route::get("/admin/slide/delete/{id}","App\Http\Controllers\AdminSlideController@delete")->name("delete");
    
    //Part of Modul Order
    Route::get("/admin/order/list/{id}","App\Http\Controllers\AdminOrderController@list");
    Route::get("/admin/order/update_status","App\Http\Controllers\AdminOrderController@update_status")->name("admin.update_status");

    //part of Modul Right
    Route::get("/admin/right/add/{id?}","App\Http\Controllers\AdminRightController@add");
    Route::get("/admin/right/list","App\Http\Controllers\AdminRightController@list");
    Route::get("/admin/right/edit/{id?}","App\Http\Controllers\AdminRightController@edit")->name("admin.right.edit");
    Route::get("/admin/right/addPermisstion","App\Http\Controllers\AdminRightController@addPermisstion");

    Route::post("/admin/right/createPermisstion","App\Http\Controllers\AdminRightController@createPermisstion")->name("admin.right.create");
    Route::post("/admin/right/createRight","App\Http\Controllers\AdminRightController@createRight")->name("admin.right.createRight");
    Route::post("/admin/right/update/{id?}","App\Http\Controllers\AdminRightController@update")->name("admin.right.update");
    Route::get("/admin/right/delete/{id?}","App\Http\Controllers\AdminRightController@delete")->name("admin.right.delete");
    
});
//Excuse CLient part
    Route::get('/',"App\Http\Controllers\ClientHomeController@show")->name('home');
   
    //product
    Route::get("san-pham","App\Http\Controllers\ClientHomeController@products")->name("client.products");

    Route::get("san-pham/{cat_id}","App\Http\Controllers\ClientHomeController@product_cat")->name("client.product.product_cat");
    Route::get("chi-tiet-san-pham/{id}-{slug}.html","App\Http\Controllers\ClientHomeController@detail_product")->name("client.product.detail_product");
    //test slug
    Route::get("test-slug/{id}-{slug}.html","App\Http\Controllers\ClientHomeController@test")->name("client.product.test");
    
    //cart
    Route::get("product/cart/add-cart/{id}","App\Http\Controllers\ClientCartController@add_cart")->name("client.product.cart.add_cart");
    Route::get("gio-hang","App\Http\Controllers\ClientCartController@show_cart")->name("client.product.cart.show_cart");
    Route::get("product/cart/buy-now/{id}","App\Http\Controllers\ClientCartController@buy_now")->name("client.product.cart.buy_now");
    Route::get("product/cart/delete-entire-cart","App\Http\Controllers\ClientCartController@destroy_entire_cart")->name("client.product.cart.destroy_entire_cart");
    Route::get("product/cart/remove_cart/{rowId}","App\Http\Controllers\ClientCartController@remove_cart")->name("client.product.cart.remove_cart");
    Route::get("product/cart/update_cart","App\Http\Controllers\ClientCartController@update_cart")->name("client.product.cart.update_cart");
    Route::get("product/cart/update_cart_ajax/","App\Http\Controllers\ClientCartController@update_cart_ajax")->name("client.product.cart.update_cart_ajax");
    Route::get("product/cart/update_cart_ajax_from_detail/","App\Http\Controllers\ClientCartController@update_cart_ajax_from_detail")->name("client.product.cart.update_cart_ajax_from_detail");
    //payment page
    Route::get("dat-hang","App\Http\Controllers\ClientCartController@payment")->name("client.product.cart.payment");
    //blog
    Route::get("bai-viet","App\Http\Controllers\ClientBlogController@blog")->name("client.blog.list");
    Route::get("chi-tiet-bai-viet/{id}","App\Http\Controllers\ClientBlogController@blog_detail")->name("client.blog.detail");
    Route::get("bai-viet/{id}","App\Http\Controllers\ClientBlogController@blog_cat")->name("client.blog.cat");

    //page
    Route::get("gioi-thieu","App\Http\Controllers\ClientPageController@page_intro")->name("client.page_intro");
    Route::get("lien-he","App\Http\Controllers\ClientPageController@page_contract")->name("client.page_contract");
    //question
    Route::get("tim-kiem","App\Http\Controllers\ClientSearchController@query")->name("client.query");
    //mail
    Route::post("client/sendEmail","App\Http\Controllers\ClientPaymentMailController@sendMail");
    Route::get("cam-on-{id}","App\Http\Controllers\ClientPaymentMailController@order_s")->name("client.order_success");
    
    //filter
    Route::post("sap-xep-gia-{id}","App\Http\Controllers\ClientHomeController@price_arrangement")->name("client.product.product_cat.price_filter");
    Route::get("sap-xep-gia-{id}","App\Http\Controllers\ClientHomeController@price_arrangement")->name("client.product.product_cat.price_filter");
    Route::post("sap-xep-{cat_id}","App\Http\Controllers\ClientHomeController@product_cat")->name("client.product.product_cat.arrangement_filter");
    Route::get("sap-xep-{cat_id}","App\Http\Controllers\ClientHomeController@product_cat")->name("client.product.product_cat.arrangement_filter");
    //filter 2 client.filter2
    Route::get("loc","App\Http\Controllers\ClientSearchController@filter")->name("client.product.client.filter2");



