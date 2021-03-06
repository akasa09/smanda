<?php



Route::get('/', function () {
    return view('welcome');
});

Route::get('/koding', function () {
    return 'halokoding';
});

// Route::get('/admin', function () {
//     return view('admin.layout');
// });
//login admin
Route::get('/login', 'LoginController@index')->middleware('guest');
Route::post('/login', 'LoginController@post');
Route::post('/logout-admin', 'LoginController@logout');

//login voter
Route::get('/loginvoter', 'LoginVoterController@index')->middleware('guest');
Route::post('/loginvoter', 'LoginVoterController@post');
Route::post('/logout', 'LoginVoterController@logout');

Route::get('/suara/aftervote', 'AfterVoteController@index');
Route::group(['middleware' => 'voter'], function(){
    Route::get('/suara/home', 'SuaraController@index');
    Route::get('/berhasil-submit', 'SubmitHasilVoteController@index');
    Route::post('/submit-hasil', 'SubmitHasilVoteController@vote');
});



Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin/voters', 'AdminVoterController@index');
    Route::get('/admin/paslons', 'AdminPaslonController@index');
    Route::get('/admin/visimisis', 'AdminVisimisiController@index');
    Route::get('/admin/results', 'AdminResultController@index');
    
    //menambah pemilih
    Route::get('/admin/voters/tambah', 'AdminVoterController@create');
    Route::post('/admin/voters', 'AdminVoterController@store');
    
    //menambah paslon
    Route::get('/admin/paslons/tambah', 'AdminPaslonController@create');
    Route::post('/admin/paslons', 'AdminPaslonController@store');
    
    //menambah visimisi
    Route::get('/admin/visimisis/create', 'AdminVisimisiController@create');
    Route::post('/admin/visimisis', 'AdminVisimisiController@store');
    
    //edit pemilih
    Route::get('/admin/voters/{id}/edit', 'AdminVoterController@edit');
    Route::put('/admin/voters/{id}', 'AdminVoterController@update');
    
    //edit paslon
    Route::get('/admin/paslons/{id}/edit', 'AdminPaslonController@edit');
    Route::put('/admin/paslons/{id}', 'AdminPaslonController@update');
    
    //edit visimisi
    Route::get('/admin/visimisis/{id}/edit', 'AdminVisimisiController@edit');
    Route::put('/admin/visimisis/{id}', 'AdminVisimisiController@update');
    
    //hapus data pemilih
    Route::delete('/admin/voters/{id}', 'AdminVoterController@destroy');
    //hapus data paslon
    Route::delete('/admin/paslons/{id}', 'AdminPaslonController@destroy');
    //hapus data visimisi
    Route::delete('/admin/visimisis/{id}', 'AdminVisimisiController@destroy');    
});