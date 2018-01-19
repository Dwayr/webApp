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

Route::get('/', 'Dwayr@index');
Route::get('/sign-up', 'Users@sign_up');
Route::get('/sign-in', 'Users@sign_in');
Route::get('/signin', 'Users@komicho_login');
Route::get('/signout', 'Users@sign_out');
// settings
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'Settings@info');
    Route::get('/info', 'Settings@info');
    Route::get('/job', 'Settings@job');
    Route::get('/communication', 'Settings@communication');
    Route::get('/password', 'Settings@password');
    Route::group(['prefix' => 'companies/dashboard/{name}'], function () {
        Route::get('/info', 'Settings@companie_info');
        Route::get('/projects', 'Settings@companie_projects');
        Route::get('/team', 'Settings@companie_team');
        Route::get('/jobs', 'Settings@companie_jobs');
    });
});
// companie
Route::group(['prefix' => 'companie'], function () {
    Route::get('/add', 'Companies@add');
    Route::get('/logo/{url}', 'Companies@logo');
});
// job
Route::group(['prefix' => 'job'], function () {
    Route::get('/', 'Jobs@all');
    Route::get('/add', 'Jobs@add');
    Route::get('/show/{id}', 'Jobs@show');
});
// project
Route::group(['prefix' => 'project'], function () {
    Route::get('/add', 'Projects@add');
    Route::get('/edit/{id}', 'Projects@edit');
    Route::get('/show/{id}', 'Projects@show');
    Route::get('/tag/team/{username}', 'Projects@tag_team');
    Route::get('/logo/{id}', 'Projects@logo');
});
// ajax
Route::group(['prefix' => 'ajax'], function () {
    Route::group(['prefix' => 'companie'], function () {
        Route::post('/add', 'Companies@ajax_add');
        Route::group(['prefix' => 'settings'], function () {
            Route::post('/edit', 'Companies@ajax_edit');
            Route::post('/team/add', 'Companies@ajax_team_add');
            // jobs
            Route::group(['prefix' => 'jobs'], function () {
                Route::post('/apply', 'Jobs@ajax_apply_done');
                Route::post('/cancel', 'Jobs@ajax_cancel');
            });
        });
    });
    
    Route::group(['prefix' => 'job'], function () {
        Route::get('/list', 'Jobs@ajax_list');
        Route::post('/add', 'Jobs@ajax_add');
        Route::post('/apply', 'Jobs@ajax_apply');
    });
    
    Route::group(['prefix' => 'user'], function () {
        Route::post('/edit_info', 'Users@ajax_edit_info');
        Route::post('/edit_password', 'Users@ajax_edit_password');
        Route::post('/setting_job', 'Users@ajax_setting_job');
        Route::post('/setting_communication', 'Users@ajax_setting_communication');
        Route::post('/sign_up', 'Users@ajax_sign_up');
        Route::post('/sign_in', 'Users@ajax_sign_in');
    });
    
    Route::group(['prefix' => 'project'], function () {
        Route::post('/add', 'Projects@ajax_add');
        Route::post('/edit', 'Projects@ajax_edit');
        Route::post('/edit/data', 'Projects@ajax_edit_get_data');
    });
    
    Route::group(['prefix' => 'notification'], function () {
        Route::post('/is_read', 'notifications@is_read');
    });
});
// upload
Route::group(['prefix' => 'upload'], function () {
    Route::post('/', 'Uploads@companie_logo');
    Route::post('/project', 'Uploads@companie_logo_project');
});
// upload
Route::group(['prefix' => 'mailer'], function () {
    Route::get('/test', 'Mailers@test');
});
// feed
Route::group(['prefix' => 'feed'], function () {
    Route::get('/job', 'Jobs@rssFeed');
});
// admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin@login');
});
// show por
Route::get('/notifications', 'Users@notifications');
Route::get('/notification/{id}', 'Notifications@show');
Route::get('/notification/toteamdone/{id}', 'Notifications@ADDTOTEAM_done');
Route::get('/notification/toteamclose/{id}', 'Notifications@ADDTOTEAM_close');
Route::get('/faq', 'Dwayr@faq');
Route::get('/sendTo', 'Jobs@sendTo'); // del
Route::get('/cv', 'Users@generate_cv'); // del
Route::post('/cv_post', 'Users@generate_cv_post'); // del
Route::get('/{name}', 'Dwayr@profile');