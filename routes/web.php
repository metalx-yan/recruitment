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


Route::get('applicant/download/{id}', 'ApplicantController@download')->name('applicant.download');

Route::post('/applicant/user', 'ApplicantController@storeUser')->name('store.user');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:administrator']], function() {

    Route::resource('criteria', 'CriteriaController');

    Route::resource('applicant', 'ApplicantController');

    Route::get('/', function () {
        return view('dashboard');
    })->name('home.admin');

    Route::get('/user/viewprofile/{id}', 'UserController@viewData')->name('viewdata.admin');

    Route::put('/user/updatedata/{id}', 'UserController@updatePassword')->name('updatedata.admin');

    Route::put('/user/resetdata/{id}', 'UserController@resetPassword')->name('resetdata.admin');

    Route::resource('user', 'UserController');
    
    Route::put('schedule/{id}', 'JobVacancyController@scheduleStore')->name('schedule.store.job');

    Route::put('schedule/{id}/scheduleedit', 'JobVacancyController@scheduleEdit')->name('schedule.edit.job');
    
    Route::resource('jobvacancy', 'JobVacancyController');

    Route::put('jobvacancy/{id}/update', 'JobVacancyController@jobvacancyupdate')->name('jobvacancyupdate');

    Route::get('jobvacancy/{id}/update', 'JobVacancyController@jobUpdate')->name('jobUpdate');

    Route::get('schedule', 'JobVacancyController@schedule')->name('schedule.job');
    
    Route::resource('requirement', 'RequirementController');
    
});

Route::get('lowongan/{slug}', 'JobVacancyController@vacancy')->name('vacancy');

Route::group(['prefix' => 'hrd', 'middleware' => ['auth', 'role:hrd']], function() {

    Route::post('/send-email', 'ApplicantController@sendEmail')->name('send.email');

    Route::resource('assessment', 'AssessmentController');

    Route::post('/send-email', 'ApplicantController@sendEmail')->name('send.email');

    Route::get('/', function () {
        return view('dashboard');
    })->name('home.hrd');
    
    Route::get('/user/viewprofile/{id}', 'UserController@viewData')->name('viewdata.hrd');
    
    Route::get('list/applicants', 'ApplicantController@list')->name('list');

    Route::get('list/applicants/pass', 'ApplicantController@pass')->name('pass');

    Route::get('list/applicant/{id}', 'ApplicantController@listApp')->name('list.app');

    Route::put('/user/updatedata/{id}', 'UserController@updatePassword')->name('updatedata.hrd');
});


Route::get('/', function () {

    // $schema = Schema::getColumnListing('criterias');

    // $records = DB::table('criterias')->get();

    return view('welcome', compact('schema', 'records'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
