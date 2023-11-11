<?php

use App\Http\Controllers\Admin\Setting\GeneralSettingController;
use App\Http\Controllers\Admin\Setting\SystemFieldsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Install\ModulesController;
use App\Http\Controllers\Admin\Setting\LanguageController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\PaymentSettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\User\UsersController;
use App\Http\Controllers\Admin\Roles\RolesController;
use App\Http\Controllers\Admin\Permissions\PermissionsController;
use App\Http\Controllers\Admin\Master\AsignBrandsController;
use App\Http\Controllers\Admin\Master\BrandsController;
use App\Http\Controllers\Admin\Master\PackagesController;
use App\Http\Controllers\Admin\Master\DepartmentsController;
use App\Http\Controllers\Admin\Master\SalesController;
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

Route::get('/call/migration-rollback-seed', function () {
    \Artisan::call('migrate:refresh');

    \Artisan::call('db:seed');
    dd("migrate:rollback", 'db:seed');
})->name('settings.call.migrations');

Auth::routes();
//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);
Route::get('/', [HomeController::class, 'root'])->name('root')->middleware('sidebar-menu');

Route::get('404', function () {
    return view('error.404');
})->name('404');


//Update User Details

Route::middleware(['auth', 'sidebar-menu'])->group(function () {
    Route::get('/', [HomeController::class, 'root'])->name('root');
    Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

    Route::get('/profile', [UserController::class, 'index'])->name('user.profile');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/profile/{id}/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::put('/profile/{id}/update/password', [UserController::class, 'updatePassword'])->name('user.profile.update.password');

    Route::resource('users', UsersController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('manage-modules', ModulesController::class)->only(['index', 'destroy', 'update']);
    Route::post('upload\module', [ModulesController::class, 'uploadModule'])->name('upload.module');

    Route::prefix('system_settings')->name('system_settings.')->group(function () {


    });

    /*
     * User Managements
     */
    Route::resource('sales', SalesController::class);
    Route::group(['prefix' => 'admin','as' => 'admin.','namespace' => 'Admin'], function () {
        
        /**
         * Routing for Users
         */
        Route::put('user-status/{user}', [UsersController::class, 'changeStatus'])->name('users.status');
        Route::resource('users', UsersController::class);

        /**
         * Routing for Roles
         */
        Route::put('role-status/{user}', [RolesController::class, 'changeStatus'])->name('roles.status');
        Route::resource('roles', RolesController::class);
        /**
         * Routing for Asign Brand
         */
        Route::put('asign-brands-status/{asignBrand}', [AsignBrandsController::class, 'changeStatus'])->name('asign-brands.status');
        Route::resource('asign-brands', AsignBrandsController::class);

        /**
         * Routing for Permissions
         */
        Route::resource('permissions', PermissionsController::class);

    });

    /*
     * Sale Managements
     */
    Route::resource('sales', SalesController::class);

    /*
     * Master Managements
     */
    Route::group(['prefix' => 'master', 'as' => 'master.', 'namespace' => 'Admin\Master'], function () {
         /**
         * Routing for Brand
         */
        Route::put('brands-status/{brand}', [BrandsController::class, 'changeStatus'])->name('brands.status');
        Route::resource('brands', BrandsController::class);
         /**
         * Routing for Package
         */
        Route::put('packages-status/{brand}', [PackagesController::class, 'changeStatus'])->name('packages.status');
        Route::resource('packages', PackagesController::class);
         /**
         * Routing for Package
         */
        Route::put('departments-status/{department}', [DepartmentsController::class, 'changeStatus'])->name('departments.status');
        Route::resource('departments', DepartmentsController::class);
    

    });

    Route::prefix('settings')->name('settings.')->group(function () {
        /*  Route::get('/call/migrations', function () {
              \Artisan::call('migrate');
              return redirect()->back();
          });*/

        //general setting
        Route::get('/', [GeneralSettingController::class, 'index'])->name('general');
        Route::post('general/save', [GeneralSettingController::class, 'generalSave'])->name('general_save');
        Route::post('logo/save', [GeneralSettingController::class, 'saveLogo'])->name('save_logo');

        // Language Settings
        Route::get('/language/update/status/{language}', [LanguageController::class, 'updateStatus']);
        Route::get('/language/translate/{language}', [LanguageController::class, 'translate'])->name('language.translate');
        Route::post('/language/translate/{id}/update', [LanguageController::class, 'translateUpdate'])->name('translates.update');
        Route::get('/translate/{code}/{group}', [LanguageController::class, 'translate'])->name('translate.group');
        Route::resource('language', LanguageController::class);


        // Payment Settings
        Route::get('/payment/{tab?}', [PaymentSettingController::class, 'index'])->name('payment.index');
        Route::post('/payment', [PaymentSettingController::class, 'store'])->name('payment.store');

        Route::resource('module', ModuleSettingController::class);

        // Theme settings for particular user
        Route::prefix('theme')->group(function () {
            Route::post('/', [ThemeSettingController::class, 'store'])->name('theme.setting');
        });
        // End Theme settings

        // Language Settings
        Route::resource('language', LanguageController::class);


        // Business settings routes start from here

        Route::post('/email', [SystemSettingController::class, 'emailSetting'])->name('email.settings');
        // payment callback

        //system fields route
        Route::put('system-fields-update/{systemField}', [SystemFieldsController::class, 'changeStatus'])->name('system-fields.status');
        Route::put('system-fields/required/{systemField}', [SystemFieldsController::class, 'changeRequiredStatus'])->name('system-fields.requiredStatus');
        Route::resource('system-fields', SystemFieldsController::class);
    });








    Route::get('/admission_enquiry', function () {
        return view('Front_Office.admission_enquiry');
    })->name('front_office.admission_enquiry');

    Route::get('/visitor_management', function () {
        return view('Front_Office.visitor_management');
    })->name('front_office.visitor_management');

    Route::get('/phone_call_log', function () {
        return view('Front_Office.phone_call_log');
    })->name('front_office.phone_call_log');

    Route::get('/postal_dispatch', function () {
        return view('Front_Office.postal_dispatch');
    })->name('front_office.postal_dispatch');

    Route::get('/postal_receive', function () {
        return view('Front_Office.postal_receive');
    })->name('front_office.postal_receive');

    Route::get('/complain', function () {
        return view('Front_Office.complain');
    })->name('front_office.complain');

    Route::get('/setup_front_office', function () {
        return view('Front_Office.setup_front_office');
    })->name('front_office.setup_front_office');

    Route::get('/sms_setting', function () {
        return view('settings.sms_setting');
    })->name('settings.sms_setting');


});


Route::get('payment/methods', [TransactionController::class, 'showPaymentMethods'])->name('payment.methods');
Route::post('payment/create', [TransactionController::class, 'create'])->name('payment.create');
Route::get('payment/{type}/callback', [TransactionController::class, 'callback'])->name('payment.callback');

//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');