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

Route::get('/', ['uses' => 'IndexController@Index', 'as' => 'start']);
Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('public/login', ['uses' => 'IndexController@login', 'as' => 'login']);

Route::get('google', ['uses' => 'GoogleController@redirectToProvider', 'as' => 'google']);
Route::get('google/callback', 'GoogleController@handleProviderCallback');

Route::get('/redirect', ['uses' => 'SocialAuthFacebookController@redirect', 'as' => 'facebook']);
Route::get('/callback', 'SocialAuthFacebookController@callback');

Auth::routes();

//Страницы без авторизации


Route::group(['prefix' => 'users', 'middleware' => ['web']], function () {
    //страничка с квестами (надо сделать только с доступными квестами)
    Route::get('/view', ['uses' => 'Users\UsersQuestController@view', 'as' => 'user_view_quest']);
    //Подробная информация о квесте (после нажатия на кнопку more)
    Route::get('/more/quest/{id?}', ['uses' => 'Users\UsersQuestController@more', 'as' => 'more'])->where('id', '[0-9]+');
});


//Админка

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'admin']], function () {
    //КВЕСТЫ
    //просмотр существующего списка квестов:
    Route::get('show/quest/', ['uses' => 'Admin\AdminQuestController@show', 'as' => 'showQuests']);
    //переадресация к форме добавления нового квеста:
    Route::get('/add/quest', ['uses' => 'Admin\AdminQuestController@add', 'as' => 'admin_add_quest']);
    //после нажатия кнопки - добавление нового квеста в БД и переадресация на страницу адзаний квеста:
    Route::post('/create/quest', ['uses' => 'Admin\AdminQuestController@create', 'as' => 'post']);
    //редактирование квеста:
    Route::get('edit/quest/{id?}', ['uses' => 'Admin\AdminQuestController@edit', 'as' => 'editQuest'])->where('id', '[0-9]+');
    //обновление квеста:
    Route::post('/update/Quest/{id?}', ['uses' => 'Admin\AdminQuestController@update', 'as' => 'edit']);
    //удаление квеста:
    Route::get('delete/quest/{id?}', ['uses' => 'Admin\AdminQuestController@delete', 'as' => 'deleteQuest'])->where('id', '[0-9]+');

    //ЗАДАНИЯ
    //*просмотр заданий для определённого квеста:
    Route::get('show/tasks/{idQuest?}', ['uses' => 'Admin\AdminTaskController@showByOne', 'as' => 'showTasksByQuest'])->where('id', '[0-9]+');
    //*роут на форму создания нового задания для квеста:
    Route::get('createTask/{id}', ['uses' => 'Admin\AdminTaskController@add', 'as' => 'createTask'])->where('id', '[0-9]+');
    //после нажатия добавить на странице добавления задания
    Route::post('/create/task/{idQuest}', ['uses' => 'Admin\AdminTaskController@create', 'as' => 'postTask'])->where('id', '[0-9]+');
    //редактирование задания
    Route::get('edit/tasks/{id?}', ['uses' => 'Admin\AdminTaskController@edit', 'as' => 'editTask'])->where('id', '[0-9]+');
    //обновление задания в таблице после редактирования
    Route::post('/update/tasks/{id}', ['uses' => 'Admin\AdminTaskController@update', 'as' => 'updateTask']);
    //удаление задания:
    Route::get('delete/tasks/{id?}', ['uses' => 'Admin\AdminTaskController@delete', 'as' => 'deleteTask'])->where('id', '[0-9]+');

    //*просмотр всех существующих заданий:
    Route::get('show/all/tasks/', ['uses' => 'Admin\AdminTaskController@show', 'as' => 'showTasks']);
    //удаление любого задания:
    Route::get('delete/task/{id?}', ['uses' => 'Admin\AdminTaskController@deleteTask', 'as' => 'deleteOneTask'])->where('id', '[0-9]+');
    //редактирование любого задания:
    Route::get('edit/task/{id?}', ['uses' => 'Admin\AdminTaskController@editTask', 'as' => 'editOneTask'])->where('id', '[0-9]+');
    //обновление задания в таблице после редактирования
    Route::post('/update/task/{id}', ['uses' => 'Admin\AdminTaskController@updateTask', 'as' => 'updateOneTask']);

    //ПОЛЬЗОВАТЕЛИ
    //просмотр существующего списка пользователей:
    // Route::get('show/users/', ['uses' => 'Admin\AdminUsersController@show', 'as' => 'showUsers']);
    //просмотр существующего списка пользователей:
    //  Route::get('edit/users/{id?}', ['uses' => 'Admin\AdminUsersController@edit', 'as' => 'editUsers'])->where('id','[0-9]+');
    //просмотр существующего списка пользователей:
    // Route::get('delete/users/{id?}', ['uses' => 'Admin\AdminUsersController@delete', 'as' => 'deleteUsers'])->where('id','[0-9]+');

    //КОМАНДЫ
    //просмотр существующего списка команд:
    Route::get('show/teams/', ['uses' => 'Admin\AdminTeamsController@show', 'as' => 'showTeams']);
    //редактирование команды:
    Route::get('edit/team/{id?}', ['uses' => 'Admin\AdminTeamsController@edit', 'as' => 'editTeam'])->where('id', '[0-9]+');
    //удаление команды:
    Route::get('delete/team/{id?}', ['uses' => 'Admin\AdminTeamsController@delete', 'as' => 'deleteTeam'])->where('id', '[0-9]+');
    //обновление команды в таблице после редактирования
    Route::post('/update/task/{id}', ['uses' => 'Admin\AdminTeamsController@update', 'as' => 'updateTeam']);
    //роут на форму создания новой команды:
    Route::get('addTeam/', ['uses' => 'Admin\AdminTeamsController@add', 'as' => 'createTeam'])->where('id', '[0-9]+');
    //занесение команды в таблицу
    Route::post('/create/team/{id}', ['uses' => 'Admin\AdminTeamsController@create', 'as' => 'postTeam'])->where('id', '[0-9]+');
});



//для залогиненного пользователя

Route::group(['prefix' => 'users', 'middleware' => ['web', 'auth']], function () {
    //планируемый маршрут при выборе user-ом квеста на выполнение(надо делать)
    Route::get('/do', ['uses' => 'Users\UsersQuestController@do', 'as' => 'user_do_quest']);

});

