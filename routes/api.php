<?php

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Middleware\CheckAuthApi;

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

Route::middleware('auth.api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['auth.api' => ['api']], function() {

    //USERS REQUESTS

    Route::get('/user/{idUser}', 'UserController@user')->where('idUser', '[0-9]+');

    Route::post('/user/update', 'UserController@updateUser');

    Route::get('/user/{idUser}/topic', 'TopicController@topicsUser')->where('idUser', '[0-9]+');

    Route::get('/user/{idUser}/contacts/get', 'ContactController@contactsUser')->where('idUser', '[0-9]+');

    Route::get('/user/{idAuthor}/number/contacts', 'UserController@getNumberOfContacts')->where('idAuthor', '[0-9]+');

    Route::get('/user/{idUser}/user2/{idAuthor}/mutual/contacts', 'UserController@getMutualContacts')->where(['idUser' => '[0-9]+', 'idAuthor' => '[0-9]+']);

    Route::get('/user/{idUser}/user2/{idAuthor}/mutual/topics', 'UserController@getMutualTopics')->where(['idUser' => '[0-9]+', 'idAuthor' => '[0-9]+']);

    Route::get('/user/{idUser}/topic/{idTopic}/leave', 'TopicController@leaveFrontTopic')->where(['idUser' => '[0-9]+', 'idTopic' => '[0-9]+']);

    //TOPIC REQUESTS

    Route::post('topic/sendMessage', 'MessageController@store');

    Route::get('/user/{idUser}/topic/{idTopic}/delete', 'TopicController@deleteTopic')->where('idTopic', '[0-9]+');

    Route::get('/user/{idUser}/contact/{idContact}/delete', 'ContactController@deleteContact')->where('idContact', '[0-9]+');

    Route::get('/topic/{idTopic}/member/{idUser}/delete', 'TopicController@deleteMember')->where(['idTopic' => '[0-9]+', 'idUser' => '[0-9]+']);

    Route::post('/topic/userMember', 'TopicController@isUserTopicMember');

    Route::get('/topic/{idTopic}/get', 'TopicController@getTopic')->where('idTopic', '[0-9]+');

    Route::get('/topic/{idTopic}/posts', 'TopicController@topicMessages')->where('idTopic', '[0-9]+');

    Route::get('/topic/{idTopic}/users', 'TopicController@usersTopic')->where('idTopic', '[0-9]+');

    Route::post('/user/{idUser}/topic', 'TopicController@createTopic')->where('idUser', '[0-9]+');

    Route::post('/topic/delete', 'TopicController@removeTopic');

    Route::post('/topic/modify', 'TopicController@renameTopic');

    Route::post('/topic/addContact', 'TopicController@addContacts')->where('idTopic', '[0-9]+');

    Route::post('/topic/user/delete', 'TopicController@deleteUserFromTopic');

    //CONTACTS REQUESTS

    Route::get('/contact/{idContact}', 'ContactController@index')->where('idContact', '[0-9]+');

    Route::get('/contact/{idContact}/get', 'ContactController@getContact')->where('idContact', '[0-9]+');

    Route::get('/user/{idUser}/contact/topic/{idContact}/get', 'ContactController@getFrontTopic')->where(['idUser' => '[0-9]+', 'idContact' => '[0-9]+']);

    Route::get('/user/{idUser}/contact/{idContact}/delete', 'ContactController@deleteContact')->where(['idUser' => '[0-9]+', 'idContact' => '[0-9]+']);

    Route::post('/user/{idUser}/contact/request', 'ContactController@sendContactRequest')->where('idUser', '[0-9]+');

    Route::get('/user/{idUser}/requests', 'ContactController@getFriendRequests')->where('idUser', '[0-9]+');

    Route::get('/user/{idUser}/request/{idRequest}/accept', 'ContactController@acceptRequest')->where(['idUser' => '[0-9]+', 'idRequest' => '[0-9]+']);

    Route::get('/user/{idUser}/request/{idRequest}/refuse', 'ContactController@refuseRequest')->where(['idUser' => '[0-9]+', 'idRequest' => '[0-9]+']);

    Route::get('/author/{idAuthor}/get', 'UserController@getAuthor')->where('idAuthor', '[0-9]+');

    //AUTHENTICATION REQUESTS

    Route::post('/logout', 'UserController@logout');
});

Route::post('/signin', 'UserController@connectUser');

Route::post('/signup', 'UserController@createUser');