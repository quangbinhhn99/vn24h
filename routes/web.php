<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CTVController;
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

Route::view('/', 'welcome')->name('dang-nhap');
Route::view('/dang-ki', 'includes.register');
Route::get('/goi-sua', [CTVController::class,'Packet'])->name('goi-sua');
Route::get('/goi-mua-sua', [CTVController::class,'buyPacket'])->name('goi-mua-sua');
Route::get('/chi-tiet-goi-mua/id={id}', [CTVController::class,'buyPacketDetail'])->name('chi-tiet-goi-mua');
Route::get('/huy-goi-mua/id={id}', [CTVController::class,'deleteBuyPacket'])->name('huy-goi-mua');

Route::get('/ctv-tuyen-duoi', [CTVController::class,'CTVrevenue'])->name('ctv-tuyen-duoi');
Route::get('/chi-tiet-doanh-thu/id={id}', [CTVController::class,'CTVrevenueDetail'])->name('chi-tiet-doanh-thu');

Route::get('/cong-doanh-so', [CTVController::class,'CTVcalculator'])->name('cong-doanh-so');
Route::get('/chi-tiet-cong-doanh-so/id={id}', [CTVController::class,'CTVcalculatorDetail'])->name('chi-tiet-cong-doanh-so');
Route::post('/updateADD/{id}', [CTVController::class,'updateADD'])->name('updateADD');
Route::post('/deleteADD/{id}', [CTVController::class,'deleteADD'])->name('deleteADD');

Route::get('/chi-tiet-goi-sua/id={id}', [CTVController::class,'Packetdetail'])->name('chi-tiet-goi-sua');
Route::get('/dat-mua-sua/id={id}',[CTVController::class,'Order'])->name('dat-mua-sua');

Route::post('/register', [CTVController::class, 'register'])->name('register');
Route::post('/login', [CTVController::class, 'login'])->name('login');
Route::get('/logout', [CTVController::class, 'logout'])->name('logout');
Route::get('/trang-chu', [CTVController::class, 'getUserInfo'])->name('trang-chu');
Route::get('/updateCTV', [CTVController::class, 'updateCTV'])->name('updateCTV');
Route::get('/PassCTV', [CTVController::class, 'PassCTV'])->name('PassCTV');
Route::post('/comfirmOrder', [CTVController::class, 'comfirmOrder'])->name('comfirmOrder');
Route::post('/comfirmDddrevenue', [CTVController::class, 'comfirmDddrevenue'])->name('comfirmDddrevenue');

Route::post('/notify', [CTVController::class, 'notify'])->name('notify');
Route::get('/thong-bao/page={i}', [CTVController::class, 'notifyy'])->name('listNotify');
