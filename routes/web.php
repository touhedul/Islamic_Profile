<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
//Home
Route::get('/', 'HomeController@index')->name('home');
//User Routes
Route::resource('user', 'User\UserProfileController');

Route::get('users/change-password', 'User\ChangePasswordController@changePasswordView')->name('change.password.view');
Route::post('users/change-password', 'User\ChangePasswordController@changePassword')->name('change.password');
//Email Verification
Route::get('users/{token}', 'User\EmailVerificationController@verify')->name('user.email.verification');

//Salat creation Routes
Route::post('fajr', 'User\SalatCreationController@createFajr');
Route::post('zuhr', 'User\SalatCreationController@createZuhr');
Route::post('asr', 'User\SalatCreationController@createAsr');
Route::post('maghrib', 'User\SalatCreationController@createMaghrib');
Route::post('isha', 'User\SalatCreationController@createIsha');
Route::post('witr', 'User\SalatCreationController@createWitr');

//Salat Controller Routes
Route::get('salat', 'User\SalatController@index')->name('salat.index');

Route::middleware(['onlyAjaxRequest'])->group(function () {

    Route::get('single-salat/{salatName}', 'User\SalatController@getSingleSalat')->name('single.salat.get');
    Route::get('salat-performe', 'User\SalatController@salatPerforme')->name('salat.performe');
    Route::post('salat-performe-change', 'User\SalatController@salatPerformeChange')->name('salat.performe.change');
    Route::get('salat/count', 'User\SalatController@salatCount');
    Route::get('overall-salat-count', 'User\SalatController@overallSalatCount');
});

//Dhikr Routes
Route::get('/dhikr', 'User\DhikrController@dhikrIndex');

Route::middleware(['onlyAjaxRequest'])->group(function () {
    Route::prefix('dhikr')->group(function () {
        Route::get('save', 'User\DhikrController@saveOrUpdateDhikr');
        Route::get('user-dhikr', 'User\DhikrController@userDhikr');

    });
});

//Hadith Routes
Route::get('/hadith', 'User\HadithController@hadithIndex');
Route::middleware(['onlyAjaxRequest'])->group(function () {
    Route::prefix('hadith')->group(function () {
        Route::post('/post', 'User\HadithController@hadithPost')->name('hadith.post');

    });
});
//Question Answer Routes
Route::get('/question-answer', 'User\QuestionAnswerController@QAIndex');
Route::middleware(['onlyAjaxRequest'])->group(function () {
    Route::prefix('question-answer')->group(function () {
        Route::post('/ask', 'User\QuestionAnswerController@QuestionAsk')->name('qa.ask');

    });
});


//admin routes

//admin Login, logout, forget password routes
Route::prefix('admin')->group(function () {
    Route::get('login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\Admin\LoginController@login');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

    Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');
    Route::get('password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::get('index', 'Admin\AdminController@index')->name('admin.index');
});

//admin controller routes
Route::middleware(['onlyAjaxRequest'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('regular-admin', 'Admin\AdminController@regularAdmin')->name('admin.regular-admin');
        Route::get('delete', 'Admin\AdminController@deleteAdmin')->name('admin.delete');
        Route::get('getadmin', 'Admin\AdminController@getAdmin')->name('admin.getadmin');

        Route::post('add', 'Admin\AdminController@addAdmin')->name('add.admin');
        Route::post('update', 'Admin\AdminController@updateAdmin')->name('update.admin');

        Route::get('enable', 'Admin\AdminController@enableAdmin')->name('admin.enable');
        Route::get('disable', 'Admin\AdminController@disableAdmin')->name('admin.disable');
    });
});

//moderator
Route::middleware(['onlyAjaxRequest'])->group(function () {
    Route::prefix('moderator')->group(function () {
        Route::name('moderator.')->group(function () {

            Route::get('index', 'Admin\ModeratorController@index')->name('index');
            Route::post('add', 'Admin\ModeratorController@add')->name('add');
            Route::post('update', 'Admin\ModeratorController@update')->name('update');
            Route::get('delete', 'Admin\ModeratorController@delete')->name('delete');
            Route::get('get', 'Admin\ModeratorController@get')->name('get');

            Route::get('enable', 'Admin\ModeratorController@enable')->name('enable');
            Route::get('disable', 'Admin\ModeratorController@disable')->name('disable');
        });

    });
});
//user
Route::middleware(['onlyAjaxRequest'])->group(function () {
    Route::prefix('manage-user')->group(function () {
        Route::name('manage.user.')->group(function () {

            Route::get('index', 'Admin\ManageUserController@index')->name('index');
            Route::get('delete', 'Admin\ManageUserController@delete')->name('delete');
            Route::get('enable', 'Admin\ManageUserController@enable')->name('enable');
            Route::get('disable', 'Admin\ManageUserController@disable')->name('disable');
        });

    });
});

//change password
Route::middleware(['onlyAjaxRequest'])->group(function () {

    Route::get('admin/password', 'Admin\ChangePasswordController@index')->name('change.password');
    Route::post('admin/password/change', 'Admin\ChangePasswordController@changePassword')->name('admin.password.change');

});
//admin hadith controller routes
Route::middleware('onlyAjaxRequest')->group(function (){
   Route::prefix('moderator/hadith')->group(function(){
      Route::name('moderator.hadith.')->group(function (){
          Route::get('index','Admin\HadithManageController@index')->name('index');
      }) ;
   }) ;
});