<?php namespace App\Controllers;

use App\Controllers\BaseController;

class _2301020004_PimpinanController extends BaseController {
    
    private function getMyFakultas() {
        $db = \Config\Database::connect();
        return $db->table('fakultas')->where('id_user_pimpinan', session()->get('id_user'))->get()->getRow();
    }

    public function index() {
        $db = \Config\Database::connect();
        $myFakultas = $this->getMyFakultas();

        if (!$myFakultas) {
            $data['periodes'] = [];
            $data['fakultas'] = null;
        } else {
            $sql = "SELECT DISTINCT pk.* FROM periode_kuisioner pk
                    JOIN pertanyaan_periode_kuisioner ppk ON pk.id_periode = ppk.id_periode_kuisioner
                    JOIN pertanyaan p ON ppk.id_pertanyaan = p.id_pertanyaan
                    JOIN prodi pr ON p.id_prodi = pr.id_prodi
                    JOIN jurusan j ON pr.id_jurusan = j.id_jurusan
                    WHERE j.id_fakultas = ?
                    ORDER BY pk.id_periode DESC";
            
            $data['periodes'] = $db->query($sql, [$myFakultas->id_fakultas])->getResult();
            $data['fakultas'] = $myFakultas;
        }

        return view('_2301020004_layout_main', ['content' => view('_2301020004_pimpinan_dashboard', $data)]);
    }

    public function summary($id_periode) {
        $db = \Config\Database::connect();
        $myFakultas = $this->getMyFakultas();

        if (!$myFakultas) {
            return redirect()->to('/pimpinan/dashboard')->with('error', 'Akses Ditolak.');
        }

        $sql = "SELECT pr.nama_prodi, p.pertanyaan, pj.deskripsi_pilihan, COUNT(j.id_jawaban) as total
                FROM pertanyaan p
                JOIN prodi pr ON p.id_prodi = pr.id_prodi
                JOIN jurusan ju ON pr.id_jurusan = ju.id_jurusan
                JOIN pilihan_jawaban_pertanyaan pj ON p.id_pertanyaan = pj.id_pertanyaan
                LEFT JOIN jawaban j ON pj.id_pilihan_jawaban = j.id_pilihan_jawaban_pertanyaan AND j.id_periode = ?
                WHERE ju.id_fakultas = ? 
                GROUP BY pj.id_pilihan_jawaban 
                ORDER BY pr.nama_prodi ASC, p.id_pertanyaan ASC";
                
        $data['hasil'] = $db->query($sql, [$id_periode, $myFakultas->id_fakultas])->getResult();
        $data['fakultas'] = $myFakultas;
        
        return view('_2301020004_layout_main', ['content' => view('_2301020004_pimpinan_summary', $data)]);
    }
}