<?php

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\CtvController;
use App\Http\Controllers\Api\Admin\WebsiteController;
use App\Http\Controllers\Api\Admin\PromotionController;

use App\Http\Controllers\Api\Admin\PacketMilkController;
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

// Route::get('/', function () {
//     return view('index');
// });
// Route::get('/', [ProductsController::class,'list_banner_index'])->name('index');
// Route::get('/', [ProductsController::class,'list_titlebanner_index'])->name('index');
// Route::get('/', [ProductsController::class,'list_introduce_index'])->name('index');
Route::get('/', [ProductsController::class,'list_products_index'])->name('index');
Route::post('/', [ProductsController::class,'CSKH'])->name('CSKH');
Route::get('/san-pham/page={i}', [ProductsController::class,'list_products'])->name('danhSachSanPham');
Route::get('/gioi-thieu-san-pham/{id}', [ProductsController::class,'products_detail'])->name('sanPham');

Route::get('/khuyen-mai', [ProductsController::class,'list_promotion'])->name('promotion');
Route::get('/khuyen-mai-chi-tiet/{id}', [ProductsController::class,'promotion_detail'])->name('promotion-details');
// Route::view('/tam-nhin-su-menh', 'includes.vision')->name('tam-nhin-su-menh');

Route::get('/su-kien/page={i}',[ProductsController::class,'list_event'])->name('event');
Route::get('/chi-tiet-su-kien/{id}', [ProductsController::class,'event_detail'])->name('event-detail');
Route::get('/chinh-sach-kinh-doanh', [ProductsController::class,'list_policy'])->name('policy');

//admin
Route::view('/product-promotion', 'includes.admin.pages.product-promotion');
Route::view('/product-similar', 'includes.admin.pages.product-similar');
Route::view('/banner', 'includes.admin.pages.banner');
Route::view('/promotion', 'includes.admin.pages.promotion');
Route::view('/policy', 'includes.admin.pages.policy');
Route::view('/event', 'includes.admin.pages.event');
Route::view('/news', 'includes.admin.pages.news');
Route::view('/login-admin', 'includes.admin.pages.login-admin');

Route::view('/add-banner', 'includes.admin.add.add-banner');
Route::view('/add-event', 'includes.admin.add.add-event');
Route::view('/add-product-promotion', 'includes.admin.add.add-product-promotion');
Route::view('/add-product-similar', 'includes.admin.add.add-product-similar');
Route::view('/add-promotion', 'includes.admin.add.add-promotion');
Route::view('/add-policy', 'includes.admin.add.add-policy');
Route::view('/add-news', 'includes.admin.add.add-news');

Route::view('/edit-banner', 'includes.admin.edit.edit-banner');
Route::view('/edit-event', 'includes.admin.edit.edit-event');
Route::view('/edit-product-promotion', 'includes.admin.edit.edit-product-promotion');
Route::view('/edit-product-similar', 'includes.admin.edit.edit-product-similar');
Route::view('/edit-promotion', 'includes.admin.edit.edit-promotion');
Route::view('/edit-policy', 'includes.admin.edit.edit-policy');
Route::view('/edit-news', 'includes.admin.edit.edit-news');



