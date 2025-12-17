<?php namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\_2301020116_PeriodeModel;
use App\Models\_2301020013_JawabanModel;
use App\Models\_2301020035_MahasiswaModel;

class _2301020059_MahasiswaController extends BaseController {
    
    private function getMe() {
        $mhsModel = new _2301020035_MahasiswaModel();
        return $mhsModel->where('id_user', session()->get('id_user'))->first();
    }

    public function index() {
        $db = \Config\Database::connect();
        $me = $this->getMe();
        
        if ($me) {
            $sql = "SELECT DISTINCT pk.* FROM periode_kuisioner pk
                    JOIN pertanyaan_periode_kuisioner ppk ON pk.id_periode = ppk.id_periode_kuisioner
                    JOIN pertanyaan p ON ppk.id_pertanyaan = p.id_pertanyaan
                    WHERE pk.status_periode = 'aktif' AND p.id_prodi = ?
                    ORDER BY pk.id_periode DESC";
            
            $data['periodes'] = $db->query($sql, [$me->id_prodi])->getResult();
        } else {
            $data['periodes'] = [];
        }

        $data['mhs'] = $me;
        echo view('_2301020004_layout_main', ['content' => view('_2301020059_mhs_dashboard', $data)]);
    }

    public function isi_kuisioner($id_periode) {
        $db = \Config\Database::connect();
        $me = $this->getMe();
        if(!$me) return redirect()->to('/login');

        $sql = "SELECT p.* FROM pertanyaan p JOIN pertanyaan_periode_kuisioner ppk ON p.id_pertanyaan = ppk.id_pertanyaan WHERE ppk.id_periode_kuisioner = ? AND p.id_prodi = ?";
        $pertanyaan = $db->query($sql, [$id_periode, $me->id_prodi])->getResult();
            
        foreach($pertanyaan as $p) {
            $p->pilihan = $db->table('pilihan_jawaban_pertanyaan')->where('id_pertanyaan', $p->id_pertanyaan)->get()->getResult();
        }

        $jModel = new _2301020013_JawabanModel();
        $existing = $jModel->where('nim', $me->nim)->where('id_periode', $id_periode)->findAll();
        $mapJawaban = [];
        foreach($existing as $j) $mapJawaban[$j->id_pertanyaan] = $j->id_pilihan_jawaban_pertanyaan;

        return view('_2301020004_layout_main', ['content' => view('_2301020059_mhs_dashboard', [
            'mode' => 'isi', 'pertanyaan' => $pertanyaan, 'id_periode' => $id_periode, 'jawaban_existing' => $mapJawaban
        ])]);
    }

    public function submit_jawaban() {
        $jModel = new _2301020013_JawabanModel();
        $me = $this->getMe();
        $id_periode = $this->request->getPost('id_periode');
        $jawaban = $this->request->getPost('jawaban'); 
        
        $jModel->where('nim', $me->nim)->where('id_periode', $id_periode)->delete();

        if($jawaban) {
            foreach($jawaban as $id_tanya => $id_pilih) {
                $jModel->insert(['nim' => $me->nim, 'id_pertanyaan' => $id_tanya, 'id_pilihan_jawaban_pertanyaan' => $id_pilih, 'id_periode' => $id_periode]);
            }
        }
        return redirect()->to('/mahasiswa/dashboard')->with('success', 'Jawaban Tersimpan!');
    }
}