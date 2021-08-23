<?php

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
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->namespace('Dashboard')
    ->group(function() {
        Route::get('',  'IndexController@get')->name('index');
        Route::prefix('admin')
            ->name('admin.')
            ->middleware(['user_type:admin'])
            ->namespace('Admin')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');

                //Project PAGE 
                Route::get('project/index/{id}', 'ProjectController@GetProject')->name('project.index');
                Route::post('project/create', ['uses' => 'ProjectController@CreatePost','as' => 'project.create']);
                Route::get('project/create', ['uses' => 'ProjectController@GetCreatePost','as' => 'project.create']);  
                Route::get('project/manage', 'ProjectController@GetManagePost')->name('project.manage');
                Route::get('deletepost/{id}','ProjectController@DeletePost')->name('project.deletepost');  
                Route::get('updatepost/{id}','ProjectController@GetEditPost')->name('project.updatepost');
                Route::post('updatepost/{id}','ProjectController@UpdatePost')->name('project.updatepost');               
 
               //PHASE PAGE 
                Route::post('phase/create/{id}', ['uses' => 'PhaseController@CreatePost','as' => 'phase.create']);
                Route::get('phase/create/{id}', ['uses' => 'PhaseController@GetCreatePost','as' => 'phase.create']);  
                Route::get('phase/manage/{id}', 'PhaseController@GetManagePost')->name('phase.manage');
                Route::get('deletephase/{id}/{project_id}','PhaseController@DeletePost')->name('phase.deletephase');  
                Route::get('updatephase/{id}','PhaseController@GetEditPost')->name('phase.updatephase');
                Route::post('updatephase/{id}','PhaseController@UpdatePost')->name('phase.updatephase');   
                
               //EMPLOYEE PAGE 
               Route::post('employee/create/{id}', ['uses' => 'EmployeeController@CreatePost','as' => 'employee.create']);
               Route::get('employee/create/{id}', ['uses' => 'EmployeeController@GetCreatePost','as' => 'employee.create']);  
               Route::get('employee/manage/{id}', 'EmployeeController@GetManagePost')->name('employee.manage');
               Route::get('deleteemployee/{id}/{project_id}','EmployeeController@DeletePost')->name('employee.deleteemployee');  
               Route::get('updateemployee/{id}','EmployeeController@GetEditPost')->name('employee.updateemployee');
               Route::post('updateemployee/{id}','EmployeeController@UpdatePost')->name('employee.updateemployee');
               
               //TASK PAGE 
               Route::post('task/create/{id}', ['uses' => 'TaskController@CreatePost','as' => 'task.create']);
               Route::get('task/create/{id}', ['uses' => 'TaskController@GetCreatePost','as' => 'task.create']);  
               Route::get('task/manage/{id}', 'TaskController@GetManagePost')->name('task.manage');
               Route::get('deletetask/{id}/{project_id}','TaskController@DeletePost')->name('task.deletetask');  
               Route::get('updatetask/{id}','TaskController@GetEditPost')->name('task.updatetask');
               Route::post('updatetask/{id}','TaskController@UpdatePost')->name('task.updatetask'); 

               //Users PAGE 
               Route::get('users/employee', 'UserController@GetUsers')->name('users.employee');
               Route::get('users/profile/{id}', 'UserController@GetProfile')->name('users.profile');
               Route::get('deleteuser/{id}','UserController@DeletePost')->name('users.deleteuser');

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
 
                //ACCOUNTING PAGE
                Route::get('money', 'AccountingController@GetMoney')->name('money.index');               
                
     });
    });