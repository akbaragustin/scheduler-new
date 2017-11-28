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

Route::get('/', function () {
    return view('welcome');
});
	Route::get('/logout', ['uses' =>'loginController@logout','as'=>'logout']);
	Route::get('/', ['uses' =>'frontendController@index','as'=>'frontend']);
	Route::get('/ruangan', ['uses' =>'frontendController@indexRuangan','as'=>'ruanganFe']);
	Route::get('/eselon-kapus', ['uses' =>'frontendController@indexEselonKapus','as'=>'eselon_kapus']);
	Route::get('/eselon-kapus-Ajax', ['uses' =>'frontendController@searchAjax','as'=>'eselonFe.searchAjax']);
	Route::get('/kapusShow', ['uses' =>'frontendController@indexKapus','as'=>'kapusShow']);
	Route::get('/frontend-ajax-ruangan', ['uses' =>'frontendController@indexAjaxRuangan','as'=>'frontend.indexAjaxRuangan']);
	Route::get('/frontend-ajax-eselon', ['uses' =>'frontendController@indexAjaxEselon','as'=>'frontend.indexAjaxEselon']);
	Route::get('/frontend-ajax-kapus', ['uses' =>'frontendController@indexAjaxKapus','as'=>'frontend.indexAjaxKapus']);
	Route::get('/frontend-ajax', ['uses' =>'frontendController@indexAjax','as'=>'frontend.indexAjax']);
    Route::get('/frontend-show', ['uses' =>'frontendController@showAjax','as'=>'frontend.showAjax']);
    Route::get('/frontend-show-indexTable', ['uses' =>'frontendController@indexShowFrontend','as'=>'frontend.showTable']);
    Route::get('/frontend-show-eselon', ['uses' =>'frontendController@showAjaxEselon','as'=>'frontend.showAjaxEselon']);
    Route::get('/frontend-show-Kapus', ['uses' =>'frontendController@showAjaxKapus','as'=>'frontend.showAjaxKapus']);
    Route::get('/frontend-show-indexTablekapus', ['uses' =>'frontendController@indexShowFrontendKapus','as'=>'frontend.showTableKapus']);
    Route::get('/frontend-show-indexTableRuangan', ['uses' =>'frontendController@indexShowFrontendRuangan','as'=>'frontend.showTableRuangan']);
    Route::get('/frontend-show-indexTableEselon', ['uses' =>'frontendController@indexShowFrontendEselon','as'=>'frontend.showTableEselon']);
    Route::get('/test', ['uses' =>'frontendController@test','as'=>'frontend.test']);
    // Route::post('/api/v1/get-users', ['uses' =>'frontendController@api','as'=>'api']);
    // Route::get('/api/v1/get-items', ['uses' =>'frontendController@api_items','as'=>'api.items']);
