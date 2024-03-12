<?php

use App\Http\Controllers\DropZoneJsController;
use App\Http\Controllers\DropZoneJsFileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SignaturePadController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Route::get('customers.show', [App\Http\Controllers\CustomerController::class, 'preview'])->parameters(['customers' => 'token']);
Route::get('customer', ['as' => 'preview', function () {
    return app()->make(App\Http\Controllers\CustomerViewController::class)->callAction('index', $parameters = ['token' => request()->token]);
}]);
//Route::get('customer/{token}', [\App\Http\Controllers\CustomerViewController::class, 'index'])->name('customers');

Route::get('customer/reports/{token}', [\App\Http\Controllers\CustomerViewController::class, 'pm'])->name('reports');
Route::get('customer/agreements/{token}', [\App\Http\Controllers\CustomerViewController::class, 'agreement'])->name('agreements');


Route::middleware(['auth'])->group(function () {
    Route::get('logs', [Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('activities', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activities.index');

    Route::resource('admins', App\Http\Controllers\AdminController::class);
    Route::resource('profiles', App\Http\Controllers\ProfileController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::post('/signature_pad', [SignaturePadController::class, 'upload'])->name('signature_pad');
    Route::post('signature_pad', [\App\Http\Controllers\MaintenanceProductPmController::class, 'storeSignature'])->name('signature_pad.store');

    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
//    Route::post('customer/send-link',\App\Http\Controllers\CustomerController::class, 'sendPreviewLink')->name('send_link');
    Route::post('sendmail', [\App\Http\Controllers\CustomerViewController::class, 'sendMail'])->name('sendmail');

    Route::resource('agreements', \App\Http\Controllers\AgreementController::class);
    Route::post('agreement/archive/{agreement}', [\App\Http\Controllers\AgreementController::class, 'archive'])->name('archive');
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('product_serials', \App\Http\Controllers\ProductSerialController::class);
    Route::resource('product_parts', \App\Http\Controllers\ProductPartsController::class);
    Route::resource('product_models', \App\Http\Controllers\ProductModelController::class);
    Route::resource('compressors', \App\Http\Controllers\CompressorController::class);
    Route::resource('dryers', \App\Http\Controllers\DryerController::class);
    Route::resource('calendars', \App\Http\Controllers\CalendarController::class);
    Route::resource('technicians', \App\Http\Controllers\TechnicianController::class);
    Route::resource('inspections', \App\Http\Controllers\InspectionController::class);

    Route::resource('schedules', \App\Http\Controllers\MaintenanceScheduleController::class);
    Route::get('schedules_other', [\App\Http\Controllers\MaintenanceScheduleController::class, 'index_non_pm'])->name('schedules_other');
    Route::get('schedules_edit/{schedule}', [\App\Http\Controllers\MaintenanceScheduleController::class, 'edit_non_pm'])->name('schedules_other_edit');

    Route::resource('schedule_others', \App\Http\Controllers\MaintenanceScheduleOtherController::class);

    Route::resource('maintenances', \App\Http\Controllers\MaintenanceController::class);
    Route::resource('maintenances.product', \App\Http\Controllers\MaintenanceProductController::class);
    // custom create preventive and reports
    Route::resource('maintenances.product.pm', \App\Http\Controllers\MaintenanceProductPmController::class);
    //
    Route::resource('maintenances.preventives', \App\Http\Controllers\MaintenanceController::class);
    Route::resource('maintenance_reports', \App\Http\Controllers\MaintenanceReportController::class);

    //report
    Route::resource('reports_pm', \App\Http\Controllers\report\ReportPMController::class);


    Route::post('dropzone/store', [DropZoneJsController::class, 'storeMedia'])->name('dropzone.store');
    Route::post('dropzone/store/files', [DropZoneJsFileController::class, 'storeMedia'])->name('dropzone.store.files');
    Route::get('showModal/{id}',[\App\Http\Controllers\MaintenanceReportController::class, 'showModal']);
    Route::prefix('ajax')->as('ajax.')->group(function () {
        // for request select
        Route::get('select2/products', [\App\Http\Controllers\AgreementController::class, 'getProduct'])->name('select2.products');
        Route::get('select2/product_serials', [\App\Http\Controllers\AgreementController::class, 'getProductSerial'])->name('select2.product_serials');
        Route::get('select2/product_parts', [\App\Http\Controllers\ProductPartsController::class, 'getProductPart'])->name('select2.product_parts');

    });

    Route::get('darkmode', [\App\Http\Controllers\DarkModeController::class, 'setCookie'])->name('dark-mode');
    Route::get('brightmode', [\App\Http\Controllers\DarkModeController::class, 'deleteCookie'])->name('bright-mode');
});


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link!";
});

Route::get('/migrate-seed', function () {
    Artisan::call('migrate:fresh --seed --force');
    return 'migrated:fresh --seed !';
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'migrated!';
});

