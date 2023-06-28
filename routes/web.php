<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoggedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TreadController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\RandomPopupController;
use App\Http\Controllers\VtuController ;



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

// Route::get('/account/clear', function(){
//     \Illuminate\Support\Facades\Artisan::call('config:cache');
//     dd('optimized successfully');
// });

Route::get('/cron', [CronController::class,'cron'])->name('runcron');

// -------------------------------------------------------------------------------------------------


Route::post('/activation', [AuthController::class, 'activation']);

Route::get('/', [AuthController::class, 'home'])->name('home');

Route::get('/site-statistics', [AuthController::class, 'siteStatistics'])->name('siteStatistics');
Route::get('/coupon-checker', [AuthController::class, 'checkCoupon'])->name('checkCoupon');
Route::get('/share/{slug}', [TreadController::class, 'shareSponsoredPost'])->name('shareSponsoredPost');
Route::get('/share-ad/{slug}', [TreadController::class, 'shareAdvert'])->name('shareAdvert');

Route::post('/coupon-checker', [AuthController::class, 'couponCheckerPost'])->name('couponCheckerPost');

Route::get('/activation-code', [AuthController::class, 'activationCode'])->name('activationCode');
Route::get('/how-it-works', [AuthController::class, 'howItWorks'])->name('howItWorks');
Route::get('/todays-payout', [AuthController::class, 'todaysPayout'])->name('todaysPayout');

Route::get('/news', [AuthController::class, 'news'])->name('news');
Route::get('/adverts', [AuthController::class, 'ads'])->name('ads');

Route::get('/terms', [AuthController::class, 'terms'])->name('terms');
Route::get('/howRegister', [AuthController::class, 'howRegister'])->name('howRegister');
Route::get('/about-us', [AuthController::class, 'aboutUs'])->name('aboutUs');

Route::get('/privacy', [AuthController::class, 'privacy'])->name('privacy');
Route::get('/leaderboard', [AuthController::class, 'leaderboard'])->name('leaderboard');
Route::get('/testimonial', [AuthController::class, 'testimonial'])->name('testimonial');