// GUEST
Route::group(['middleware' => ['seller_guest']], function() {
	Route::get('/login', ['uses' =>'loginController@login','as'=>'login.login']);
	Route::post('/login-check', ['uses' =>'loginController@loginCheck','as'=>'login.check']);

});


 Route::group(['middleware' => 'seller_auth'], function() {
	Route::group(['namespace' => 'Admin','prefix' => 'admin'], function () {
		Route::get('/', ['uses' =>'homeController@index','as'=>'home.index']);
		Route::post('/schedule-ajax', ['uses' =>'homeController@indexAjax','as'=>'home.indexAjax']);
		Route::get('/schedule-ajax-search', ['uses' =>'homeController@searchAjax','as'=>'home.searchAjax']);
		Route::post('/schedule-ajax-save', ['uses' =>'homeController@saveAjax','as'=>'home.saveAjax']);
		Route::get('/schedule-ajax-delete/{id}', ['uses' =>'homeController@deleteAjax','as'=>'home.deleteAjax']);

		//jabatan
		Route::get('/jabatan', ['uses' =>'jabatanController@index','as'=>'jabatan.index']);
		Route::post('/jabatan-save', ['uses' =>'jabatanController@save','as'=>'jabatan.save']);
		Route::post('/jabatan-update', ['uses' =>'jabatanController@update','as'=>'jabatan.update']);
		Route::get('/jabatan-ajax', ['uses' =>'jabatanController@indexAjax','as'=>'jabatan.indexAjax']);
		Route::get('/jabatan-delete/{id}', ['uses' =>'jabatanController@delete','as'=>'jabatan.delete']);
		Route::get('/jabatan-edit/{id}', ['uses' =>'jabatanController@edit','as'=>'jabatan.edit']);
//Unit Kerja
		Route::get('/unit_kerja', ['uses' =>'unitKerjaController@index','as'=>'unit_kerja.index']);
		Route::post('/unit_kerja-save', ['uses' =>'unitKerjaController@save','as'=>'unit_kerja.save']);
		Route::post('/unit_kerja-update', ['uses' =>'unitKerjaController@update','as'=>'unit_kerja.update']);
		Route::get('/unit_kerja-ajax', ['uses' =>'unitKerjaController@indexAjax','as'=>'unit_kerja.indexAjax']);
		Route::get('/unit_kerja-delete/{id}', ['uses' =>'unitKerjaController@delete','as'=>'unit_kerja.delete']);
		Route::get('/unit_kerja-edit/{id}', ['uses' =>'unitKerjaController@edit','as'=>'unit_kerja.edit']);
//Master PIC
		Route::get('/master_pic', ['uses' =>'masterPicController@index','as'=>'master_pic.index']);
		Route::post('/master_pic-save', ['uses' =>'masterPicController@save','as'=>'master_pic.save']);
		Route::post('/master_pic-update', ['uses' =>'masterPicController@update','as'=>'master_pic.update']);
		Route::get('/master_pic-ajax', ['uses' =>'masterPicController@indexAjax','as'=>'master_pic.indexAjax']);
		Route::get('/master_pic-delete/{id}', ['uses' =>'masterPicController@delete','as'=>'master_pic.delete']);
		Route::get('/master_pic-edit/{id}', ['uses' =>'masterPicController@edit','as'=>'master_pic.edit']);

		//USERS
		Route::get('/users', ['uses' =>'usersController@index','as'=>'users.index']);
		Route::post('/users-save', ['uses' =>'usersController@save','as'=>'users.save']);
		Route::get('/users-ajax', ['uses' =>'usersController@indexAjax','as'=>'users.indexAjax']);
		Route::post('/users-update', ['uses' =>'usersController@update','as'=>'users.update']);
		Route::get('/users-delete/{id}', ['uses' =>'usersController@delete','as'=>'users.delete']);
		Route::get('/users-edit/{id}', ['uses' =>'usersController@edit','as'=>'users.edit']);

		//USERS ESELON
		Route::get('/users_eselon', ['uses' =>'usersController@index_eselon','as'=>'users_eselon.index']);
		Route::post('/users_eselon-save', ['uses' =>'usersController@save_eselon','as'=>'users_eselon.save']);
		Route::get('/users_eselon-ajax', ['uses' =>'usersController@indexAjax_eselon','as'=>'users_eselon.indexAjax']);
		Route::post('/users_eselon-update', ['uses' =>'usersController@update_eselon','as'=>'users_eselon.update']);
		Route::get('/users_eselon-delete/{id}', ['uses' =>'usersController@delete_eselon','as'=>'users_eselon.delete']);
		Route::get('/users_eselon-edit/{id}', ['uses' =>'usersController@edit_eselon','as'=>'users_eselon.edit']);

		//RUANGAN
		Route::get('/ruangan', ['uses' =>'ruanganController@index','as'=>'ruangan.index']);
		Route::post('/ruangan-save', ['uses' =>'ruanganController@save','as'=>'ruangan.save']);
		Route::post('/ruangan-update', ['uses' =>'ruanganController@update','as'=>'ruangan.update']);
		Route::get('/ruangan-ajax', ['uses' =>'ruanganController@indexAjax','as'=>'ruangan.indexAjax']);
		Route::get('/ruangan-delete/{id}', ['uses' =>'ruanganController@delete','as'=>'ruangan.delete']);
		Route::get('/ruangan-edit/{id}', ['uses' =>'ruanganController@edit','as'=>'ruangan.edit']);

		//CONFIG MENU
		Route::get('/config/menu', ['uses' =>'configController@menu','as'=>'menu.index']);
		Route::post('/config/menu-save', ['uses' =>'configController@menuSave','as'=>'config.menuSave']);
		Route::post('/config/menu-update', ['uses' =>'configController@menuUpdate','as'=>'config.menuUpdate']);
		Route::get('/config/menu-view', ['uses' =>'configController@menuView','as'=>'config.menuView']);
		Route::get('/config/menu-edit/{id}', ['uses' =>'configController@menuEdit','as'=>'config.menuEdit']);
		Route::get('/config/menu-delete/{id}', ['uses' =>'configController@menuDelete','as'=>'config.menuDelete']);
		Route::get('/config/menu-viewIcon', ['uses' =>'configController@menuViewIcon','as'=>'config.menuViewIcon']);

		//CONFIG ROLE
		Route::get('/config/role', ['uses' =>'configController@menuRole','as'=>'role.index']);
		Route::get('/config/roleMenu', ['uses' =>'configController@reloadMenu','as'=>'config.reloadMenu']);
		Route::post('/config/role-save', ['uses' =>'configController@roleSave','as'=>'config.roleSave']);

		//Edit USERS
		Route::get('/Editusers', ['uses' =>'usersController@editIndex','as'=>'Editusers.index']);
		Route::post('/users-updateEdit', ['uses' =>'usersController@updateEdit','as'=>'users.updateEdit']);

		//ESELON
		Route::get('/eselon', ['uses' =>'eselonController@index','as'=>'eselon.index']);
		Route::post('/eselon-save', ['uses' =>'eselonController@save','as'=>'eselon.save']);
		Route::get('/eselon-ajax', ['uses' =>'eselonController@indexAjax','as'=>'eselon.indexAjax']);
		Route::post('/eselon-update', ['uses' =>'eselonController@update','as'=>'eselon.update']);
		Route::get('/eselon-show', ['uses' =>'eselonController@showAjax','as'=>'eselon.showAjax']);
		Route::get('/eselon-delete/{id}', ['uses' =>'eselonController@delete','as'=>'eselon.delete']);
		Route::get('/eselon-edit/{id}', ['uses' =>'eselonController@edit','as'=>'eselon.edit']);
		Route::get('eselon-ajax-search', ['uses' =>'eselonController@searchAjax','as'=>'eselon.searchAjax']);
        Route::get('/eselon-show-ruangan', ['uses' =>'eselonController@showRuangan','as'=>'eselon.showRuangan']);

		//KAPUS
		Route::get('/kapus', ['uses' =>'kapusController@index','as'=>'kapus.index']);
		Route::post('/kapus-save', ['uses' =>'kapusController@save','as'=>'kapus.save']);
		Route::get('/kapus-ajax', ['uses' =>'kapusController@indexAjax','as'=>'kapus.indexAjax']);
		Route::post('/kapus-update', ['uses' =>'kapusController@update','as'=>'kapus.update']);
		Route::get('/kapus-show', ['uses' =>'kapusController@showAjax','as'=>'kapus.showAjax']);
		Route::get('/kapus-delete/{id}', ['uses' =>'kapusController@delete','as'=>'kapus.delete']);
		Route::get('/kapus-edit/{id}', ['uses' =>'kapusController@edit','as'=>'kapus.edit']);
		Route::get('/kapus-show-ruangan', ['uses' =>'kapusController@showRuangan','as'=>'kapus.showRuangan']);
        Route::get('kapus-ajax-search', ['uses' =>'kapusController@searchAjax','as'=>'kapus.searchAjax']);

		//RAPAT
		Route::get('/rapat', ['uses' =>'rapatController@index','as'=>'rapat.index']);
		Route::post('/rapat-save', ['uses' =>'rapatController@save','as'=>'rapat.save']);
		Route::get('/rapat-ajax', ['uses' =>'rapatController@indexAjax','as'=>'rapat.indexAjax']);
		Route::post('/rapat-update', ['uses' =>'rapatController@update','as'=>'rapat.update']);
		Route::get('/rapat-show', ['uses' =>'rapatController@showAjax','as'=>'rapat.showAjax']);
		Route::get('/rapat-delete/{id}', ['uses' =>'rapatController@delete','as'=>'rapat.delete']);
		Route::get('/rapat-edit/{id}', ['uses' =>'rapatController@edit','as'=>'rapat.edit']);
		Route::get('/rapat-change-status', ['uses' =>'rapatController@updateStatus','as'=>'rapat.updateStatus']);
        Route::get('/rapat-show-ruangan', ['uses' =>'rapatController@showRuangan','as'=>'rapat.showRuangan']);
        Route::get('rapat-ajax-search', ['uses' =>'rapatController@searchAjax','as'=>'rapat.searchAjax']);

//BOOK RAPAT INTERNAL
		Route::get('/booking_internal', ['uses' =>'bookRapatController@index','as'=>'booking_internal.index']);
		Route::post('/booking_internal-save', ['uses' =>'bookRapatController@save','as'=>'booking_internal.save']);
		Route::get('/booking_internal-ajax', ['uses' =>'bookRapatController@indexAjax','as'=>'booking_internal.indexAjax']);
		Route::post('/booking_internal-update', ['uses' =>'bookRapatController@update','as'=>'booking_internal.update']);
		Route::get('/booking_internal-show', ['uses' =>'bookRapatController@showAjax','as'=>'booking_internal.showAjax']);
		Route::get('/booking_internal-delete/{id}', ['uses' =>'bookRapatController@delete','as'=>'booking_internal.delete']);
		Route::get('/booking_internal-edit/{id}', ['uses' =>'bookRapatController@edit','as'=>'booking_internal.edit']);
        Route::get('/booking_internal-show-ruangan', ['uses' =>'bookRapatController@showRuangan','as'=>'booking_internal.showRuangan']);
        Route::get('booking_internal-ajax-search', ['uses' =>'bookRapatController@searchAjax','as'=>'booking_internal.searchAjax']);




	});
 });
