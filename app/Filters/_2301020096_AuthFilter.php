<?php 

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class _2301020096_AuthFilter implements FilterInterface {
    
    public function before(RequestInterface $request, $arguments = null) {
        $session = session();

        // 1. Cek apakah sudah login?
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan Login Terlebih Dahulu');
        }

        // 2. Cek Role (Jika filter dipasang dengan argumen, misal: auth:admin)
        if (!empty($arguments)) {
            $role = $session->get('role');
            // Jika role user tidak ada di dalam daftar argumen yang diperbolehkan
            if (!in_array($role, $arguments)) {
                // Lempar balik ke dashboard aslinya biar tidak nyasar
                return redirect()->to('/' . $role . '/dashboard')->with('error', 'Akses Ditolak! Anda tidak memiliki izin.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Tidak perlu melakukan apa-apa setelah request
    }
}