<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect(RouteServiceProvider::HOME);
});
Route::get('/jiwuvya7gtrv682b7iwnorai', function() {
    Artisan::call('migrate --force');
});

Auth::routes();

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->namespace('Dashboard')
    ->group(function() {
        Route::get('',  'IndexController@get')->name('index');
        Route::get('profile',  'ProfileController@edit')->name('profile.edit');
        Route::put('profile',  'ProfileController@update')->name('profile.update');
        Route::prefix('admin')
            ->name('admin.')
            ->middleware(['user_type:admin'])
            ->namespace('Admin')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');

                Route::resource('score', 'ScoreController');

                //Project PAGE
                Route::get('project/index/{id}', 'ProjectController@GetProject')->name('project.index');
                Route::post('project/create', ['uses' => 'ProjectController@CreatePost','as' => 'project.create']);
                Route::get('project/create', ['uses' => 'ProjectController@GetCreatePost','as' => 'project.create']);
                Route::get('project/manage', 'ProjectController@GetManagePost')->name('project.manage');
                Route::get('project/{id}/status/{status}','ProjectController@UpdateStatus')->name('project.updatestatus');
                Route::get('deletepost/{id}','ProjectController@DeletePost')->name('project.deletepost');
                Route::get('updatepost/{id}','ProjectController@GetEditPost')->name('project.updatepost');
                Route::post('updatepost/{id}','ProjectController@UpdatePost')->name('project.updatepost');

               //PHASE PAGE
                Route::post('phase/create/{id}', ['uses' => 'PhaseController@CreatePost','as' => 'phase.create']);
                Route::get('deletephase/{id}/{project_id}','PhaseController@DeletePost')->name('phase.deletephase');
                Route::post('updatephase/{id}','PhaseController@UpdatePost')->name('phase.updatephase');
                Route::get('phase/tasks/{id}', 'PhaseController@GetManageTask')->name('phase.tasks');

                //SALARY PAGE
                Route::get('salary', ['uses' => 'SalaryController@GetIndex','as' => 'salary.index']);
                Route::post('salary/create', ['uses' => 'SalaryController@CreatePost','as' => 'salary.create']);
                Route::get('salary/create', ['uses' => 'SalaryController@GetCreatePost','as' => 'salary.create']);
                Route::get('salary/{salary}/delete','SalaryController@DeletePost')->name('salary.delete');
                Route::get('salary/{salary}','SalaryController@GetEditPost')->name('salary.edit');
                Route::post('salary/{salary}','SalaryController@UpdatePost')->name('salary.update');

               //EMPLOYEE PAGE
               Route::post('employee/create/{id}', ['uses' => 'EmployeeController@CreatePost','as' => 'employee.create']);
               Route::get('deleteemployee/{id}/{project_id}','EmployeeController@DeletePost')->name('employee.deleteemployee');
               Route::post('updateemployee/{id}','EmployeeController@UpdatePost')->name('employee.updateemployee');

               //TASK PAGE
               Route::post('task/create/{id}', ['uses' => 'TaskController@CreatePost','as' => 'task.create']);
               Route::get('deletetask/{id}','TaskController@DeletePost')->name('task.deletetask');
               Route::post('updatetask/{id}','TaskController@UpdatePost')->name('task.updatetask');

               //Users PAGE
               Route::get('users/employee', 'UserController@GetUsers')->name('users.employee');
               Route::get('users/profile/{id}', 'UserController@GetProfile')->name('users.profile');
               Route::get('users/restore/{id}','UserController@restore')->name('users.restore');
               Route::get('deleteuser/{id}','UserController@DeletePost')->name('users.deleteuser');
               Route::get('updateuser/{id}','UserController@GetEditPost')->name('users.updateuser');
               Route::post('updateuser/{id}','UserController@UpdatePost')->name('users.updateuser');

               //ACCOUNTING PAGE
               Route::get('money/employee', 'AccountingController@GetEmployee')->name('money.employee');

               //ABSENCE PAGE
               Route::get('absence/manage', 'AbsenceController@GetAbsence')->name('absence.manage');

               //MESSAGE PAGE
               Route::post('message/create', ['uses' => 'MessageController@CreatePost','as' => 'message.create']);
               Route::get('message/create', ['uses' => 'MessageController@GetCreatePost','as' => 'message.create']);
               Route::get('message/manage', 'MessageController@GetMessage')->name('message.manage');
               Route::get('deletemessage/{id}','MessageController@DeletePost')->name('message.deletemessage');
               Route::get('updatemessage/{id}','MessageController@GetEditPost')->name('message.updatemessage');
               Route::post('updatemessage/{id}','MessageController@UpdatePost')->name('message.updatemessage');
               Route::get('message/show/{id}', 'MessageController@ShowMessage')->name('message.show');
               Route::get('message/{message}/answer', 'MessageController@GetAnswerMessage')->name('message.answer');
               Route::post('message/{message}/answer', 'MessageController@AnswerMessage')->name('message.answer');

               //DAILY MANAGMENT
                Route::post('daily/create', ['uses' => 'DailyController@CreatePost','as' => 'daily.create']);
                Route::get('daily/create', ['uses' => 'DailyController@GetCreatePost','as' => 'daily.create']);
                Route::get('daily/manage', 'DailyController@GetManagePost')->name('daily.manage');
                Route::get('updatedaily/{id}','DailyController@GetEditPost')->name('daily.updatedaily');
                Route::get('show/{id}','DailyController@GetTask')->name('daily.show');
                Route::get('updatedaily/{id}','DailyController@GetEditPost')->name('daily.updatedaily');
                Route::post('updatedaily/{id}','DailyController@UpdatePost')->name('daily.updatedaily');
            });

        Route::prefix('customer')
            ->name('customer.')
            ->middleware(['user_type:customer'])
            ->namespace('Customer')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');

            });

        Route::prefix('employee')
            ->name('employee.')
            ->middleware(['user_type:employee'])
            ->namespace('Employee')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');
                Route::get('profile',  'IndexController@profile')->name('profile');

                //TASK MANAGMENT
                Route::post('task/create', ['uses' => 'TaskController@CreatePost','as' => 'task.create']);
                Route::get('task/create', ['uses' => 'TaskController@GetCreatePost','as' => 'task.create']);
                Route::get('task/manage', 'TaskController@GetManagePost')->name('task.manage');
                Route::get('updatetask/{id}','TaskController@GetEditPost')->name('task.updatetask');
                Route::get('show/{id}','TaskController@GetTask')->name('task.show');
                Route::get('updatetask/{id}','TaskController@GetEditPost')->name('task.updatetask');
                Route::post('updatetask/{id}','TaskController@UpdatePost')->name('task.updatetask');
                Route::post('edittask/{id}','TaskController@EditPost')->name('task.edittask');

                //ABSENCE
                Route::post('absence/create', ['uses' => 'TaskController@Absence','as' => 'absence.create']);
                Route::post('absence/end/{id}','TaskController@AbsenceEnd')->name('absence.end');

                //MESSAGE PAGE
                Route::get('message/manage', 'MessageController@GetMessage')->name('message.manage');
                Route::get('message/show/{id}', 'MessageController@ShowMessage')->name('message.show');
                Route::get('message/{message}/answer', 'MessageController@GetAnswerMessage')->name('message.answer');
                Route::post('message/{message}/answer', 'MessageController@AnswerMessage')->name('message.answer');

                //ACCOUNTING PAGE
                Route::get('money', 'AccountingController@GetMoney')->name('money.index');

     });
    });
