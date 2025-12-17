<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('_2301020096_AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// 1. Auth Routes
$routes->get('/', '_2301020096_AuthController::index');
$routes->get('login', '_2301020096_AuthController::index');
$routes->post('auth/login', '_2301020096_AuthController::login_process');
$routes->get('logout', '_2301020096_AuthController::logout');

// GROUP ADMIN (Full CRUD)
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', '_2301020115_AdminController::index');
    
    // User
    $routes->post('create_user', '_2301020115_AdminController::create_user');
    $routes->get('delete_user/(:num)', '_2301020115_AdminController::delete_user/$1');
    $routes->post('update_user', '_2301020115_AdminController::update_user');
    
    // Fakultas
    $routes->post('store_fakultas', '_2301020115_AdminController::store_fakultas');
    $routes->post('update_fakultas', '_2301020115_AdminController::update_fakultas');
    $routes->get('delete_fakultas/(:num)', '_2301020115_AdminController::delete_fakultas/$1');
    
    // Jurusan
    $routes->post('store_jurusan', '_2301020115_AdminController::store_jurusan');
    $routes->post('update_jurusan', '_2301020115_AdminController::update_jurusan');
    $routes->get('delete_jurusan/(:num)', '_2301020115_AdminController::delete_jurusan/$1');

    // Prodi
    $routes->post('store_prodi', '_2301020115_AdminController::store_prodi');
    $routes->post('update_prodi', '_2301020115_AdminController::update_prodi');
    $routes->get('delete_prodi/(:num)', '_2301020115_AdminController::delete_prodi/$1');
});

// 3. Group Kaprodi (UPDATED)
$routes->group('kaprodi', ['filter' => 'auth:kaprodi'], function($routes) {
    $routes->get('dashboard', '_2301020116_KaprodiController::index');
    $routes->post('create_periode', '_2301020116_KaprodiController::create_periode');
    
    // Manajemen Soal (CRUD)
    $routes->get('manage/(:num)', '_2301020116_KaprodiController::manage_pertanyaan/$1');
    $routes->post('store_pertanyaan', '_2301020116_KaprodiController::store_pertanyaan');
    $routes->post('update_pertanyaan', '_2301020116_KaprodiController::update_pertanyaan');
    $routes->get('delete_pertanyaan/(:num)', '_2301020116_KaprodiController::delete_pertanyaan/$1');
    
    $routes->get('summary/(:num)', '_2301020116_KaprodiController::summary/$1');
});

// 4. Group Mahasiswa
$routes->group('mahasiswa', ['filter' => 'auth:mahasiswa'], function($routes) {
    $routes->get('dashboard', '_2301020059_MahasiswaController::index');
    $routes->get('isi/(:num)', '_2301020059_MahasiswaController::isi_kuisioner/$1');
    $routes->post('submit', '_2301020059_MahasiswaController::submit_jawaban');
});

// 5. Group Pimpinan
$routes->group('pimpinan', ['filter' => 'auth:pimpinan'], function($routes) {
    $routes->get('dashboard', '_2301020004_PimpinanController::index');
    $routes->get('summary/(:num)', '_2301020004_PimpinanController::summary/$1');
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}