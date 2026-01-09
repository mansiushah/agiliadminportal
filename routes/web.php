<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{DashboardController,OrganisationsController,CategoryController,ApiGatewayController,PromocodeController,OfferController,AnalyticsController,InvoiceController};
Route::get('/', function () {
   return redirect()->route('login');
});
Route::get('/test', function () {
   return view('emails.sentnewpassword');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
//After Login route
Route::middleware('auth:admin')->group(function () {
   //Auth Routes
   Route::get('logout', [LoginController::class, 'logout'])->name('logout');
   Route::get('select-otp-option',[LoginController::class,'selectOtpOption'])->name('select-otp-option');
   Route::match(['get', 'post'], 'send-email-or-sms', [LoginController::class, 'SendEmailOrSms'])->name('send-email-or-sms');
   Route::get('resend-otp/{type}', [LoginController::class, 'ResendOTP'])->name('resend-otp');
   Route::post('validate-otp',[LoginController::class,'validateOTP'])->name('validate-otp');
   //home and profile
   Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
   //change password
   Route::get('change-password', [DashboardController::class, 'changePassword'])->name('changepassword');
   Route::post('change-password-update', [DashboardController::class, 'UpdatechangePassword'])->name('update.changepassword');
   //Category
   Route::get('categories', [CategoryController::class, 'index'])->name('categories');
   Route::get('category-add', [CategoryController::class, 'create'])->name('category.add');
   Route::post('category-store', [CategoryController::class, 'store'])->name('category.store');
   Route::get('category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
   Route::post('category-update', [CategoryController::class, 'update'])->name('category.update');
   Route::delete('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
  //Promo code
   Route::get('promocode', [PromocodeController::class, 'index'])->name('promocode');
   Route::get('promocode-add', [PromocodeController::class, 'create'])->name('promocode.add');
   Route::post('promocode-store', [PromocodeController::class, 'store'])->name('promocode.store');
   Route::delete('promocode-delete/{id}', [PromocodeController::class, 'destroy'])->name('promocode.delete');
   // Organisations route
   Route::get('organisations', [OrganisationsController::class, 'index'])->name('organisations');
   Route::get('organisations-add', [OrganisationsController::class, 'create'])->name('organisations.add');
   Route::post('organisations-store', [OrganisationsController::class, 'store'])->name('organisations.store');
   Route::get('organisations-edit/{id}', [OrganisationsController::class, 'edit'])->name('organisations.edit');
   Route::post('organisations-update', [OrganisationsController::class, 'update'])->name('organisations.update');
   Route::get('organisations/{id}', [OrganisationsController::class, 'view'])->name('organisations.view');
   Route::delete('/organisations/{id}', [OrganisationsController::class, 'destroy'])->name('organisations.destroy');
   Route::post('/organisations/userreset/{id}', [OrganisationsController::class, 'resetUserPassword'])->name('organisations.reset.user.password');
   Route::get('/get-tax-registrations/{country_code}', [OrganisationsController::class, 'getTaxRegistrations'])->name('txtcheck');
   Route::get('/org-request', [OrganisationsController::class, 'orgRequest'])->name('orgrequest');
   Route::get('/org-request-approve/{id}', [OrganisationsController::class, 'orgRequestApprove'])->name('orgrequestappove');
   Route::get('/org-request-reject/{id}', [OrganisationsController::class, 'orgRequestReject'])->name('orgrequestreject');
   Route::get('organisations-request-edit/{id}', [OrganisationsController::class, 'editRequest'])->name('request.edit');
   Route::post('organisations-request-update', [OrganisationsController::class, 'updaterequest'])->name('request.update');

   Route::post('/organisations/{id}/filter-users', [OrganisationsController::class, 'filterUsers'])
    ->name('organisations.filterUsers');
   //User Route
   Route::get('organisations-user-add/{id}', [OrganisationsController::class, 'createUser'])->name('organisations.user.add');
   Route::post('organisations-user-store', [OrganisationsController::class, 'StoreUser'])->name('organisations.user.store');
   Route::get('organisations-user-edit/{id}', [OrganisationsController::class, 'editUser'])->name('organisations.user.edit');
   Route::post('organisations-user-update', [OrganisationsController::class, 'updateUser'])->name('organisations.user.update');
   Route::get('organisations-user-disable-all/{id}', [OrganisationsController::class, 'DisableAllUser'])->name('organisations.user.disable.all');
   Route::delete('/organisations-user/{id}', [OrganisationsController::class, 'destroyUser'])->name('organisations.user.destroy');
   Route::get('/get-currencies/{country_code}', [OrganisationsController::class, 'getCurrencies'])->name('get.currencies');

   Route::view('/places-autocomplete', 'place-autocomplete');
   Route::post('/get-place-details', [GooglePlacesController::class, 'getPlaceDetails']);
   //Route::get('/store', [OrganisationsController::class, 'store']);
   //update enviroment
    Route::post('/update-environment', [DashboardController::class, 'updateEnvironment'])
        ->name('update.environment');
   //Api-key
   Route::get('api-keys', [ApiGatewayController::class, 'index'])->name('api-keys');
   Route::delete('/api-keys/{id}', [ApiGatewayController::class, 'DeleteApikey'])->name('api.keys.destroy');
   //invoice
   Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice');
   Route::get('invoice-view', [InvoiceController::class, 'view'])->name('invoice.view');
         //Analytics
   Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/analytics/export-csv', [AnalyticsController::class, 'exportCSV'])->name('analytics.exportCSV');
    Route::get('/analytics/export-pdf', [AnalyticsController::class, 'exportPDF'])->name('analytics.exportPDF');
   //offer
   Route::get('offer', [OfferController::class, 'index'])->name('offer');
   Route::get('offer-view', [OfferController::class, 'view'])->name('offer.view');

});
