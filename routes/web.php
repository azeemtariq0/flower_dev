<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\AnalystController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptTypeController;
use App\Http\Controllers\UnitCategoryController;
use App\Http\Controllers\StaffTypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitOwnerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ApploginController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Management\ProductCategoryController;
use App\Http\Controllers\Management\ProductSubCategoryController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Management\OrderController;


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


Route::get('/get-product/', [App\Http\Controllers\Frontend\UserDashboardController::class, 'getRecord']);
Route::get('/checkout/', [App\Http\Controllers\Frontend\UserDashboardController::class, 'checkout']);
Route::get('/shopping-cart/', [App\Http\Controllers\Frontend\UserDashboardController::class, 'shoppingCart']);
Route::post('/create-order', [App\Http\Controllers\Frontend\UserDashboardController::class, 'createOrder']);


Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');




Route::middleware(['auth', 'AdminRoutes'])
    ->group(function () {
        Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('admin/roles', App\Http\Controllers\RoleController::class);
        Route::resource('admin/permissions', App\Http\Controllers\PermissionController::class);
        Route::resource('admin/users', App\Http\Controllers\UserController::class);
        Route::resource('admin/multi-lingle', MultiLingleController::class);
        Route::post('admin/multi-states', [MultiLingleController::class, 'multiState']);
        Route::post('admin/multi-cities', [MultiLingleController::class, 'multiCity']);
        Route::resource('admin/dashboard', App\Http\Controllers\HomeController::class);
        Route::resource('admin/countries', CountryController::class);
        Route::resource('admin/cities', CityController::class);
        Route::resource('admin/states', StateController::class);
        Route::resource('admin/product-categories', ProductCategoryController::class);
        Route::resource('admin/product-sub-categories', ProductSubCategoryController::class);
        Route::resource('admin/products', ProductController::class);
        Route::post('admin/get-sub-category', [ProductController::class, 'getSubCategory']);


        Route::resource('admin/orders',  App\Http\Controllers\Management\OrderController::class);
        Route::resource('admin/order-confirm', App\Http\Controllers\Management\OrderController::class);
        Route::resource('admin/order-dispatch', App\Http\Controllers\Management\OrderController::class);
        Route::resource('admin/order-delivered', App\Http\Controllers\Management\OrderController::class);
    });



//   Route::group([
//     'prefix' => '{locale}',
//     'where' => ['locale' => '[a-zA-Z]{2}'],
//     'middleware' => 'setlocale',
// ], function () {
//     Route::get('/login', function () {
//         return view("auth/login");
//     });
//     Route::get('/register', function () {
//         return view("auth/register");
//     });


