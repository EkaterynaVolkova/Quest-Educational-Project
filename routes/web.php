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

//-----------------------------

Route::get('/', ['uses' =>'IndexController@Index', 'as' => 'start']);
Route::get('/home', ['uses' =>'HomeController@index', 'as' => 'home']);
Route::get('public/login', ['uses' =>'IndexController@login', 'as' => 'login']);

Route::get('google', ['uses' => 'GoogleController@redirectToProvider', 'as' => 'google']);
Route::get('google/callback', 'GoogleController@handleProviderCallback');

Route::get('/redirect', ['uses'=>'SocialAuthFacebookController@redirect', 'as' => 'facebook']);
Route::get('/callback', 'SocialAuthFacebookController@callback');

Auth::routes();

                                       //Страницы без авторизации


Route::group(['prefix' => 'users', 'middleware' => ['web']], function () {
    //страничка с квестами (надо сделать только с доступными квестами)
    Route::get('/view', ['uses' => 'Users\UsersQuestController@view', 'as' => 'user_view_quest']);
    //Подробная информация о квесте (после нажатия на кнопку more)
    Route::get('/more/quest', ['uses' => 'User\UsersQuestController@more', 'as' => 'more']);
});



                                          //Админка

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'admin']], function () {
    //просмотр существующего списка квестов:
    Route::get('show/quest/', ['uses' => 'Admin\AdminQuestController@show', 'as' => 'showQuests']);
    //редактирование квеста:
    Route::get('edit/quest/{id?}', ['uses' => 'Admin\AdminQuestController@edit', 'as' => 'editQuest'])->where('id','[0-9]+');
    //после нажатия кнопки - обновление квеста:
    Route::post('/update/Quest/{id?}', ['uses' => 'Admin\AdminQuestController@update', 'as' => 'edit']);
    //переадресация к форме добавления нового квеста:
    Route::get('/add/quest', ['uses' => 'Admin\AdminQuestController@add', 'as' => 'admin_add_quest']);
    //после нажатия кнопки - добавление нового квеста в БД и переадресация на страницу заданий квеста:
    Route::post('/create/quest', ['uses' => 'Admin\AdminQuestController@create', 'as' => 'post']);
    //просмотр заданий для созданного квеста + кнопка добавления нового задания:
    Route::get('viewTask/{idQuest}', ['uses' => 'Admin\AdminTaskController@viewTasks', 'as' => 'viewTask'])->where('idQuest','[0-9]+');
    //роут на форму создания нового задания для квеста:
    Route::post('createTask/{id}', ['uses' => 'Admin\AdminTaskController@add', 'as' => 'createTask'])->where('id','[0-9]+');
    //??????
    Route::post('/create/task/{id}', ['uses' => 'Admin\AdminTaskController@create', 'as' => 'postTask'])->where('id','[0-9]+');
});

                                           //для залогиненного пользователя

Route::group(['prefix' => 'users', 'middleware' => ['web', 'auth']], function () {
    //планируемый маршрут при выборе user-ом квеста на выполнение(надо делать)
    Route::get('/do', ['uses' => 'Users\UsersQuestController@do', 'as' => 'user_do_quest']);

});