Route::group(['prefix' => 'admin'], function () {
    Route::get('/backPage', [AdminController::class, 'backPage'])->name('backPage');
    Route::get('/', [AdminController::class, 'checkToken'])->name('login');
    Route::post('/login', [AdminController::class, 'checkLogin'])->name('checkLogin');
    Route::get('/trang-chu', [AdminController::class, 'checkToken'])->name('trang-chu');
    Route::get('/logOut', [AdminController::class, 'logOut'])->name('logOut');
    Route::get('/thong-tin-tai-khoan', [AdminController::class, 'viewInfo'])->name('getInfoAdmin');
    Route::get('/cap-nhat-thong-tin', [AdminController::class, 'viewUpdateInfo'])->name('viewUpdateInfo');
    Route::put('/cap-nhat-thong-tin-tai-khoan', [AdminController::class, 'updateInfo'])->name('updateInfo');
    Route::view('/cap-nhat-mat-khau', 'admin.includes.updatePassword')->name('viewUpdatePassword');
    Route::put('/cap-nhat-mat-khau-tai-khoan', [AdminController::class, 'updatePassword'])->name('updatePassword');
    Route::view('/goi-sua', 'admin.includes.packet_milk.add_packet_milk')->name('them-goi-sua');
    Route::get('/ds-goi-sua', [PacketMilkController::class, 'listPacket'])->name('danh-sach-goi-sua');
    Route::get('/chi-tiet-goi-sua/{id}', [PacketMilkController::class, 'detailPacket'])->name('chi-tiet-goi-sua');
    Route::get('/cap-nhat-goi/{id}', [PacketMilkController::class, 'updatePacket'])->name('cap-nhat-goi');
    Route::post('/updatepacketSUA', [PacketMilkController::class, 'updatepacketSUA'])->name('updatepacketSUA');
    Route::post('/deleteSP/{id}', [PacketMilkController::class, 'deleteSP'])->name('deleteSP');
    Route::post('/notify', [AdminController::class, 'notify'])->name('notify');
    Route::get('/thong-bao/page={i}', [AdminController::class, 'notifyy'])->name('listNotify');


    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('/danh-sach/{i}', [ProductController::class, 'listProduct'])->name('listProduct');
        Route::get('/chi-tiet/{id}', [ProductController::class, 'viewInfoProduct'])->name('chi-tiet-san-pham');
        Route::get('/xoa/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::get('/them-moi', [ProductController::class, 'viewAddProduct'])->name('viewAddProduct');
        Route::post('/them-moi-san-pham', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::get('/cap-nhat-san-pham/{id}', [ProductController::class, 'viewUpdateProduct'])->name('viewUpdateProduct');
        Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');

        Route::get('/cam-nhan-san-pham/{id}', [ProductController::class, 'productFeel'])->name('productFeel');
        Route::get('xoa-cam-nhan/{id}', [ProductController::class, 'deleteProductFeel'])->name('deleteProductFeel');
        Route::get('/them-cam-nhan/{id}', [ProductController::class, 'viewAddProductFeel'])->name('viewAddProductFeel');
        Route::post('/add-product-feel/{id}', [ProductController::class, 'addProductFeel'])->name('addProductFeel');
        Route::get('/cap-nhat-cam-nhan-san-pham/{id}', [ProductController::class, 'viewUpdateProductFeel'])->name('viewUpdateProductFeel');
        Route::post('/update-product-feel/{id}', [ProductController::class, 'updateProductFeel'])->name('updateProductFeel');

    });

    Route::group(['prefix' => 'mua-goi'], function () {
        Route::get('/danh-sach/{i}', [ProductController::class, 'listBuyPacket'])->name('listBuyPacket');
        Route::get('chi-tiet/{id}', [ProductController::class, 'infoBuyPacket'])->name('infoBuyPacket');
        Route::put('thay-doi-trang-thai/{id}', [ProductController::class, 'changeStatus'])->name('changeStatus');
        Route::get('xoa/{id}', [ProductController::class, 'deleteBuyPacket'])->name('deleteBuyPacket');

    });

    Route::group(['prefix' => 'ctv'], function () {
        Route::get('/danh-sach/{i}', [CtvController::class, 'listCTV'])->name('listCTV');
        Route::get('/danh-sach-dinh-danh', [CtvController::class, 'listIdentifier'])->name('listIdentifier');
        Route::view('/them-dinh-danh', 'admin.includes.ctv.addIdentifier')->name('them-dinh-danh');
        Route::post('/them-moi', [CtvController::class, 'addIdentifier'])->name('addIdentifier');
        Route::get('/xoa/{id}', [CtvController::class, 'deleteIdentifier'])->name('deleteIdentifier');
        Route::get('/cap-nhat/{id}', [CtvController::class, 'viewUpdateIdentifier'])->name('viewUpdateIdentifier');
        Route::put('/cap-nhat-dinh-danh/{id}', [CtvController::class, 'updateIdentifier'])->name('updateIdentifier');
        Route::get('/them-moi-cong-tac-vien', [CtvController::class, 'viewAddCtv'])->name('viewAddCtv');
        Route::post('/them-moi-ctv', [CtvController::class, 'addCtv'])->name('addCtv');
        Route::get('/chi-tiet-cong-tac-vien/{id}', [CtvController::class, 'infoCtv'])->name('infoCtv');
        Route::get('/xoa-ctv/{id}', [CtvController::class, 'delete'])->name('delete');
        Route::get('/reset-password/{id}', [CtvController::class, 'resetPassword'])->name('resetPassword');
        Route::get('/cap-nhat-thong-tin/{id}', [CtvController::class, 'viewUpdateCtv'])->name('viewUpdateCtv');
        Route::put('/cap-nhat-ctv/{id}', [CtvController::class, 'updateCtv'])->name('updateCtv');
        Route::get('/danh-sach-cong-doanh-thu/{i}', [CtvController::class, 'listAddRevenue'])->name('listAddRevenue');
        Route::post('/xac-nhan-cong-doanh-so/{id}', [CtvController::class, 'confirmadd'])->name('confirmadd');
        Route::get('/xoa-cong-doanh-so/{id}', [CtvController::class, 'deleteadd'])->name('deleteadd');
        Route::get('/danh-sach-cay-he-thong', [CtvController::class, 'listTree'])->name('listTree');

        // Route::get('chi-tiet/{id}', [ProductController::class, 'infoBuyPacket'])->name('infoBuyPacket');
        // Route::put('thay-doi-trang-thai/{id}', [ProductController::class, 'changeStatus'])->name('changeStatus');
        // Route::get('xoa/{id}', [ProductController::class, 'deleteBuyPacket'])->name('deleteBuyPacket');

    });

    Route::group(['prefix' => 'website'], function () {
        Route::get('/chinh-sach-kinh-doanh', [WebsiteController::class, 'listPolicy'])->name('listPolicy');
        Route::get('/xoa-chinh-sach/{id}', [WebsiteController::class, 'deletePolicy'])->name('deletePolicy');
        Route::view('them-moi-chinh-sach-kinh-doanh', 'admin.includes.website.addPolicy')->name('viewAddPolicy');
        Route::post('add-policy', [WebsiteController::class, 'addPolicy'])->name('addPolicy');
        Route::get('cap-nhat-chinh-sach/{i}', [WebsiteController::class, 'viewUpdatePolicy'])->name('viewUpdatePolicy');
        Route::post('update-policy/{id}', [WebsiteController::class, 'updatePolicy'])->name('updatePolicy');

        Route::get('/su-kien/{i}', [WebsiteController::class, 'listEvent'])->name('listEvent');
        Route::view('them-moi-su-kien', 'admin.includes.website.addEvent')->name('viewAddEvent');
        Route::post('add-event', [WebsiteController::class, 'addEvent'])->name('addEvent');
        Route::get('/chi-tiet-su-kien/{id}', [WebsiteController::class, 'viewDetailEvent'])->name('viewDetailEvent');
        Route::get('/cap-nhat-su-kien/{id}', [WebsiteController::class, 'viewUpdateEvent'])->name('viewUpdateEvent');
        Route::post('/update-event/{id}', [WebsiteController::class, 'updateEvent'])->name('updateEvent');
        Route::get('/delete-event/{id}', [WebsiteController::class, 'deleteEvent'])->name('deleteEvent');
        
        Route::get('/khuyen-mai', [PromotionController::class, 'listPromotion'])->name('listPromotion');
        Route::view('them-moi-khuyen-mai', 'admin.includes.website.promotion.addPromotion')->name('viewAddpromotion');
        Route::post('add-promotion', [PromotionController::class, 'addPromotion'])->name('addPromotion');
        Route::get('chi-tiet-khuyen-mai/{id}', [PromotionController::class, 'viewDetailPromotion'])->name('viewDetailPromotion');
        Route::get('cap-nhat-khuyen-mai/{id}', [PromotionController::class, 'viewUpdatePromotion'])->name('viewUpdatePromotion');
        Route::post('update-promotion/{id}', [PromotionController::class, 'updatePromotion'])->name('updatePromotion');
        Route::get('/xoa-khuyen-mai/{id}', [PromotionController::class, 'deletePromotion'])->name('deletePromotion');

        Route::get('/danh-sach-banner', [WebsiteController::class, 'listBanner'])->name('listBanner');
        Route::get('/xoa-banner/{id}', [WebsiteController::class, 'deleteBanner'])->name('deleteBanner');
        Route::view('/them-moi-banner', 'admin.includes.website.addBanner')->name('viewAddBanner');
        Route::post('/add-banner', [WebsiteController::class, 'addBanner'])->name('addBanner');
        Route::get('/cap-nhat-banner/{id}', [WebsiteController::class, 'viewUpdateBanner'])->name('viewUpdateBanner');
        Route::post('/update-banner/{id}', [WebsiteController::class, 'updateBanner'])->name('updateBanner');

        Route::get('/tieu-de-banner', [PromotionController::class, 'titleBanner'])->name('titleBanner');
        Route::get('/chi-tiet-tieu-de-banner', [PromotionController::class, 'DetailtitleBanner'])->name('DetailtitleBanner');
        Route::get('/cap-nhat-title-banner/{id}', [PromotionController::class, 'viewUpdateTitlebanner'])->name('viewUpdateTitlebanner');
        Route::post('update-titlebanner/{id}', [PromotionController::class, 'updatetitlebanner'])->name('updatetitlebanner');

        Route::get('/van-phong-tru-so', [WebsiteController::class, 'listHeadquarter'])->name('listHeadquarter');
        Route::view('/them-moi-tru-so', 'admin.includes.website.addHeadquarter')->name('viewAddHeadquarter');
        Route::post('/add-headquarter', [WebsiteController::class,'addHeadquarter'])->name('addHeadquarter');
        Route::get('/chi-tiet-tru-so/{id}', [WebsiteController::class, 'infoHeadquarter'])->name('infoHeadquarter');
        Route::get('/cap-nhat-tru-so/{id}', [WebsiteController::class, 'viewUpdateHeadquarter'])->name('viewUpdateHeadquarter');
        Route::post('/update-headquarter/{id}', [WebsiteController::class, 'updateHeadquarter'])->name('updateHeadquarter');
        Route::get('/xoa-tru-so/{id}', [WebsiteController::class, 'deleteHeadquarter'])->name('deleteHeadquarter');

        Route::get('/gioi-thieu', [PromotionController::class, 'listIntro'])->name('listIntro');
        Route::get('/chi-tiet-gioi-thieu', [PromotionController::class, 'Detailintro'])->name('Detailintro');
        Route::get('/cap-nhat-gioi-thieu/{id}', [PromotionController::class, 'viewUpdateIntro'])->name('viewUpdateIntro');
        Route::post('update-introduce/{id}', [PromotionController::class, 'updateIntro'])->name('updateIntro');

        Route::get('/cham-soc-khach-hang', [PromotionController::class, 'listCus'])->name('listCus');
        
    });
});
