<?php namespace App\Models; use CodeIgniter\Model;
class _2301020013_JawabanModel extends Model {
    protected $table = 'jawaban'; protected $primaryKey = 'id_jawaban';
    protected $allowedFields = ['nim', 'id_pertanyaan', 'id_pilihan_jawaban_pertanyaan', 'id_periode'];
}