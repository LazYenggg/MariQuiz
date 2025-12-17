<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\_2301020096_UserModel;
use App\Models\_2301020035_MahasiswaModel;
use App\Models\_2301020038_FakultasModel;
use App\Models\_2301020038_JurusanModel;
use App\Models\_2301020115_ProdiModel;

class _2301020115_AdminController extends BaseController {
    
    public function index() {
        $db = \Config\Database::connect();
        $userModel = new _2301020096_UserModel();

        // 1. Data User
        $data['users'] = $userModel->where('role !=', 'admin')->findAll();
        
        // 2. Data Master (Join untuk menampilkan nama)
        $data['fakultas'] = $db->table('fakultas')
            ->select('fakultas.*, user.nama_user as nama_pimpinan')
            ->join('user', 'user.id_user = fakultas.id_user_pimpinan', 'left')
            ->get()->getResult();

        $data['jurusan'] = $db->table('jurusan')
            ->select('jurusan.*, fakultas.nama_fakultas')
            ->join('fakultas', 'fakultas.id_fakultas = jurusan.id_fakultas', 'left')
            ->get()->getResult();

        $data['prodi'] = $db->table('prodi')
            ->select('prodi.*, jurusan.nama_jurusan, user.nama_user as nama_kaprodi')
            ->join('jurusan', 'jurusan.id_jurusan = prodi.id_jurusan', 'left')
            ->join('user', 'user.id_user = prodi.id_user_kaprodi', 'left')
            ->get()->getResult();

        // 3. Data Pendukung Form (Dropdown)
        $data['list_pimpinan'] = $userModel->where('role', 'pimpinan')->findAll();
        $data['list_kaprodi'] = $userModel->where('role', 'kaprodi')->findAll();
        
        echo view('_2301020004_layout_main', ['content' => view('_2301020035_admin_mhs_view', $data)]);
    }

    // --- MANAJEMEN USER ---
    public function create_user() {
        $userModel = new _2301020096_UserModel();
        $mhsModel = new _2301020035_MahasiswaModel();

        $role = $this->request->getPost('role');
        $username = $this->request->getPost('username'); 
        $nama = $this->request->getPost('nama');
        $password = $this->request->getPost('password');

        if($userModel->where('username', $username)->first()){
            return redirect()->back()->with('error', 'Username/NIM/NIDN sudah terdaftar!');
        }

        $id_user = $userModel->insert([
            'nama_user' => $nama,
            'username'  => $username,
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'role'      => $role
        ]);

        if($role == 'mahasiswa') {
            $mhsModel->insert([
                'nim' => $username,
                'nama_mahasiswa' => $nama,
                'id_user' => $id_user,
                'id_prodi' => $this->request->getPost('id_prodi')
            ]);
        }
        return redirect()->to('/admin/dashboard')->with('success', 'User berhasil dibuat.');
    }

    public function update_user() {
        $userModel = new _2301020096_UserModel();
        $id_user = $this->request->getPost('id_user');
        $password = $this->request->getPost('password');

        $dataUpdate = [
            'nama_user' => $this->request->getPost('nama'),
            'username'  => $this->request->getPost('username'),
            'role'      => $this->request->getPost('role')
        ];

        if (!empty($password)) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id_user, $dataUpdate);

        if ($dataUpdate['role'] == 'mahasiswa') {
            $db = \Config\Database::connect();
            $db->table('mahasiswa')->where('id_user', $id_user)->update([
                'nim' => $dataUpdate['username'],
                'nama_mahasiswa' => $dataUpdate['nama_user']
            ]);
        }
        return redirect()->to('/admin/dashboard')->with('success', 'Data User diperbarui.');
    }

    public function delete_user($id) {
        $userModel = new _2301020096_UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin/dashboard')->with('success', 'User dihapus.');
    }

    // --- MANAJEMEN FAKULTAS (CRUD) ---
    public function store_fakultas() {
        $model = new _2301020038_FakultasModel();
        $model->insert([
            'nama_fakultas' => $this->request->getPost('nama_fakultas'),
            'id_user_pimpinan' => $this->request->getPost('id_user_pimpinan') ?: NULL
        ]);
        return redirect()->to('/admin/dashboard')->with('success', 'Fakultas Ditambah');
    }

    public function update_fakultas() {
        $model = new _2301020038_FakultasModel();
        $model->update($this->request->getPost('id_fakultas'), [
            'nama_fakultas' => $this->request->getPost('nama_fakultas'),
            'id_user_pimpinan' => $this->request->getPost('id_user_pimpinan') ?: NULL
        ]);
        return redirect()->to('/admin/dashboard')->with('success', 'Fakultas Diupdate');
    }

    public function delete_fakultas($id) {
        $model = new _2301020038_FakultasModel();
        $model->delete($id);
        return redirect()->to('/admin/dashboard')->with('success', 'Fakultas Dihapus');
    }

    // --- MANAJEMEN JURUSAN (CRUD) ---
    public function store_jurusan() {
        $model = new _2301020038_JurusanModel();
        $model->insert([
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'id_fakultas' => $this->request->getPost('id_fakultas')
        ]);
        return redirect()->to('/admin/dashboard')->with('success', 'Jurusan Ditambah');
    }

    public function update_jurusan() {
        $model = new _2301020038_JurusanModel();
        $model->update($this->request->getPost('id_jurusan'), [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'id_fakultas' => $this->request->getPost('id_fakultas')
        ]);
        return redirect()->to('/admin/dashboard')->with('success', 'Jurusan Diupdate');
    }

    public function delete_jurusan($id) {
        $model = new _2301020038_JurusanModel();
        $model->delete($id);
        return redirect()->to('/admin/dashboard')->with('success', 'Jurusan Dihapus');
    }

    // --- MANAJEMEN PRODI (CRUD) ---
    public function store_prodi() {
        $model = new _2301020115_ProdiModel();
        $model->insert([
            'nama_prodi' => $this->request->getPost('nama_prodi'),
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_user_kaprodi' => $this->request->getPost('id_user_kaprodi') ?: NULL
        ]);
        return redirect()->to('/admin/dashboard')->with('success', 'Prodi Ditambah');
    }

    public function update_prodi() {
        $model = new _2301020115_ProdiModel();
        $model->update($this->request->getPost('id_prodi'), [
            'nama_prodi' => $this->request->getPost('nama_prodi'),
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_user_kaprodi' => $this->request->getPost('id_user_kaprodi') ?: NULL
        ]);
        return redirect()->to('/admin/dashboard')->with('success', 'Prodi Diupdate');
    }

    public function delete_prodi($id) {
        $model = new _2301020115_ProdiModel();
        $model->delete($id);
        return redirect()->to('/admin/dashboard')->with('success', 'Prodi Dihapus');
    }
}