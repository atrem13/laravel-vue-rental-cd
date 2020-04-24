<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('member', 'MemberController');
Route::apiResource('distributor', 'DistributorController');
Route::apiResource('kategori_kaset', 'KategoriKasetController');
Route::apiResource('kategori_film', 'KategoriFilmController');
Route::apiResource('rak', 'RakController');
Route::apiResource('kaset', 'KasetController');
Route::get('/create/kaset', 'CreateKasetApiController@index');
Route::apiResource('penyewaan', 'PenyewaanController');
Route::get('/create/penyewaan', 'CreatePenyewaanApiController@index');
Route::apiResource('detail_penyewaan', 'DetailPenyewaanController');
Route::get('/create/detail_penyewaan/{id}', 'CreateDetailPenyewaanApi@index');
Route::apiResource('booking_penyewaan', 'BookingPenyewaanController');
Route::get('/create/booking_penyewaan/', 'CreateBookingPenyewaanApi@index');
Route::apiResource('detail_booking_penyewaan', 'DetailBookingPenyewaanController');
Route::get('/create/detail_booking_penyewaan/{id}', 'CreateDetailBookingPenyewaanController@index');

Route::group(['prefix' => 'pengembalian'], function() {
    Route::get('/{id}/', 'PengembalianController@index');
    Route::post('/konfirm', 'PengembalianController@konfirm');
});

Route::apiResource('booking_penyewaan_tersedia', 'BookingPenyewaanTersediaController');

