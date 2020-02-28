<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['JwtMiddleware']], function () {
  Route::get('/organizations', 'OrganizationController@todas');
  Route::post('/organizations', 'OrganizationController@create');
  Route::post('/organizations/edit', 'OrganizationController@edit');
  Route::delete('/organizations/{id}', 'OrganizationController@remove');
  Route::post('/organizations/state', 'OrganizationController@estado');
  Route::get('/organization/projects/{id}', 'OrganizationController@projects');
  Route::get('/organization/people/{id}', 'OrganizationController@people');
  Route::post('/organizations/addPerson', 'OrganizationController@addPerson');

  Route::get('/states', 'EstadoController@tomar');
  //Route::get('/states/{type}', 'EstadoController@getByType');
  Route::post('/state', 'EstadoController@create');
  Route::delete('/state/{id}', 'EstadoController@remove');
  Route::post('/state/edit', 'EstadoController@edit');

  Route::get('/assistances/{date}', 'AssistanceController@get');
  Route::post('/assistance', 'AssistanceController@create');
  Route::post('/assistance/leave', 'AssistanceController@leave');

  Route::post('/person', 'PersonController@create');
  Route::get('/person', 'PersonController@get');
  Route::get('/people', 'PersonController@paginate');
  Route::delete('/person/{id}', 'PersonController@remove');
  Route::get('/people/organizations/{id}', 'PersonController@organizations');
  //Route::get('/person/{organization}', 'PersonController@getByOrganization');

  Route::post("/project", "ProjectsController@create");
  Route::get("/projects","ProjectsController@all");
  Route::post("/projects/state", "ProjectsController@state");
  Route::post("/project/edit", "ProjectsController@edit");
  Route::post("/project/addMember", "ProjectsController@addMember");
  Route::get("/project/members/{project}","ProjectsController@members");
  Route::delete("/projects/{id}", "ProjectsController@remove");

  Route::post("/task", "TaskController@create");
  Route::get("/tasks/{project}","TaskController@getByProject");
  Route::post("/task/edit", "TaskController@edit");
  Route::post("/task/state", "TaskController@state");
  Route::delete("/tasks/{id}", "TaskController@remove");

  Route::get('/me', 'UsersController@me');

  Route::get('/users', 'UsersController@all');
  Route::delete("/users/{id}","UsersController@remove");
  Route::post("/users/edit","UsersController@edit");
  Route::post("/register","Auth\RegisterController@create");

  Route::post('/members', 'MemberController@create');
  Route::get('/members', 'MemberController@get');
  Route::delete('/members/{id}', 'MemberController@remove');
  Route::get('/member/projects/{id}', 'MemberController@projects');
  Route::get('/member/tasks/{id}', 'MemberController@tasks');

  Route::post("/send-email", "MailController@sendToUsers");
  Route::get("/view-email/{id}", "MailController@view");
  Route::post("/email-resend/{id}", "MailController@reSend");
  Route::get("/emails", "MailController@getAllEmails");

});
Route::post('/login', 'Auth\LoginController@enter');

Route::post("/contact", "PersonController@formCreate");
