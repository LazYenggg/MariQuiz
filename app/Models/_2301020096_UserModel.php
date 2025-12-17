<?php namespace App\Models;
use CodeIgniter\Model;
class _2301020096_UserModel extends Model {
    protected $table = 'user'; // Nama tabel di database tetap 'user' biar aman relasinya
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'username', 'password', 'role'];
    protected $returnType = 'object';
}