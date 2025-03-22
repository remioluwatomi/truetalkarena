<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyInfoController;;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/register', [AuthController::class, 'register'])->name('register');
Route::post('/user/forgetPassword', [AuthController::class, 'forgetPassword']);
Route::post('/admin/forgetPassword', [AdminController::class, 'forgetPassword']);

Route::get('/getInfos', [CompanyInfoController::class, 'index']);

Route::post('/user/updateProfile/{id}', [UserController::class, 'update']);
Route::post('admin/changePassword/{id}', [AdminController::class, 'changePassword']);
Route::post('user/changePassword/{id}', [UserController::class, 'changePassword']);


Route::post('/blog/create', [BlogController::class, 'store']);

Route::post('/admin/updateProfile/{id}', [AdminController::class, 'update']);
Route::post('/user/updateProfile/{id}', [UserController::class, 'update']);
// Route::post('/admin/updateTopic/{id}', [BlogTopicController::class, 'update']);


// Route::post('/addTopic', [BlogTopicController::class, 'store']);
Route::post('/addStaff', [AdminController::class, 'store']);
Route::post('/addImage', [GalleryController::class, 'store']);
// Route::post('/addPortfolio', [PortfolioController::class, 'store']);
// Route::post('/editPortfolio/{id}', [PortfolioController::class, 'update']);
Route::post('/activateStaff/{id}', [AdminController::class, 'update']);
Route::post('/deactivateStaff/{id}', [AdminController::class, 'update']);
Route::post('/updateSettings', [CompanyInfoController::class, 'update']);
Route::post('/updateSocials', [SocialController::class, 'update']);
Route::post('/addSocial', [SocialController::class, 'store']);

Route::post('/deleteImage/{id}', [GalleryController::class, 'destroy']);

// ---------------------------------------------------------------------------

Route::post('/admin/login', [AdminController::class, 'login']);

// -------------------------- Activities -----------------------------------------
// Route::get('/activities/unseen', [ActivityController::class, 'showAdminUnseen']);
// Route::get('/activities/unseen/{id}', [ActivityController::class, 'showUserUnseen']);
// Route::get('/activities', [ActivityController::class, 'index']);
// Route::get('/activities/{id}', [ActivityController::class, 'show']);
// -------------------------- Activities -----------------------------------------

// --------------------------------------------------------------------
Route::post('/user/new/changePassword', [UserController::class, 'resetPassword']);
Route::post('/admin/new/changePassword', [AdminController::class, 'resetPassword']);
Route::post('/user/resend/verification', [UserController::class, 'resendVerification']);
// --------------------------------------------------------------------

Route::post('/initiateTransaction/{id}', [TransactionController::class, 'store']);
Route::post('/verifyTransaction/{orderCode}', [TransactionController::class, 'update']);

Route::post('/addGallery', [GalleryController::class, 'store']);
Route::post('/updateGallery', [GalleryController::class, 'update']);
Route::post('/webhook/flutterwave', [WebhookController::class, 'webhook'])->name('webhook');

Route::post('/news/create ', [BlogController::class, 'store']);
Route::post('/blog/delete/{blog_id}', [BlogController::class, 'destroy']);

Route::post('/video-add', [VideoController::class, 'store']);
Route::post('/video-update', [VideoController::class, 'update']);

Route::post('/contact', [ContactMessageController::class, 'store']);
Route::post('/contacts', [ContactMessageController::class, 'index']);
Route::post('/subcribe', [SubscriberController::class, 'store']);
Route::post('/comment/create', [CommentController::class, 'store']);
Route::post('/reply/create', [ReplyController::class, 'store']);
Route::post('/subcribers', [SubscriberController::class, 'index']);

Route::post('/addAdvert', [AdvertController::class, 'store']);
Route::post('/updateAdvert', [AdvertController::class, 'update']);
Route::post('/addBook', [BookController::class, 'store']);
Route::post('/updateBook', [BookController::class, 'update']);
