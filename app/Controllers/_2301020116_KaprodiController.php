<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\_2301020116_PeriodeModel;
use App\Models\_2301020063_PertanyaanModel;
use App\Models\_2301020063_PilihanModel;

class _2301020116_KaprodiController extends BaseController {
    
    private function getMyProdiID() {
        $db = \Config\Database::connect();
        $prodi = $db->table('prodi')->where('id_user_kaprodi', session()->get('id_user'))->get()->getRow();
        return $prodi ? $prodi->id_prodi : null;
    }

    public function index() {
        $db = \Config\Database::connect();
        $id_prodi = $this->getMyProdiID();

        if($id_prodi) {
            // LOGIC FILTER DASHBOARD KAPRODI:
            // Tampilkan Periode JIKA:
            // 1. Belum ada pertanyaan sama sekali (Global/Baru)
            // 2. ATAU Ada pertanyaan milik Prodi Saya
            // (Jadi kalau periode itu KHUSUS Prodi Lain, saya tidak lihat)
            
            $sql = "SELECT DISTINCT pk.* FROM periode_kuisioner pk
                    LEFT JOIN pertanyaan_periode_kuisioner ppk ON pk.id_periode = ppk.id_periode_kuisioner
                    LEFT JOIN pertanyaan p ON ppk.id_pertanyaan = p.id_pertanyaan
                    WHERE 
                        (p.id_pertanyaan IS NULL) 
                        OR 
                        (p.id_prodi = ?)
                    ORDER BY pk.id_periode DESC";
            
            $data['periodes'] = $db->query($sql, [$id_prodi])->getResult();
            
            // Ambil nama prodi
            $myProdi = $db->table('prodi')->where('id_prodi', $id_prodi)->get()->getRow();
            $data['nama_prodi'] = $myProdi->nama_prodi;
        } else {
            $data['periodes'] = [];
            $data['nama_prodi'] = 'Belum Assigned';
        }

        echo view('_2301020004_layout_main', ['content' => view('_2301020023_kaprodi_dashboard', $data)]);
    }

    public function create_periode() {
        $model = new _2301020116_PeriodeModel();
        $model->insert([
            'keterangan' => $this->request->getPost('keterangan'),
            'status_periode' => 'aktif'
        ]);
        return redirect()->to('/kaprodi/dashboard')->with('success', 'Periode Baru Dibuat');
    }

    public function manage_pertanyaan($id_periode) {
        $db = \Config\Database::connect();
        $id_prodi = $this->getMyProdiID();

        if(!$id_prodi) return redirect()->back()->with('error', 'Anda belum ditugaskan ke Prodi manapun!');

        $sql = "SELECT p.* FROM pertanyaan p 
                JOIN pertanyaan_periode_kuisioner ppk ON p.id_pertanyaan = ppk.id_pertanyaan
                WHERE ppk.id_periode_kuisioner = ? AND p.id_prodi = ?
                ORDER BY p.id_pertanyaan DESC";
        
        $data['pertanyaan'] = $db->query($sql, [$id_periode, $id_prodi])->getResult();
        $data['id_periode'] = $id_periode;
        
        echo view('_2301020004_layout_main', ['content' => view('_2301020063_manage_soal_view', $data)]);
    }

    public function store_pertanyaan() {
        $db = \Config\Database::connect();
        $tanyaModel = new _2301020063_PertanyaanModel();
        $pilihModel = new _2301020063_PilihanModel();
        $id_prodi = $this->getMyProdiID(); 

        $id_pertanyaan = $tanyaModel->insert(['pertanyaan' => $this->request->getPost('pertanyaan'), 'id_prodi' => $id_prodi]);
        $db->table('pertanyaan_periode_kuisioner')->insert(['id_periode_kuisioner' => $this->request->getPost('id_periode'), 'id_pertanyaan' => $id_pertanyaan]);

        foreach($this->request->getPost('pilihan') as $deskripsi) {
            if(!empty($deskripsi)) $pilihModel->insert(['deskripsi_pilihan' => $deskripsi, 'id_pertanyaan' => $id_pertanyaan]);
        }
        return redirect()->back()->with('success', 'Pertanyaan Tersimpan');
    }

    public function update_pertanyaan() {
        $tanyaModel = new _2301020063_PertanyaanModel();
        $id_pertanyaan = $this->request->getPost('id_pertanyaan');
        $id_prodi_saya = $this->getMyProdiID();
        $cek = $tanyaModel->where('id_pertanyaan', $id_pertanyaan)->where('id_prodi', $id_prodi_saya)->first();
        
        if($cek) {
            $tanyaModel->update($id_pertanyaan, ['pertanyaan' => $this->request->getPost('pertanyaan')]);
            return redirect()->back()->with('success', 'Pertanyaan diperbaiki.');
        } else {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }
    }

    public function delete_pertanyaan($id_pertanyaan) {
        $tanyaModel = new _2301020063_PertanyaanModel();
        $id_prodi_saya = $this->getMyProdiID();
        $cek = $tanyaModel->where('id_pertanyaan', $id_pertanyaan)->where('id_prodi', $id_prodi_saya)->first();

        if($cek) {
            $tanyaModel->delete($id_pertanyaan);
            return redirect()->back()->with('success', 'Pertanyaan dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus.');
        }
    }
    
    public function summary($id_periode) {
        $db = \Config\Database::connect();
        $id_prodi = $this->getMyProdiID();

        $sql = "SELECT p.pertanyaan, pj.deskripsi_pilihan, COUNT(j.id_jawaban) as total
                FROM pertanyaan p
                JOIN pilihan_jawaban_pertanyaan pj ON p.id_pertanyaan = pj.id_pertanyaan
                LEFT JOIN jawaban j ON pj.id_pilihan_jawaban = j.id_pilihan_jawaban_pertanyaan 
                AND j.id_periode = ?
                WHERE p.id_prodi = ? 
                GROUP BY pj.id_pilihan_jawaban ORDER BY p.id_pertanyaan";
                
        $data['hasil'] = $db->query($sql, [$id_periode, $id_prodi])->getResult();
        echo view('_2301020004_layout_main', ['content' => view('_2301020023_kaprodi_summary', $data)]);
    }
}