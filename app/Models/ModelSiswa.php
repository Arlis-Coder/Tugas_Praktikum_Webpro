<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model {
    protected $table = "siswa";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama', 'wali', 'jenis_kelamin', 'alamat'];
}
