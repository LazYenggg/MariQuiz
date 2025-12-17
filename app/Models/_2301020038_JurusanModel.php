<?php namespace App\Models; use CodeIgniter\Model;
class _2301020038_JurusanModel extends Model {
    protected $table = 'jurusan'; protected $primaryKey = 'id_jurusan';
    protected $allowedFields = ['nama_jurusan', 'id_fakultas'];
}