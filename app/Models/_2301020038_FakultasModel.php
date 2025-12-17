<?php namespace App\Models; use CodeIgniter\Model;
class _2301020038_FakultasModel extends Model { 
    protected $table = 'fakultas'; 
    protected $primaryKey = 'id_fakultas'; 
    protected $allowedFields = ['nama_fakultas', 'id_user_pimpinan']; // Update ini
}