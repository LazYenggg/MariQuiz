<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\_2301020096_UserModel;

class _2301020096_AuthController extends BaseController {
    
    // Menampilkan Halaman Login
    public function index() {
        // Jika sudah login, langsung lempar ke dashboard masing-masing
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/' . session()->get('role') . '/dashboard');
        }
        return view('_2301020096_login_view');
    }

    // Proses Login
    public function login_process() {
        $model = new _2301020096_UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $model->where('username', $username)->first();

        // Cek User & Password
        if ($user && password_verify($password, $user->password)) {
            // Set Session
            $sessionData = [
                'id_user'    => $user->id_user,
                'nama_user'  => $user->nama_user,
                'role'       => $user->role,
                'isLoggedIn' => true
            ];
            session()->set($sessionData);

            // Redirect sesuai Role
            return redirect()->to('/' . $user->role . '/dashboard');
        } else {
            // Login Gagal
            return redirect()->back()->with('error', 'Username atau Password Salah!');
        }
    }

    // Proses Logout
    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}