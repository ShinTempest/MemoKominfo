<?php
use App\Http\Controllers\ViewController;

Route::redirect('/', '/login');

Route::get('/home','HomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('pelaporan', 'PelaporanController@store');
    Route::resource('pelaporan', 'PelaporanController');

    Route::get('/rekapitulasi/detail', 'RekapitulasiController@detail');
    Route::get('/rekapitulasi/get_harian/{tanggal}/{kategori}', 'RekapitulasiController@get_harian');
    Route::get('/rekapitulasi/get_mingguan/{tanggal}/{kategori}', 'RekapitulasiController@get_mingguan');
    Route::get('/rekapitulasi/get_bulanan/{tanggal}/{kategori}', 'RekapitulasiController@get_bulanan');
    Route::resource('rekapitulasi', 'RekapitulasiController');

    Route::get('/rekapitulasi/cetak_pdf/{id}', [ViewController::class, 'cetak_pdf']) -> name('cetak_pdf');
    Route::get('/rekapitulasi-detail/{id}', [ViewController::class,'view']);

    Route::resource('profil', 'ProfilController');

    Route::get('/pencarian/index/{keyword}', 'PencarianController@index');
    Route::resource('pencarian', 'PencarianController@index');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', 'HomeController@index')->name('home');

    //Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    //Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    //Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
