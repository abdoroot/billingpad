<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/showBill/{id}', [App\Http\Controllers\BillController::class, 'showBill'])->name('showBill');
Route::get('/showBill/{id}/{download}', [App\Http\Controllers\BillController::class, 'showBill'])->name('showBillAndDownload');

Route::middleware(['auth'])->group(function() {

    Route::get('/', function () {
        $store = \App\Models\storeDetails::find(1);
        $user = Auth::user();
        return view('home',compact('store','user'));
    });

    Route::get('/newBill', [App\Http\Controllers\BillController::class, 'newBill'])->name('newBill');
    Route::get('/allBills', [App\Http\Controllers\BillController::class, 'allBills'])->name('allBills');
    Route::post('/saveBill', [App\Http\Controllers\BillController::class, 'saveBill'])->name('saveBill');

    //send email
    Route::Post('/showBill/{id}', [App\Http\Controllers\BillController::class, 'showBill'])->name('sendEmail');
    Route::get('/deleteBill/{id}', [App\Http\Controllers\BillController::class, 'deleteBill'])->name('deleteBill');

    Route::get('/storeDetails', [App\Http\Controllers\StoreDetailsController::class, 'storeDetails'])->name('storeDetails');
    Route::post('/storeDetails', [App\Http\Controllers\StoreDetailsController::class, 'UpdateStoreDetails'])->name('UpdateStoreDetails');
});