Route::get('/contact-us', [AuthController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [AuthController::class, 'contactPost'])->name('contactPost');


Route::get('marketplace', [AuthController::class, 'marketplace'])->name('marketplace');
Route::get('product/{slug}', [AuthController::class, 'productDetails'])->name('productDetails');
Route::get('product/{id}',[AuthController::class, 'productID'])->name('productID');
Route::post('product/like',[AuthController::class, 'productLike'])->name('productLike');

Route::get('marketplace/search/product',[AuthController::class, 'productSearch'])->name('productSearch');

Route::get('marketplace/category/{slug}', [AuthController::class, 'marketplaceCategory'])->name('marketplaceCategory');
Route::get('marketplace/category/product/{id}',[AuthController::class, 'marketplaceCatID'])->name('marketplaceCatID');



Route::middleware('guest')->group(function() {
    Route::get('/signup',[AuthController::class, 'signup'])->name('signup');
    Route::post('/signup',[AuthController::class, 'signupPost'])->name('signupPost');
    Route::get('/signin',[AuthController::class, 'signin'])->name('signin');
    Route::post('/signin',[AuthController::class, 'signinpost'])->name('signinpost');
    Route::get('/activate/{id}',[AuthController::class, 'activate'])->name('activate');
    Route::get('/account/help/reset-password',[AuthController::class, 'acctPassword'])->name('acctPassword');
    Route::post('/account/help/reset-password',[AuthController::class, 'acctPasswordPost'])->name('acctPasswordPost');
    Route::get('/account/help/reset-password/{id}',[AuthController::class, 'acctPasswordStaged'])->name('acctPasswordStaged');
    Route::post('/account/help/reset-password/{id}',[AuthController::class, 'acctPasswordStagedPost'])->name('acctPasswordStagedPost');

});


Route::middleware('auth')->group(function() {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/account/subscribe' ,[LoggedController::class, 'subscribe'])->name('subscribe');
    Route::post('/account/subscribe/post',[LoggedController::class, 'subscribePost'])->name('subscribePost');
    Route::get('/account',[LoggedController::class, 'account'])->name('account');
    Route::get('/account/verfication',[LoggedController::class, 'verifyAccount'])->name('verifyAccount');
    Route::post('/account/verfication-submit',[LoggedController::class, 'verifyAccountSubmit'])->name('verifyAccountSubmit');

    Route::post('/account/change-email',[LoggedController::class, 'changeEmail'])->name('changeEmail');
    Route::get('/account/send-verification/{id}',[LoggedController::class, 'sendVerify'])->name('sendVerify');

    Route::get('account/predict',[LoggedController::class, 'predict'])->name('predict');
    Route::post('account/predict-post',[LoggedController::class, 'predictPost'])->name('predictPost');

    Route::get('account/lucky-wheel',[LoggedController::class, 'luckyWheel'])->name('lucky-wheel');
    Route::post('account/lucky-wheel-post',[LoggedController::class, 'luckyWheelPost'])->name('luckyWheelPost');
    
    Route::get('/account/createTestimony', [AuthController::class, 'CreateTestimony'])->name('CreateTestimony');
    Route::post('/account/createTestimony/{id}', [AuthController::class, 'editTestimony'])->name('editTestimony');
    Route::post('/account/createTestimony', [AuthController::class, 'storeTestimony'])->name('storeTestimony');

    Route::get('/account/create-job', [JobController::class, 'index'])->name('create-job');
    Route::post('/account/create-job', [JobController::class, 'store'])->name('store');
    Route::post('/account/create-job/{id}', [JobController::class, 'edit'])->name('edit');


    Route::get('/account/profile',[LoggedController::class, 'editAccount'])->name('editAccount');
    Route::get('/account/edit-profile/change-password',[LoggedController::class, 'changePassword'])->name('changePassword');
    Route::post('/account/edit-profile/change-password',[LoggedController::class, 'changePasswordPost'])->name('changePasswordPost');
    Route::post('/account/edit-profile/{id}',[LoggedController::class, 'editAccountPost'])->name('editAccountPost');
    Route::post('/account/settings',[LoggedController::class, 'userSettings'])->name('userSettings');
    
    Route::get('/account/upgrade-plan',[LoggedController::class, 'upgrade'])->name('upgradePlan');
    Route::post('/account/upgrade',[LoggedController::class, 'becomeaproPost'])->name('becomeaproPost');

    Route::get('/account/request/payout', [LoggedController::class, 'requestPayout'])->name('requestPayout');
    Route::post('/account/request/payout',[LoggedController::class, 'requestPayoutPost'])->name('requestPayoutPost');

    Route::get('/account/transaction',[LoggedController::class, 'transactionDetails'])->name('transactionDetails');
    Route::get('/account/earning-history',[LoggedController::class, 'earningHistory'])->name('earningHistory');
    Route::get('/account/notifications',[LoggedController::class, 'notifications'])->name('notifications');

    Route::get('/account/market',[LoggedController::class, 'userMarket'])->name('userMarket');
    Route::get('/account/create/market',[LoggedController::class, 'createMarket'])->name('createMarket');
    Route::post('/account/market/submit-market',[LoggedController::class, 'submitMarket'])->name('submitMarket');
    Route::post('/account/market/edit-market',[LoggedController::class, 'userEditProduct'])->name('userEditProduct');
    Route::get('/account/market/delete-market/{id}',[LoggedController::class, 'userDeleteProduct'])->name('userDeleteProduct');

    Route::get('/account/contest',[LoggedController::class, 'userContest'])->name('userContest');
    Route::post('/account/contest/generate-code',[LoggedController::class, 'userCodeGenerate'])->name('userCodeGenerate');

    Route::post('/account/balance-transfer',[LoggedController::class, 'balanceTransfer'])->name('balanceTransfer');
    Route::get('/account/change-mode/{id}',[LoggedController::class, 'changeMode'])->name('change-mode');

    Route::get('/account/twofactor', [LoggedController::class, 'show2faForm'])->name('twofactor');
    Route::post('/account/twofactor/enable', [LoggedController::class, 'create2fa'])->name('twofactorEnable');
    Route::post('/account/twofactor/disable', [LoggedController::class, 'disable2fa'])->name('twofactorDisable');

    Route::get('/account/my-loans', [LoggedController::class, 'myLoans'])->name('myLoans');
    Route::post('/account/apply-loan/submit', [LoggedController::class, 'submitLoan'])->name('submitLoan');
    Route::get('/account/apply-loan', [LoggedController::class, 'applyLoan'])->name('applyLoan');

    Route::get('/random-popup', [RandomPopupController::class, 'showRandomPopup'])->name('random-popup');
    Route::post('/claim-gift', [RandomPopupController::class, 'claimGift'])->name('claim-gift');
    Route::post('/daily-task', [LoggedController::class, 'dailyTask'])->name('daily-task');

    Route::get('/account/vtu',[VtuController::class, 'vtu'])->name('vtu');
    Route::post('/account/vtu/purchase/data',[VtuController::class, 'purchaseData'])->name('purchaseData');
    Route::post('/get-data-bundles',[VtuController::class, 'getDataBundles']);
});

// Route::middleware('auth', 'influencer')->group(function() {

    Route::get('/influencer',[InfluencerController::class, 'stat'])->name('influencerAccount');
    Route::post('/influencer/request-salary',[InfluencerController::class, 'requestSalary'])->name('requestSalary');

// });

Route::middleware('auth', 'vendor')->group(function() {
    Route::get('/vendo',[VendorController::class, 'coupon'])->name('vendor');
    Route::post('/vendor/coupon/selected/export',[VendorController::class, 'couponExport'])->name('vendorcouponExportSelected');
    Route::get('/vendor/couponused/{used}/',[VendorController::class, 'couponused'])->name('vendorcouponused');

});

Route::middleware('auth', 'moderator')->group(function() {
    Route::get('/moderator',[ModeratorController::class, 'moderatorTreads'])->name('moderator');
    Route::get('/moderator/treads/draft',[ModeratorController::class, 'moderatorTreadsDraft'])->name('moderatorTreadsDraft');
    Route::get('/moderator/treads/published',[ModeratorController::class, 'moderatorTreadsPublished'])->name('moderatorTreadsPublished');
    Route::get('/moderator/search/treads',[ModeratorController::class, 'moderatorSearchTreads'])->name('moderatorSearchTreads');
    Route::get('/moderator/treads/create',[ModeratorController::class, 'moderatorTreadsCreate'])->name('moderatorTreadsCreate');
    Route::post('/moderator/treads/create',[ModeratorController::class, 'moderatorTreadsCreatePost'])->name('moderatorTreadsCreatePost');
    Route::get('/moderator/treads/edit/{id}',[ModeratorController::class, 'moderatorTreadsID'])->name('moderatorTreadsID');
    Route::get('/moderator/treads/selected/{id}',[ModeratorController::class, 'moderatorTreadsSelected'])->name('moderatorTreadsSelected');
    Route::post('/moderator/treads/selected/treads',[ModeratorController::class, 'moderatorTSelected'])->name('moderatorTSelected');
    Route::post('/moderator/treads/selected/treads/draft',[ModeratorController::class, 'moderatorTSelectedDraft'])->name('moderatorTSelectedDraft');
    Route::post('/moderator/treads/edit/{id}/action/{action}',[ModeratorController::class, 'moderatorTreadsIDPostActions'])->name('moderatorTreadsIDPostActions');

    Route::get('/moderator/contest-code',[ModeratorController::class, 'moderatorContestCode'])->name('ContestCode');
    Route::post('/moderator/contest-code/verify',[ModeratorController::class, 'moderatorContestCodeVerify'])->name('ContestCodeVerify');

    Route::get('/moderator/edit/users',[ModeratorController::class, 'editUser'])->name('editUser');
    Route::post('/moderator/user/submit-edit',[ModeratorController::class, 'moderatorEditUser'])->name('userEditSubmit');
    Route::get('/moderator/search/users',[ModeratorController::class, 'moderatorSearchUsers'])->name('moderatorSearchUsers');
    
});

Route::middleware('auth', 'admin')->group(function() {
    Route::get('/admin/',[AdminController::class, 'index'])->name('admin');
    Route::post('/admin/email/{id}',[AdminController::class, 'resendVerification'])->name('resendVerification');
    Route::get('/admin/general-mail',[AdminController::class, 'sendGeneralMail'])->name('sendGeneralMail');
    Route::post('/admin/send/general-mail',[AdminController::class, 'generalMail'])->name('generalMail');

    Route::get('/admin/influencers',[AdminController::class, 'adminInfluencers'])->name('adminInfluencers');
    Route::get('/admin/remove-influencers/{id}',[AdminController::class, 'removeInfluencer'])->name('removeInfluencer');
    Route::get('/admin/add-influencers/{id}',[AdminController::class, 'addInfluencer'])->name('addInfluencer');
    Route::get('/admin/influencers/salary',[AdminController::class, 'influencerSalary'])->name('influencerSalary');
    Route::get('/admin/influencer/salary/rejected',[AdminController::class, 'rejectedSalary'])->name('rejectedSalary');
    Route::get('/admin/influencer/salary/paid',[AdminController::class, 'paidSalary'])->name('paidSalary');

    Route::post('/admin/influencer/reject-salary',[AdminController::class, 'rejectSalary'])->name('rejectSalary');
    Route::post('/admin/influencer/extract-salary',[AdminController::class, 'extractAllSalary'])->name('extractAllSalary');
    Route::post('/admin/influencer/salary/pay',[AdminController::class, 'payAllSalary'])->name('payAllSalary');

    Route::get('/admin/loans',[AdminController::class, 'Loans'])->name('loans');
    Route::get('/admin/loans/approved',[AdminController::class, 'approvedLoans'])->name('approvedLoans');
    Route::get('/admin/loans/approve/{id}',[AdminController::class, 'approveLoan'])->name('approveLoan');
    Route::get('/admin/loans/reject/{id}',[AdminController::class, 'rejectLoan'])->name('rejectLoan');
    Route::get('/admin/loans/settle/{id}',[AdminController::class, 'settleLoan'])->name('settleLoan');

    Route::get('/admin/users',[AdminController::class, 'adminUsers'])->name('adminUsers');
    Route::get('/admin/user/login/{id}',[AdminController::class, 'loginUser'])->name('loginUser');
    Route::get('/admin/vendors',[AdminController::class, 'adminVendors'])->name('adminVendors');
    Route::get('/admin/category',[AdminController::class, 'adminCategory'])->name('adminCategory');
    Route::get('/admin/category/create',[AdminController::class, 'adminCategoryCreate'])->name('adminCategoryCreate');
    Route::post('/admin/category/create',[AdminController::class, 'adminCategoryCreatePost'])->name('adminCategoryCreatePost');
    Route::get('/admin/category/edit{id}',[AdminController::class, 'adminCategoryEditID'])->name('adminCategoryEditID');
    Route::post('/admin/categoryedit/{id}',[AdminController::class, 'adminCategoryEditIDPost'])->name('adminCategoryEditIDPost');
    Route::get('/admin/category/selected/{id}',[AdminController::class, 'adminCategorySelectedID'])->name('adminCategorySelectedID');
    Route::post('/admin/category/selected',[AdminController::class, 'adminCategorySelected'])->name('adminCategorySelected');
    Route::get('/admin/users/create',[AdminController::class, 'adminUsersCreate'])->name('adminUsersCreate');
    Route::post('/admin/users/create',[AdminController::class, 'adminUsersCreatePost'])->name('adminUsersCreatePost');
    Route::get('/admin/users/verified',[AdminController::class, 'adminUsersVerified'])->name('adminUsersVerified');
    Route::get('/admin/users/unverified',[AdminController::class, 'adminUsersUnVerified'])->name('adminUsersUnVerified');
    Route::get('/admin/users/paid',[AdminController::class, 'adminUsersPaid'])->name('adminUsersPaid');
    Route::get('/admin/users/unpaid',[AdminController::class, 'adminUsersUnPaid'])->name('adminUsersUnPaid');
    Route::get('/admin/users/block',[AdminController::class, 'adminUsersBlock'])->name('adminUsersBlock');
    Route::post('/admin/users/selected/block',[AdminController::class, 'adminUsersSelected'])->name('adminUsersSelected');
    Route::post('/admin/users/selected/unblock',[AdminController::class, 'adminUsersUnSelected'])->name('adminUsersUnSelected');
    Route::post('/admin/vendor/selected',[AdminController::class, 'adminVendorSelected'])->name('adminVendorSelected');
    Route::post('/admin/vendor-approve/selected',[AdminController::class, 'adminVendorApproveSelected'])->name('adminVendorApproveSelected');
    Route::post('/admin/users/vendor/selected',[AdminController::class, 'adminUsersVendorSelected'])->name('adminUsersVendorSelected');
    Route::post('/admin/users/moderator/selected',[AdminController::class, 'adminUsersModeratorSelected'])->name('adminUsersModeratorSelected');
    Route::post('/admin/users/re-moderator/selected',[AdminController::class, 'adminUsersRemoderatorSelected'])->name('adminUsersRemoderatorSelected');
    Route::post('/admin/users/remove-vendor/selected',[AdminController::class, 'adminUsersReVendorSelected'])->name('adminUsersReVendorSelected');
    Route::get('/admin/users/selected/{id}/block',[AdminController::class, 'adminUsID'])->name('adminUsID');
    Route::get('/admin/users/selected/{id}/unblock',[AdminController::class, 'adminUsUnID'])->name('adminUsUnID');
    Route::get('/admin/vendors/selected/{id}',[AdminController::class, 'adminVdID'])->name('adminVdID');
    Route::get('/admin/users/edit/{id}',[AdminController::class, 'adminUsEdit'])->name('adminUsEdit');
    Route::post('/admin/users/edit/{id}',[AdminController::class, 'adminUsEditPost'])->name('adminUsEditPost');
    Route::post('/admin/users/{id}/update-balance',[AdminController::class, 'updateBalance'])->name('updateBalance');
    Route::post('/admin/users/edit/password/{id}',[AdminController::class, 'adminUsEditPasswordPost'])->name('adminUsEditPasswordPost');
    Route::post('/admin/users/edit/membership/{id}/{userid}',[AdminController::class, 'adminUsEditmembershipPost'])->name('adminUsEditmembershipPost');
    Route::get('/admin/treads',[AdminController::class, 'adminTreads'])->name('adminTreads');
    Route::get('/admin/treads/draft',[AdminController::class, 'adminTreadsDraft'])->name('adminTreadsDraft');
    Route::get('/admin/treads/published',[AdminController::class, 'adminTreadsPublished'])->name('adminTreadsPublished');
    Route::get('/admin/treads/create',[AdminController::class, 'adminTreadsCreate'])->name('adminTreadsCreate');
    Route::post('/admin/treads/create',[AdminController::class, 'adminTreadsCreatePost'])->name('adminTreadsCreatePost');
    Route::get('/admin/treads/edit/{id}',[AdminController::class, 'adminTreadsID'])->name('adminTreadsID');
    Route::get('/admin/treads/selected/{id}',[AdminController::class, 'adminTreadsSelected'])->name('adminTreadsSelected');
    Route::post('/admin/treads/selected/treads',[AdminController::class, 'adminTSelected'])->name('adminTSelected');

    Route::get('/admin/adverts',[AdminController::class, 'allAdverts'])->name('allAdverts'); 
    Route::get('/admin/advert/create',[AdminController::class, 'advertCreate'])->name('advertCreate'); 
    Route::post('/admin/create/advert',[AdminController::class, 'advertCreatePost'])->name('advertCreatePost');
    Route::get('/admin/advert/edit/{id}',[AdminController::class, 'advertEdit'])->name('advertEdit');
    Route::post('/admin/edit/advert/{id}',[AdminController::class, 'advertEditPost'])->name('advertEditPost');
    Route::get('/admin/advert/delete/{id}',[AdminController::class, 'advertDelete'])->name('advertDelete');

    Route::post('/admin/treads/selected/treads/draft',[AdminController::class, 'adminTSelectedDraft'])->name('adminTSelectedDraft');
    Route::post('/admin/treads/edit/{id}/action/{action}',[AdminController::class, 'adminTreadsIDPostActions'])->name('adminTreadsIDPostActions');

    Route::get('/admin/headers',[AdminController::class, 'AdminHeader'])->name('AdminHeader');
    Route::post('/admin/headers',[AdminController::class, 'AdminHeaderPost'])->name('AdminHeaderPost');
    Route::get('/admin/activity',[AdminController::class, 'adminActivity'])->name('adminActivity');
    Route::post('/admin/activity/settings',[AdminController::class, 'siteActivity'])->name('siteActivity');
    Route::post('/admin/auto-withdrawal/settings',[AdminController::class, 'autoWithdrawSettings'])->name('autoWithdrawSettings');
    Route::post('/admin/headers/{id}',[AdminController::class, 'AdminHeaderPost2'])->name('AdminHeaderPost2');

    
    Route::get('/admin/comments/edit/{id}',[AdminController::class, 'adminCommentEditPost'])->name('adminCommentEditPost');

    Route::post('/admin/comments/edit/{id}',[AdminController::class, 'adminCommentEditPost2'])->name('adminCommentEditPost2');
    
    Route::get('/admin/how-it-work/site',[AdminController::class, 'adminHowItWorkSite'])->name('adminHowItWorkSite');

    Route::post('/admin/how-it-works/site',[AdminController::class, 'adminHowItWorkSitePost'])->name('adminHowItWorkSitePost');

    Route::post('/admin/how-to-register/site',[AdminController::class, 'adminHowToRegisterPost'])->name('adminHowToRegisterPost');
    
    Route::post('/admin/terms/site',[AdminController::class, 'adminTermsPost'])->name('adminTermsPost');
    
    Route::get('/admin/top-earners',[AdminController::class, 'adminTopEarners'])->name('adminTopEarners');

    Route::post('/admin/top-earners',[AdminController::class, 'adminTopEarnersPost'])->name('adminTopEarnersPost');
    
    Route::get('/admin/notification/site',[AdminController::class, 'adminNotificationSite'])->name('adminNotificationSite');

    Route::post('/admin/notification/site',[AdminController::class, 'adminNotificationSitePost'])->name('adminNotificationSitePost');

    Route::get('/admin/request/payout/open',[AdminController::class, 'requestPayoutOpen'])->name('requestPayoutOpen');

    Route::post('/admin/request/payout/open',[AdminController::class, 'requestPayoutOpenPost'])->name('requestPayoutOpenPost');

    Route::post('/admin/clear-spin',[AdminController::class, 'clearSpin'])->name('clearSpin');

    Route::get('/admin/request/payout/all',[AdminController::class, 'requestPayoutAll'])->name('requestPayoutAll');

    Route::get('/admin/request/payout/wallet',[AdminController::class, 'requestPayoutWallet'])->name('requestPayoutWallet');

    Route::get('/admin/request/payout/allowi',[AdminController::class, 'requestPayoutAllowi'])->name('requestPayoutAllowi');

    Route::get('/admin/request/payout/wallet-allowi',[AdminController::class, 'requestPayoutWalletAllowi'])->name('requestPayoutWalletAllowi');
    
    Route::get('/admin/request/payout/data',[AdminController::class, 'requestPayoutData'])->name('requestPayoutData');

    Route::get('/admin/request/payout/paid',[AdminController::class, 'requestPayoutPaid'])->name('requestPayoutPaid');

    Route::get('/admin/request/payout/unpaid',[AdminController::class, 'requestPayoutUnPaid'])->name('requestPayoutUnPaid');

    Route::get('/admin/request/payout/{id}',[AdminController::class, 'requestPayoutID'])->name('requestPayoutID');

    Route::post('/admin/request/payout/{id}/balance',[AdminController::class, 'clearUserBalance'])->name('clearUserBalance');

    Route::post('/admin/request/payout/trash/selected',[AdminController::class, 'clearPayoutRequestID'])->name('clearPayoutRequestID');

    Route::post('/admin/request/payout/extract/selected',[AdminController::class, 'extractPayoutRequestID'])->name('extractPayoutRequestID');
    
    Route::post('/admin/request/payout/export', [AdminController::class, 'dataExport'])->name('dataExportSelected');
    
    Route::post('/admin/request/payout/allDataExport', [AdminController::class, 'allDataExport'])->name('allDataExport');
    
    Route::post('/admin/request/payout/allAffiliateExport', [AdminController::class, 'allAffiliateExport'])->name('allAffiliateExport');

    Route::post('/admin/request-payout/payall',[AdminController::class, 'paidallPayoutRequestID'])->name('paidallPayoutRequestID');

    Route::post('/admin/request/payout/paidall/generalAffiliate',[AdminController::class, 'generalPayAffiliate'])->name('generalPayAffiliate');

    Route::post('/admin/request/payout/paidall/generalActivities',[AdminController::class, 'generalPayActivities'])->name('generalPayActivities');

    Route::get('/admin/request/payout/trash/{id}',[AdminController::class, 'clearPayoutRequestSelectedID'])->name('clearPayoutRequestSelectedID');

    Route::get('/admin/request/payout/trash/{id}/single',[AdminController::class, 'clearPayoutRequestID2'])->name('clearPayoutRequestID2');
    
    Route::get('/admin/search/treads',[AdminController::class, 'adminSearchTreads'])->name('adminSearchTreads');

    Route::get('/admin/search/users',[AdminController::class, 'adminSearchUsers'])->name('adminSearchUsers');

    Route::get('/admin/search/support',[AdminController::class, 'adminSearchSupport'])->name('adminSearchSupport');

    Route::get('/admin/search/comments',[AdminController::class, 'adminSearchComments'])->name('adminSearchComments');

    Route::get('/admin/search/categories',[AdminController::class, 'adminSearchCategories'])->name('adminSearchCategories');

    Route::get('/admin/search/payouts',[AdminController::class, 'adminSearchPayouts'])->name('adminSearchPayouts');
        
    Route::get('/admin/file-manager', [AdminController::class, 'Fmanager'])->name('Fmanager');

    Route::get('/admin/coupon', [AdminController::class, 'coupon'])->name('coupon');

    Route::get('/admin/couponused/{used}/', [AdminController::class, 'couponused'])->name('couponused');

    Route::get('/admin/coupon/create', [AdminController::class, 'couponCreate'])->name('couponCreate');

    Route::post('/admin/coupon/create', [AdminController::class, 'couponCreatePost'])->name('couponCreatePost');

    Route::get('/admin/coupon/trash/{id}', [AdminController::class, 'couponTrashSelected'])->name('couponTrashSelected');

    Route::post('/admin/coupon/selected/trash', [AdminController::class, 'couponTrashSelected2'])->name('couponTrashSelected2');

    Route::post('/admin/coupon/selected/export', [AdminController::class, 'couponExport'])->name('couponExportSelected');
	
    Route::get('/admin/plans', [AdminController::class, 'plan'])->name('plan');
    
    Route::post('/admin/cron', [AdminController::class, 'cron'])->name('cron');

    Route::get('/admin/plan/create', [AdminController::class, 'planCreate'])->name('planCreate');

    Route::post('/admin/plan/create/post', [AdminController::class, 'planCreatePost'])->name('planCreatePost');

    Route::get('/admin/bundles', [AdminController::class, 'bundle'])->name('bundle');

    Route::get('/admin/subscribers', [AdminController::class, 'mysubscriber'])->name('mysubscriber');

    Route::get('/admin/bundle/create', [AdminController::class, 'bundleCreate'])->name('bundleCreate');

    Route::post('/admin/bundle/create/post', [AdminController::class, 'bundleCreatePost'])->name('bundleCreatePost');

    Route::get('/admin/bundle/edit/{id}', [AdminController::class, 'editBundle'])->name('editBundle');
    Route::post('/admin/bundle/edit/{id}', [AdminController::class, 'editBundlePost'])->name('editBundlePost');
	
    Route::get('/admin/plan/edit/{id}', [AdminController::class, 'editPlan'])->name('editPlan');

    Route::post('/admin/plan/edit/{id}', [AdminController::class, 'editPlanPost'])->name('editPlanPost');

    Route::get('/admin/testimonies', [AdminController::class, 'adminViewTestimony'])->name('allTestimonies');
    Route::get('/admin/create-new-testimony', [AdminController::class, 'createTestimony'])->name('createTestimony');

    Route::post('/admin/create-testimony', [AdminController::class, 'createTestimonyPost'])->name('createTestimonyPost');
    Route::get('/admin/delete-testimony/{id}', [AdminController::class, 'deleteTestimonyPost'])->name('deleteTestimonyPost');

    Route::get('/admin/quiz', [AdminController::class, 'quiz'])->name('quiz');
    Route::get('/admin/create-quiz', [AdminController::class, 'createQuiz'])->name('createQuiz');
    Route::get('/admin/quiz/answers/{id}', [AdminController::class, 'quizAnswers'])->name('quizAnswers');

    Route::get('/admin/quiz/answers/approve/{id}', [AdminController::class, 'quizAnswersApprove'])->name('quizAnswersApprove');
    Route::post('/admin/quiz-post', [AdminController::class, 'createQuizPost'])->name('createQuizPost');
    Route::post('/admin/quiz-edit', [AdminController::class, 'editQuizPost'])->name('editQuizPost');
    Route::get('/admin/delete-quiz/{id}', [AdminController::class, 'deleteQuizPost'])->name('deleteQuizPost');
    Route::get('/admin/disabled-quiz/{id}', [AdminController::class, 'disableQuizPost'])->name('disableQuizPost');

    Route::get('admin/market',[AdminController::class, 'marketControl'])->name('marketOverview');
    Route::get('admin/market/approve/{id}',[AdminController::class, 'approveProduct'])->name('approveProduct');
    Route::get('admin/market/reject/{id}',[AdminController::class, 'rejectProduct'])->name('rejectProduct');

    Route::get('admin/market/category',[AdminController::class, 'marketCategory'])->name('marketCategory');
    Route::post('admin/market/category/submit',[AdminController::class, 'submitMarketCategory'])->name('submitMarketCategory');
    Route::post('admin/market/category/edit',[AdminController::class, 'editMarketCategory'])->name('editMarketCategory');

    Route::get('admin/contest',[AdminController::class, 'adminContest'])->name('adminContest');
    Route::post('admin/contest/create',[AdminController::class, 'adminContestCreate'])->name('adminContestCreate');
    Route::get('admin/contest/edit/{id}',[AdminController::class, 'adminContestEdit'])->name('adminContestEdit');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function (){
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/search',[TreadController::class, 'search'])->name('search');

Route::get('/ref',[AuthController::class, 'refFallback'])->name('refFallback');


Route::get('/category/{id}',[TreadController::class, 'cat'])->name('cat');

Route::get('tread/{id}',[TreadController::class, 'treadID'])->name('treadID');
Route::get('post/{slug}',[TreadController::class, 'tread'])->name('tread');

Route::get('ads/{id}',[TreadController::class, 'AdsID'])->name('AdsID');
Route::get('advert-details/{slug}',[TreadController::class, 'AdsE'])->name('advert.post');

// Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('verified');