Route::get('/', [App\Http\Controllers\Frontend\UserDashboardController::class, 'index']);
Route::get('/about-us', [AboutController::class, 'index'])->name('frontend.about');
Route::get('/contact-us', [ContactController::class, 'index'])->name('frontend.contact');
Route::get('/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'allTheme']);
Route::get('category/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'Category']);


Route::get('add-to-cart/{id}', [App\Http\Controllers\Frontend\UserDashboardController::class,  'AddToCart']);


Route::get('/our-products', [App\Http\Controllers\Frontend\UserDashboardController::class, 'ourProduct']);

Route::get('collection/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'Collections']);


Route::get('product/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'singleProduct']);


Route::get('tour-packages', [App\Http\Controllers\Frontend\UserDashboardController::class, 'allPackages']);
Route::get('packages/{slug}', [App\Http\Controllers\Frontend\BlogsController::class, 'singlePackage']);
Route::get('tour-package/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'allCategory']);
Route::get('tour-packages/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'allCollection']);
Route::get('my-account/my-profile', [App\Http\Controllers\Frontend\UserDashboardController::class, 'myProfile']);
Route::put('update_profile/{id}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'updateprofile']);
Route::get('my-account/change-password', [App\Http\Controllers\Frontend\UserDashboardController::class, 'password']);
Route::put('update-password/{id}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'updatePassword']);
Route::get('pages/{slug}', [App\Http\Controllers\Frontend\BlogsController::class, 'Pages']);
Route::get('f/filter', [App\Http\Controllers\Frontend\UserDashboardController::class, 'allFilter']);
Route::get('f/predictive-states', [App\Http\Controllers\Frontend\UserDashboardController::class, 'predictiveStates']);
Route::get('currency/{slug}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'CurrencySwitcher']);
Route::get('/package/checkout', [App\Http\Controllers\Frontend\BlogsController::class, 'Checkout']);
Route::post('/package/check-out', [App\Http\Controllers\Frontend\BlogsController::class, 'DataCheckOut']);
Route::get('/package/payment-response', [App\Http\Controllers\Frontend\BlogsController::class, 'PaymentResponse']);
// });



// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('permissions', PermissionController::class);
//     Route::resource('projects', ProjectController::class);
//     Route::resource('blocks', BlockController::class);
//     Route::resource('expense_categories', ExpenseCategoryController::class);
//     Route::resource('unit_categories', UnitCategoryController::class);
//     Route::resource('staff_types', StaffTypeController::class);
//     Route::resource('receipts', ReceiptController::class);
//     Route::resource('receipt_types', ReceiptTypeController::class);
//     Route::resource('units', UnitController::class);
//     Route::resource('research', ResearchController::class);
//     Route::resource('analyst', AnalystController::class);
//     Route::resource('products', ProductController::class);
//     Route::resource('unit_owners', UnitOwnerController::class);
//     Route::post('unit_owners_update', [UnitController::class, 'unitOwnerUpate']);
//     Route::post('resideny-update', [UnitController::class, 'residenyUpdate']);
//     Route::resource('expenses', ExpenseController::class);

//     Route::post('add_or_update_staff_type', [StaffTypeController::class, 'staffTypeSaveOrUpdate']);
//     Route::post('assign_role', [UserController::class, 'assignRoleToUser']);
//     Route::post('add-receipt', [ReceiptController::class, 'addReceipt']);
//     Route::post('receipt-status', [ReceiptController::class, 'updateStatus']);

//     //  GET ROUTES
//     Route::get('get-units', [ReceiptController::class, 'getUnits']);
//     // Route::get('/all_block/{id}', [BlockController::class, 'allBlocks']);
//     Route::get('/all_block/{id}', [HomeController::class, 'allBlocks']);
//     Route::post('get-blocks', [HomeController::class, 'getBlocks']);
//     Route::get('/freez-voucher/{id}', [ExpenseController::class, 'feezExpenseVoucher']);


//     Route::get('/print-receipt/{id}', [ReceiptController::class, 'printView']);
//     Route::get('/print-receipt-new/{id}', [ReceiptController::class, 'downloadReceipt']);
//     Route::get('/print-expense/{id}', [ExpenseController::class, 'printView']);


//     //  Report Controller

//     Route::get('/defaulter-report', [ReportController::class, 'defaulter']);
//      Route::get('/defaulter-print', [ReportController::class, 'defaulterPrint']);


//     Route::get('/receivable-report', [ReportController::class, 'index']);
//     Route::get('/receivable-print', [ReportController::class, 'printReport']);

// });


Route::get('lang', [LangController::class, 'lang']);
Route::get('lang/change', [LangController::class, 'lang_change'])->name('lang.change');


// Route::get('/', [UserDashboardController::class, 'index']);  
Route::get('cart', [App\Http\Controllers\Frontend\UserDashboardController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [App\Http\Controllers\Frontend\UserDashboardController::class, 'addToCart']);
Route::patch('update-cart', [App\Http\Controllers\Frontend\UserDashboardController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [App\Http\Controllers\Frontend\UserDashboardController::class, 'removeCartItem']);
Route::get('clear-cart', [App\Http\Controllers\Frontend\UserDashboardController::class, 'ClearCart']);

Route::get('/api/login', [ApploginController::class, 'login']);
Route::get('/api/get-receipts', [ApploginController::class, 'getReceipts']);
Route::any('api/logout', [apploginController::class, 'logout']);


// Process For Fee Receivable
Route::get('/api/receivable-process', [ApploginController::class, 'receivableProcess']);

// Route::middleware('cors')->group(function(){
// Route::group(['middleware' => ['jwt.verify']],   function() {
    
// Route::any('api/logout', [apploginController::class, 'logout']);


//     });
// });



// Route::get('users', [UserController::class, 'index'])->name('users.index');