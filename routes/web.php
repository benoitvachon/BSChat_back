<?php
/*


Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');

Route::get('/profil', 'UserController@index');

Route::get('/user/auth', 'UserController@auth');

Route::post('/topic/create', 'TopicController@create');

Route::get('/topic/{idTopic}', 'TopicController@index')->where('idTopic', '[0-9]+');

Route::get('topic/{idTopic}/get', 'TopicController@getTopic')->where('idTopic', '[0-9]+');

Route::get('/topic/show', 'TopicController@show');

Route::get('/topic/{idTopic}/leave', 'TopicController@leaveTopic')->where('idTopic', '[0-9]+');

//Route::get('/contact/{idContact}/delete', 'ContactController@deleteContact')->where('idContact', '[0-9]+');

Route::get('/topic/{idTopic}/rename', 'TopicController@renameTopic')->where('idTopic', '[0-9]+');

Route::get('/contacts/show', 'ContactController@show');

Route::get('/contact/{idContact}', 'ContactController@index')->where('idContact', '[0-9]+');

Route::get('contact/{idContact}/get', 'ContactController@getContact')->where('idContact', '[0-9]+');

Route::get('/contact/topic/{idContact}/get', 'ContactController@getTopic')->where('idContact', '[0-9]+');

Route::get('/topic/{idTopic}/user/{idUser}/delete', 'TopicController@deleteUser')->where(['idTopic' => '[0-9]+', 'idUser' => '[0-9]+']);

Route::post('/contact/add', 'ContactController@addContact');

Route::get('/topic/{idTopic}/posts', 'TopicController@topicMessages')->where('idTopic', '[0-9]+');

Route::post('topic/sendMessage', 'MessageController@store');

Route::get('/contacts', function () {
    return view('contacts');
});

Auth::routes();
*/